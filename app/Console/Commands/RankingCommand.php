<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Services\AppStoreService;
use App\Services\GooglePlayService;
use App\Services\AlexaService;
use App\AppStore;
use App\GooglePlay;
use App\Alexa;

class RankingCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ranking';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update AppStore, Android market, and Alexa ranking';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(AppStoreService $appStoreService, GooglePlayService $googlePlayService, AlexaService $alexaService)
	{
		parent::__construct();
        $this->appStoreService = $appStoreService;
        $this->googlePlayService = $googlePlayService;
        $this->alexaService = $alexaService;
	}

    /**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->updateAppStoreRanking(100);
        $this->updateGooglePlayRanking(60);
        $this->updateAlexaRanking(500);
    }

    private function updateAppStoreRanking($count)
    {
        $ranking = $this->appStoreService->getRanking($count);

        $count = 0;
        foreach ($ranking as $app) {
            $exist = AppStore::where('url', '=', $app->url)->first();
            if ($exist) continue;
            $app->save();
            $count++;
        }

        $this->info("AppStore : {$count}件アップデートしました");
    }

    private function updateGooglePlayRanking($count)
    {
        $ranking = $this->googlePlayService->getRanking($count);

        $count = 0;
        foreach ($ranking as $app) {
            $exist = GooglePlay::where('icon', '=', $app->icon)->first();
            if ($exist) continue;
            $app->save();
            $count++;
        }

        $this->info("GooglePlay : {$count}件アップデートしました");
    }

    private function updateAlexaRanking($count)
    {
        $ranking = $this->alexaService->getRanking($count);

        $count = 0;
        foreach ($ranking as $web) {
            $exist = Alexa::where('url', '=', $web->url)->first();
            if ($exist) continue;
            $web->save();
            $count++;
        }

        $this->info("Alexa : {$count}件アップデートしました");
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
//			['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
//			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
