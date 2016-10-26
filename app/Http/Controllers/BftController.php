<?php

namespace App\Http\Controllers;

use App\Bft;
use App\Pbft;
use Illuminate\Http\Request;

use App\Http\Requests;

class BftController extends Controller
{
    //
    public function get()
    {
        $bfts = Bft::all();

        return view('bft.index',compact('bfts'));
    }

    public function store(Request $request)
    {
        $bfts = Bft::all();

        $pfts = $this->calculatePersonPoints($request, $bfts);

        Pbft::create($pfts);

        return $pfts;
    }


    private function calculatePoints(Request $request, $bfts , $index)
    {
        $filtered = $bfts->filter(function ($bft) use ($index) {
            return $bft->type == $index;
        }) ;

        $result = 0;

        foreach ($filtered as $bft) {
            $result = $result + $request->all()[$bft->id];
        }

        return $result;
    }

    /**
     * @param Request $request
     * @param $bfts
     * @return array
     */
    private function calculatePersonPoints(Request $request, $bfts)
    {
        $AZ = $this->calculatePoints($request, $bfts, 'AZ');
        $AY = $this->calculatePoints($request, $bfts, 'AY');
        $BZ = $this->calculatePoints($request, $bfts, 'BZ');
        $BY = $this->calculatePoints($request, $bfts, 'BY');
        $CZ = $this->calculatePoints($request, $bfts, 'CZ');
        $CY = $this->calculatePoints($request, $bfts, 'CY');
        $DZ = $this->calculatePoints($request, $bfts, 'DZ');
        $DY = $this->calculatePoints($request, $bfts, 'DY');
        $EZ = $this->calculatePoints($request, $bfts, 'EZ');
        $EY = $this->calculatePoints($request, $bfts, 'EY');
        $FZ = $this->calculatePoints($request, $bfts, 'FZ');
        $FY = $this->calculatePoints($request, $bfts, 'FY');
        $GZ = $this->calculatePoints($request, $bfts, 'GZ');
        $GY = $this->calculatePoints($request, $bfts, 'GY');

        $pfts = [
            'sex' => $request->all()['sex'],
            'a' => $AZ - $AY,
            'b' => $BZ - $BY,
            'c' => $CZ - $CY,
            'd' => $DZ - $DY,
            'e' => $EZ - $EY,
            'f' => $FZ - $FY,
            'g' => $GZ - $GY
        ];
        return $pfts;
    }
}
