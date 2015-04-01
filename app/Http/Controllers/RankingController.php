<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Iphone;
use App\Services\AppstoreService;

class RankingController extends Controller
{
    protected $appstoreService;

    // どこからappstoreServiceを注入してる？
    public function __construct(AppstoreService $appstoreService)
    {
        $this->appstoreService = $appstoreService;
    }

    public function storeAppstore()
    {
        $ranking = $this->appstoreService->getRanking(10);

        $appList = [];
        foreach ($ranking as $app) {
            $exist = Iphone::where('url', '=', $app->url)->first();
            if ($exist) continue;
            $app->save();
            $appList[] = $app;
        }
    }

    public function showAppstore()
    {
        $appList = Iphone::all();
        return view('ranking.appstore')->with('appList', $appList);
    }
}