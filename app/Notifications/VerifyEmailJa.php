<?php

namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Notifications\Notification;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;


class VerifyEmailJa extends Notification
{
   /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('本登録'))
            ->line(Lang::getFromJson('以下の認証リンクをクリックして本登録を完了させてください。'))
            ->action(Lang::getFromJson('メールアドレスを認証する'), $this->verificationUrl($notifiable))//$verificationUrl)
            ->line('このリンクの有効期限は60分です。')
            ->line(Lang::getFromJson('もしこのメールに覚えが無い場合は破棄してください。'));
            
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            //'verification.verify', //遷移先を変更する2020.06.22
            'auth.verify_main',
            //Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
             Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey()]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
