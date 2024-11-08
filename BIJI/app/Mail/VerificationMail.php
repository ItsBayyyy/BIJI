<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Buat konstruktor yang menerima argumen $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.verification')
                    ->subject('Verifikasi Akun Anda')
                    ->with([
                        'token' => $this->user->verification_token,
                    ]);
    }
}
