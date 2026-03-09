<?php

namespace App\Notifications;

use App\Services\PasswordReset\PasswordResetService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PasswordResetCode extends Notification implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $tries   = 3;
    public $timeout = 60;
    public $backoff = [30, 60, 120];

    public function __construct(private readonly string $code) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Código de restablecimiento - Sistema Defensa Civil')
            ->view('emails.password-reset', [
                'user' => $notifiable,
                'code' => $this->code,
                'expirationMinutes' => PasswordResetService::EXPIRATION_MINUTES
            ]);
    }

    public function failed(\Exception $exception): void
    {
        Log::error('PasswordResetCode email falló: ' . $exception->getMessage());
    }
}