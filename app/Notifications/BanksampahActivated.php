<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BanksampahActivated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Akun anda telah aktif')
            ->greeting('Selamat! akun anda telah aktif.')
            ->line('Administrator telah menerima akun anda, silahkan login dengan mengklik tombol dibawah.')
            ->action('Masuk ke Gonigoni', route('login'))
            ->line('Terima kasih telah menggunakan aplikasi kami!')
            ->salutation(' ');
    }
}
