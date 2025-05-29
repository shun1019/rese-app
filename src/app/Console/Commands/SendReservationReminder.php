<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReservationReminder extends Command
{
    protected $signature = 'reservations:remind';

    protected $description = '当日予約があるユーザーへリマインダーメールを送信します';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = now()->toDateString();

        $reservations = Reservation::with('user', 'shop')
            ->where('date', $today)
            ->get();

        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)
                ->send(new ReminderMail($reservation));
        }

        $this->info('リマインダーメールを送信しました。');
    }
}
