<?php

namespace App\Console\Commands;

use App\Models\Seller;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReportEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia relatório diário de vendas';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $sellers = Seller::salesDailyReport();

        foreach ($sellers as $seller) {

            $sales = $seller['value'];
            $commission = $seller['commission_value'];;

            Mail::to($seller['mail'], $seller['name'])->send(new \App\Mail\DailyReport($sales, $commission));
        }
    }
}
