<?php

namespace App\Http\Controllers;

use App\Topic;
use Auth;
use Goutte;
use Illuminate\Http\Request;
use Laracurl;
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

        $this->getBangumi(3461);

        $this->getBangumi(3218);

        return 'OK';

    }

    /**
     * Get xunbo list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function xunbo()
    {
        $xunbolists = Topic::where('type','迅播美剧')->get()->lists('detail');

        foreach ($xunbolists as $xunbolist) {
            Topic::firstOrCreate([
                'type' => '迅播列表',
                'detail' => $xunbolist,
            ]);
        }

        $xunbolists = Topic::where('type', '迅播列表')->latest()->paginate(10);

        return view('topics.xunbo',compact('xunbolists'));
    }

    public function test()
    {

        $topics = $this->user->topics()->where('type','迅播列表')->lists('detail');

        $meijus = Topic::where('type', '迅播美剧')->whereIn('detail',$topics)->get();

        return $meijus;

    }



    /**
     * Show index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $gaoqings = Topic::where('type', '高清剧集详细')->latest()->paginate(10);

        $xunbolist = $this->user->topics()->where('type','迅播列表')->lists('detail');

        $meijus = Topic::where('type', '迅播美剧')->whereIn('detail',$xunbolist)->latest()->paginate(10);


//        $meijus = Topic::where('type', '迅播美剧')->latest()->paginate(10);

        $bangumis = Topic::where('type', '动画番剧')->latest()->paginate(10);

        $bit_coin_price = json_decode($this->getBitCoinPrice(), true);

        $stock_price = $this->getStockPrice();


        return view('topics.index',compact('gaoqings','meijus','bit_coin_price','stock_price','bangumis'));
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

        return redirect()->back();
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

        return redirect()->back();
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

    /**
     * @return mixed
     */
    public function getBitCoinPrice()
    {
        $crawler = Goutte::request('GET', 'http://api.btctrade.com/api/ticker?coin=btc');

        $nodeValues = $crawler->text();

        return $nodeValues;
    }

    /**
     * @return string
     */
    public function getStockPrice()
    {
        $response = Laracurl::get('http://api.money.126.net/data/feed/0000001,money.api');

        $json_string = substr($response, strpos($response->body, '"price":') + 8, 8);

        return $json_string;
    }

    /**
     * Get Bangumi
     *
     * @param $bangumicode
     */
    public function getBangumi($bangumicode)
    {
        $crawler = Goutte::request('GET', 'http://bangumi.bilibili.com/anime/'.$bangumicode.'/');

        $nodeValues = $crawler->filter('a.v1-long-text')->each(function (Crawler $node, $i) {

            return [$node->attr('title')];

        });

        $title = $crawler->filter('.info-title')->each(function (Crawler $node, $i) {

            return $node->attr('title');

        });

        foreach ($nodeValues as $nodeValue) {
            Topic::firstOrCreate([
                'type' => '动画番剧',
                'detail' => $nodeValue[0],
                'comment' => $title[0],
            ]);
        }
    }


}
