<?php

namespace App\Console;

use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){
            $time = now()->subMinute(10);
            $orders = Order::where('status', 1)->whereTime('created_at', '<=', $time)->get();
            foreach($orders as $order){
                $items = json_decode($order->content);
                foreach($items as $item){
                    increase($item);
                }
        
                $order->status = 5;
                $order->save();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
