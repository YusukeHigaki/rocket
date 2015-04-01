<?php
namespace App\Services;

use App\Iphone;

class AppstoreService
{
    protected $url = 'https://itunes.apple.com/jp/rss/topfreeapplications/';

    /**
     * @param int $limit(maximum 200)
     */
    public function getRanking($limit = 10)
    {
        $feed = file_get_contents("{$this->url}limit={$limit}/json");
        $dataList = json_decode($feed, true);
        $appList = [];
        $i = 1;
        foreach ($dataList['feed']['entry'] as $data) {
            $value = [
                'ranking' => $i,
                'name' => $data['im:name']['label'],
                'icon' => $data['im:image'][0]['label'],
                'url' => $data['link']['attributes']['href'],
            ];
            $appList[] = new Iphone($value);
            $i++;
        }

        return $appList;
    }
}