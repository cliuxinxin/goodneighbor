<?php

namespace App\Http\Controllers;

use App\Topic;
use Auth;
use Goutte;
use Illuminate\Http\Request;
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

    public function get()
    {
        $this->getGaoQingLaUpdate();

        $this->getGaoQingLaDetailAuto();

        return 'OK';

    }

    public function index()
    {
        $gaoqings = Topic::where('type', '高清剧集详细')->latest()->paginate(10);

        return view('topics.index',compact('gaoqings'));
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

        Topic::firstOrCreate([
            'type' => '高清剧集详细',
            'detail' => $detail,
            'url' => end($nodeValues2),
            'comment' => $url
        ]);
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
}
