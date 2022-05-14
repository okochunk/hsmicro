<?php

use App\UserNotification;
use Illuminate\Database\Seeder;

class UserNotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_notifaction              = new UserNotification();
        $user_notifaction->uuid        = 'un123-456';
        $user_notifaction->title       = 'Test Warning Notification';
        $user_notifaction->is_active   = TRUE;
        $user_notifaction->description = 'Test Warning Notification Description Here';
        $user_notifaction->start_date  = \Carbon\Carbon::now();
        $user_notifaction->end_date    = \Carbon\Carbon::now();
        $user_notifaction->save();

        $user_notifaction              = new UserNotification();
        $user_notifaction->uuid        = 'un321-654';
        $user_notifaction->title       = 'Test Warning Notification When Not Active';
        $user_notifaction->is_active   = FALSE;
        $user_notifaction->description = 'Test Warning Notification Description Here';
        $user_notifaction->start_date  = \Carbon\Carbon::now();
        $user_notifaction->end_date    = \Carbon\Carbon::now();
        $user_notifaction->save();

        $user_notifaction              = new UserNotification();
        $user_notifaction->uuid        = 'un321-654';
        $user_notifaction->title       = 'Test OLD Warning Notification When Not Active';
        $user_notifaction->is_active   = FALSE;
        $user_notifaction->description = 'Test Warning Notification Description Here';
        $user_notifaction->start_date  = \Carbon\Carbon::now();
        $user_notifaction->end_date    = \Carbon\Carbon::now();
        $user_notifaction->save();
    }
}
