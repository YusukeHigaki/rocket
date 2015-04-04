<?php
namespace App\Services;

use App\Alexa;
use App\Services\PlatformServiceInterface;

class AlexaService implements PlatformServiceInterface
{
    protected $base_url = 'http://www.alexa.com/topsites/countries;';
    protected $country  ='/JP';

    public function getRanking($limit = 100)
    {
        $webList = [];
        for ($i = 0; $i < $limit / 25 + 1; $i++) {
            $url = $this->base_url . $i . $this->country;
            foreach ($this->scraping($url) as $web) {
                $webList[] = $web;
            }
        }
        array_splice($webList, $limit);

        return $webList;
    }

    /**
     * @return alexa[]
     */
    private function scraping($url)
    {
        @$content = file_get_contents($url);
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');
        $dom = new \DOMDocument();
        @$dom->loadHTML($content);
        $xpath = new \DOMXPath($dom);
        $webList = [];
        foreach ($xpath->query('//div[@class="alx-top"]/section/div[@class="row-fluid"]/section/span/span/section/div/ul/li') as $node) {
            $rawDescription = $xpath->evaluate('string(.//div/div[@class="description"])', $node);
            $webList[] = new Alexa([
                'ranking' => $xpath->evaluate('string(.//div[@class="count"])', $node),
                'url' => $xpath->evaluate('string(.//div/p/a)', $node),
                'description' => str_replace('... More', '', $rawDescription),
            ]);
        }
        return $webList;
    }
}