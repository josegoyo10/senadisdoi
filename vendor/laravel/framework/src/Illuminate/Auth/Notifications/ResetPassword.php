<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

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
        return (new MailMessage)
            //->line('You are receiving this email because we received a password reset request for your account.')
            //->action('Reset Password', url('password/reset', $this->token))
            //->line('If you did not request a password reset, no further action is required.');
            // Se usa las vistas de correos en español. jose.escalante
            ->line('Usted esta recibiendo este correo porque recibimos un requerimiento para reiniciar la contraseña de su cuenta.') 
            ->action('Reiniciar su contraseña', url('password/reset', $this->token)) 
            ->line('Si no solicitó un restablecimiento de contraseña, no se requiere realizar la acción.'); 
 
    }
}
