<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\AppStore;
use App\GooglePlay;
use App\Alexa;
use DB;

class RankingController extends Controller
{
    const PAGINATE = 100;

    public function showAppStore()
    {
        $start = date("Y-m-d",strtotime("-7 day"));
        $end = date("Y-m-d",strtotime("+1 day"));
        $appList = AppStore::whereRaw("created_at between '{$start}' and '{$end}'")
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE);

        return view('ranking.appStore')->with('appList', $appList);
    }

    public function showGooglePlay()
    {
        $start = date("Y-m-d",strtotime("-7 day"));
        $end = date("Y-m-d",strtotime("+1 day"));
        $appList = GooglePlay::whereRaw("created_at between '{$start}' and '{$end}'")
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE);

        return view('ranking.googlePlay')->with('appList', $appList);
    }

    public function showAlexa()
    {
        $start = date("Y-m-d",strtotime("-7 day"));
        $end = date("Y-m-d",strtotime("+1 day"));
        $webList = Alexa::whereRaw("created_at between '{$start}' and '{$end}'")
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE);

        return view('ranking.alexa')->with('webList', $webList);

    }

}