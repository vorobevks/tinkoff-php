<?php

namespace App\Console\Commands;

use App\Services\ShareService;
use Illuminate\Console\Command;

class ShareUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shares:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление котировок акций';

    /**
     * Execute the console command.
     *
     * @return array
     */
    public function handle()
    {
        ShareService::updatePrices();
    }
}
