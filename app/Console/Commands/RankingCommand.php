<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use App\Services\AppstoreService;
use App\Iphone;

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
	protected $description = 'Update Appstore, Android market, and Alexa ranking';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(AppstoreService $appstoreService)
	{
		parent::__construct();
        $this->appstoreService = $appstoreService;
	}

    /**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $ranking = $this->appstoreService->getRanking(100);

        $appList = [];
        foreach ($ranking as $app) {
            $exist = Iphone::where('url', '=', $app->url)->first();
            if ($exist) continue;
            $app->save();
            $appList[] = $app;
        }

        $this->info(count($appList) . "件アップデートしました");
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
