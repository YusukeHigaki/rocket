<?php
namespace App\Services;

use App\GooglePlay;

class GooglePlayService implements PlatformServiceInterface
{
    protected $url = 'http://doroidpanic.com/ws/googleplay-ranking-api/ranking/0';

    public function getRanking()
    {
        $feed = file_get_contents($this->url);
        //delete BOM
        $feed = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $feed);
        $dataList = json_decode($feed, true);

        $appList = [];
        foreach ($dataList as $data) {
            $value = [
                'ranking' => $data['position'],
                'name' => $data['title'],
                'icon' => $data['icon'],
            ];
            $appList[] = new GooglePlay($value);
        }

        return $appList;
    }
}