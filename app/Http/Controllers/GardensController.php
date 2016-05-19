<?php

namespace App\Http\Controllers;



use App\Jobs\SpiderQueue;
use Queue;
use Illuminate\Http\Request;
use App\Http\Requests;
use Symfony\Component\DomCrawler\Crawler;
use App\Garden;
use Goutte;


class GardensController extends Controller
{
    public function get()
    {

        for($page = 0;$page<=100;$page++){
            $this->getGardenInfoByPage($page);
        }

        return "OK";
    }

    /**
     *
     * Get the gardens name
     *
     * @param $crawler
     * @return mixed
     */
    public function getGardensName($crawler)
    {
        $node_values = $crawler->filter('.house-lst .info-panel h2 a')->each(function (Crawler $node, $i) {

            return ['name' => $node->text()];

        });
        return $node_values;
    }

    /**
     * Get the Gardens price
     * @param $crawler
     * @return mixed
     */
    public function getGardensPrice($crawler)
    {
        $node_values2 = $crawler->filter('.house-lst .info-panel .price .num')->each(function (Crawler $node, $i) {

            return ['price' => $node->text()];

        });
        return $node_values2;
    }


    /**
     *
     * Merge the gardens name , price and city
     * @param $node_values
     * @param $node_values2
     * @param $city
     * @return array
     */
    public function mergeGardensInfo($node_values, $node_values2,$city)
    {
        $node_values3 = [];

        foreach ($node_values as $key => &$node_value){
            $node_values3[] = array_merge($node_value, $node_values2[$key],['city' => $city]);
        }

        return $node_values3;
    }

    /**
     * @return array
     */
    public function getGardenInfoByPage($page)
    {
        $crawler = Goutte::request('GET', 'http://sh.lianjia.com/xiaoqu/d'.$page);

        $node_values = $this->getGardensName($crawler);

        $node_values2 = $this->getGardensPrice($crawler);

        $node_values3 = $this->mergeGardensInfo($node_values, $node_values2, "上海");

        foreach ($node_values3 as $node_value) {
            Garden::firstOrCreate($node_value);
        }

    }


}
