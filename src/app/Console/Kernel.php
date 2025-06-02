<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Artisanコマンドを定期的にスケジューリング
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('reservations:remind')->dailyAt('08:00');
    }

    /**
     * アプリケーションのコマンド登録
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
