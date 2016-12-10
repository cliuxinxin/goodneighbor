<?php

namespace App\Http\Controllers;

use App\Nce;
use App\Topic;
use App\Info;
use Auth;
use Carbon\Carbon;
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
        $this->middleware('auth')->only(['seen','index']);
        $this->user = Auth::user();
    }

    /**
     * Hospital info
     *
     * @return mixed
     */
    public function hospital()
    {

        $topics =  Topic::zhaobiao()->hospital()->latest()->paginate(20);

        return view('hospital.index',compact('topics'));
    }


    /**
     * Get info by day
     *
     * @return string
     */
    public function getByDay()
    {
        $this->getDaZhou();

        $this->getSiChuan();

        $this->getSuiNing();

        return 'OK';
    }

    public function getBy6Hours()
    {
        $this->getGaoQingLaUpdate();

        $this->getGaoQingLaDetailAuto();

//        $this->getXunBoMeiJu();

//        $this->getXunBoDongman();

        return 'OK';
    }

    /**
     * Get info
     *
     * @return string
     */
    public function get()
    {

//        $this->getBangumi(3461);

//        $this->getBangumi(3218);
//        $this->getInfosByFollow();
        $this->getInfosByFollow();

        return 'OK';

    }



    /**
     * Get Infos by your follow
     */
    public function getInfosByFollow()
    {
        $follows = [
            ['name'=>'金评媒','url' => '4700'],
            ['name'=>'丁香医生','url' => '11'],
            ['name'=>'德科地产频道','url' => '1504'],
            ['name'=>'极客公园','url' => '1222'],
            ['name'=>'伯乐在线','url' => '1028'],
            ['name'=>'朱罗纪','url' => '9657'],
            ['name'=>'米筐投资','url' => '5624'],
            ['name'=>'差评','url' => '305'],
            ['name'=>'科学松鼠会','url' => '6031'],
            ['name'=>'海涛评论','url' => '1159'],
            ['name'=>'金融八卦女','url' => '149'],
            ['name'=>'财经国家周刊','url' => '4852'],
            ['name'=>'跑赢CPI','url' => '1885'],
            ['name'=>'港股那点事','url' => '835'],
            ['name'=>'棱镜','url' => '4450'],
            ['name'=>'知乎日报','url' => '44'],
            ['name'=>'第1整理术','url' => '3918'],
            ['name'=>'理财周刊','url' => '2193'],
            ['name'=>'Quora爱好者','url' => '1024'],
            ['name'=>'营养师顾中一','url' => '344'],
            ['name'=>'硅发布','url' => '742'],
            ['name'=>'财子佳人','url' => '9776'],
            ['name'=>'价值线','url' => '2167'],
            ['name'=>'大浪淘沙','url' => '3767'],
            ['name'=>'安邦咨询','url' => '3599'],
            ['name'=>'虎嗅网','url' => '343']
        ];

        foreach ($follows as $follow){
            $this->getInfosByListId($follow['url']);
        }

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

        $this->getMeijuListUrl();

        $xunbolists = Topic::where('type', '迅播列表')->latest()->get();

        return view('topics.xunbo',compact('xunbolists'));
    }


    public function test()
    {

        return "ok";
    }



    /**
     * Show index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $gaoqings = Topic::where('type', '高清剧集详细')->latest()->paginate(5);

//        $xunbolist = $this->user->topics()->where('type','迅播列表')->lists('detail');

//        $meijus = Topic::where('type', '迅播美剧')->whereIn('detail',$xunbolist)->latest()->paginate(5);


//        $meijus = Topic::where('type', '迅播美剧')->latest()->paginate(10);

//        $bangumis = Topic::where('type', '动画番剧')->latest()->paginate(5);

        $bit_coin_price = json_decode($this->getBitCoinPrice(), true);

        $stock_price = $this->getStockPrice();

//        $bible = Bible::find(rand(1,31102));
//        $nce = Nce::find(rand(1,5865));
        $infos = Info::groupBy('title')->latest()->Thisweek()->paginate(20);

        return view('topics.index',compact('gaoqings','bit_coin_price','stock_price','infos'));
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
     * User read info
     *
     * @param $info
     * @return \Illuminate\Http\RedirectResponse
     */
    public function read($info)
    {

        $this->user->infos()->sync([$info], false);

        return redirect()->back();
    }

    /**
     * User unRead info
     *
     * @param $info
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unRead($info)
    {
        $this->user->infos()->detach($info);

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

        $nodeValues2 = $crawler->filter('#post_content p a')->each(function (Crawler $node, $i) {

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

    public function getXunBoDongman()
    {
        $crawler = Goutte::request('GET', 'http://www.xiamp4.com/GvodHtml/7.html');

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

    /**
     * @return mixed
     */
    public function getMeijuListUrl()
    {
        $meijus = Topic::where('type', '迅播列表')->where('url', '')->get();

        foreach ($meijus as $meiju) {
            $meijuUrl = Topic::where('type', '迅播美剧')->where('detail', $meiju->detail)->first();

            $meiju->update(['url' => $meijuUrl->url]);

        }
    }

    /**
     * @return mixed
     */
    private function getInfosByListId($url)
    {
        $crawler = Goutte::request('GET', 'http://www.iwgc.cn/list/'.$url);

        $nodeValues = $crawler->filter('.list-group-item.clearfix')->each(function (Crawler $node, $i) {

            return [
                'title' => $node->children()->eq(1)->children()->eq(0)->text(),
                'summary' => $node->children()->eq(1)->children()->eq(2)->text(),
                'url' => 'http://www.iwgc.cn' . $node->attr('href')
            ];

        });

        foreach ($nodeValues as $nodeValue) {
            Info::firstOrCreate($nodeValue);
        }

        return $nodeValues;

    }

    /**
     * @return mixed
     */
    private function getDaZhou()
    {
        $crawler = Goutte::request('GET', 'http://www.dzggzy.cn/dzsggzy/jyxx/025002/025002001/');

        $nodeValues = $crawler->filter('tr.trfont')->each(function (Crawler $node, $i) {

            return [
                'detail' => $node->children()->eq(1)->text(),
                'comment' => $node->children()->eq(2)->text(),
                'type' => '达州招标',
                'url' => 'http://www.dzggzy.cn/' . $node->children()->eq(1)->children()->eq(0)->attr('href')
            ];

        });

        foreach ($nodeValues as $nodeValue) {
            Topic::firstOrCreate($nodeValue);
        }
        return $nodeValues;
    }

    /**
     * Get Sichuan zhaobiao infos
     *
     * @return mixed
     */
    private function getSiChuan()
    {
        $crawler = Goutte::request('GET', 'http://www.sczfcg.com/CmsNewsController.do?method=recommendBulletinList&moreType=provincebuyBulletinMore&channelCode=dyly&rp=25&page=1');

        $nodeValues = $crawler->filter('div.colsList ul li')->each(function (Crawler $node, $i) {

            return [
                'detail' => $node->children()->eq(0)->text(),
                'comment' => $node->children()->eq(1)->text(),
                'type' => '四川招标',
                'url' => 'http://www.sczfcg.com/' . $node->children()->eq(0)->attr('href')
            ];

        });

        foreach ($nodeValues as $nodeValue) {
            Topic::firstOrCreate($nodeValue);
        }


        return $nodeValues;
    }

    /**
     * @return mixed
     */
    private function getSuiNing()
    {
        $crawler = Goutte::request('GET', 'http://www.snjsjy.com/Content/Cloud/29_1_20_0');

        $nodeValues = $crawler->filter('div.box-text-list ul li')->each(function (Crawler $node, $i) {

            return [
                'detail' => $node->children()->eq(3)->text(),

                'comment' => $node->children()->eq(0)->text(),
                'type' => '遂宁招标',
                'url' => $node->children()->eq(3)->attr('href'),
            ];

        });

        foreach ($nodeValues as $nodeValue) {
            Topic::firstOrCreate($nodeValue);
        }
        return $nodeValues;
    }

    /**
     * @return mixed
     */
    private function getChuansongmen()
    {
        $crawler = Goutte::request('GET', 'http://chuansong.me/select');

        $nodeValues = $crawler->filter('a.question_link')->each(function (Crawler $node, $i) {

            return [
                'url' => 'http://chuansong.me' . $node->attr('href'),
                'title' => $node->text(),
                'summary' => ''
            ];

        });

        foreach ($nodeValues as $nodeValue) {
            Info::firstOrCreate($nodeValue);
        }

        return $nodeValues;
    }

    /**
     * @return mixed
     */
    private function getWeixinjingxuan()
    {
        $crawler = Goutte::request('GET', 'http://fzn.cc/');

        $nodeValues = $crawler->filter('header h2 a')->each(function (Crawler $node, $i) {

            return [
                'url' => $node->attr('href'),
                'title' => $node->text(),
                'summary' => ''
            ];

        });

        foreach ($nodeValues as $nodeValue) {
            Info::firstOrCreate($nodeValue);
        }

        return $nodeValues;
    }


}
