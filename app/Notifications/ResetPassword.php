<?php

namespace App\Notifications;

use App\Mail\EmailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends ResetPasswordBase
{
    use Queueable;

    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->greeting('Permintaan Atur Ulang Kata Sandi')
            ->subject('Permintaan Atur Ulang Kata Sandi')
            ->line('Anda menerima email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun anda.')
            ->action('Atur Ulang Kata Sandi',
                url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::get('Link pengaturan ulang kata sandi ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Jika anda tidak pernah meminta pengaturan ulang kata sandi untuk akun anda, silahkan abaikan email ini.'))
            ->salutation(' ');
    }
}
