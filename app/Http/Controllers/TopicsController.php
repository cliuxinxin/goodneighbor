<?php

namespace App\Http\Controllers;

use App\Topic;
use Auth;
use Goutte;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

use App\Http\Requests;

class TopicsController extends Controller
{

    protected $user;

    /**
     * Only auth user can create a task.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['seen']);
        $this->user = Auth::user();
    }

    /**
     * Get info
     *
     * @return string
     */
    public function get()
    {
        $this->getGaoQingLaUpdate();

        $this->getGaoQingLaDetailAuto();

        $this->getXunBoMeiJu();

        return 'OK';

    }

    public function test()
    {


    }
    /**
     * Show index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $gaoqings = Topic::where('type', '高清剧集详细')->latest()->paginate(10);

        $meijus = Topic::where('type', '迅播美剧')->latest()->paginate(10);

        return view('topics.index',compact('gaoqings','meijus'));
    }

    /**
     * User has seen a topic
     *
     * @param $topic
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function seen($topic)
    {

        $this->user->topics()->sync([$topic], false);

        return redirect('topics/index');
    }

    /**
     * Ueser unseen a topic
     *
     * @param $topic
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function unSeen($topic)
    {
        $this->user->topics()->detach($topic);

        return redirect('topics/index');

    }



    /**
     * Get gaoqingla menu
     */
    public function getGaoQingLaUpdate()
    {
        $crawler = Goutte::request('GET', 'http://gaoqing.la/');

        $nodeValues = $crawler->filter('#post_container .thumbnail a')->each(function (Crawler $node, $i) {

            return [$node->attr('title'), $node->attr('href')];

        });

        foreach ($nodeValues as $nodeValue) {
            Topic::firstOrCreate([
                'type' => '高清剧集',
                'detail' => $nodeValue[0],
                'url' => $nodeValue[1]
            ]);
        }

        return $nodeValues;
    }

    /**
     * Get gaoqingla detal
     * @param $detail
     * @param $url
     */
    public function getGaoQingLaDetail($detail,$url)
    {
        $crawler = Goutte::request('GET', $url);

        $nodeValues = $crawler->filter('#post_content p span')->each(function (Crawler $node, $i) {

            return $node->text();

        });

        $nodeValues2 = $crawler->filter('#post_content p span a')->each(function (Crawler $node, $i) {

            return $node->attr('href');

        });

        if(strlen(end($nodeValues2))>10){
            Topic::firstOrCreate([
                'type' => '高清剧集详细',
                'detail' => $detail,
                'url' => end($nodeValues2),
                'comment' => $url
            ]);
        }

    }

    /**
     * @return mixed
     */
    public function getGaoQingLaDetailAuto()
    {
        $gaoqings = Topic::where('type', '高清剧集')->get();

        foreach ($gaoqings as $gaoqing) {
            $this->getGaoQingLaDetail($gaoqing->detail, $gaoqing->url);
        }
    }

    /**
     * @return mixed
     */
    public function getXunBoMeiJuList()
    {
        $crawler = Goutte::request('GET', 'http://www.xiamp4.com/GvodHtml/11.html');

        $nodeValues = $crawler->filter('.info h2 a')->each(function (Crawler $node, $i) {

            return [$node->attr('title'), $node->attr('href')];

        });

        foreach ($nodeValues as $nodeValue) {
            Topic::firstOrCreate([
                'type' => '美剧',
                'detail' => $nodeValue[0],
                'url' => $nodeValue[1]
            ]);
        }

    }

    public function getXunBoMeiJu()
    {
        $crawler = Goutte::request('GET', 'http://www.xiamp4.com/GvodHtml/11.html');

        $nodeValues = $crawler->filter('.info p i')->each(function (Crawler $node, $i) {

            return $node->text();

        });

        $status = [];
        $dates = [];

        foreach ($nodeValues as $nodeValue) {
            if (strpos($nodeValue, '状态：') !== false) {
                $status[] = $nodeValue;
            }

            if (strpos($nodeValue, '更新：') !== false) {
                $dates[] = $nodeValue;
            }
        }


        $nodeValues = $crawler->filter('.info h2 a')->each(function (Crawler $node, $i) {

            return [$node->attr('title'), $node->attr('href') . '#down'];

        });

        $meijus = [];

        foreach ($nodeValues as $key => $nodeValue) {
            $meijus[] = [
                'type' => '迅播美剧',
                'detail' => $nodeValue[0],
                'url' => 'http://www.xiamp4.com/' . $nodeValue[1],
                'comment' => $status[$key] . ' ' . $dates[$key]
            ];
        }

        foreach ($meijus as $meiju) {
            Topic::firstOrCreate($meiju);
        }
    }

}
