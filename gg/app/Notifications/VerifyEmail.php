<?php

namespace App\Notifications;

use App\Mail\EmailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        /*return new EmailVerification($this->verificationUrl($notifiable), $notifiable);*/
        return (new MailMessage)
            ->greeting('Selamat Datang di Gonigoni!')
            ->subject('Verifikasi alamat email')
            ->line('Harap konfirmasi bahwa anda ingin menggunakan ini sebagai alamat email akun Gonigoni anda.')
            ->action(
                'Verifikasi Email',
                $verificationUrl
            )
            ->line('Jika anda merasa tidak pernah melakukan pendaftaran pada Gonigoni, silahkan abaikan email ini.')
            ->line('Terima kasih telah menggunakan aplikasi kami!')
            ->salutation(' ');
    }
}
