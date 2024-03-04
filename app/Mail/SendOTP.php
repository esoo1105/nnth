<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendOTP extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    /**
     * Create a new message instance.
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Send OTP')
            ->view('email')
            ->with([
                'otp' => $this->otp,
            ]);
    }

    /**
     * Generate a random OTP.
     */
    public static function generateOTP()
    {
        return rand(100000, 999999);
    }

    /**
     * Store the OTP in the database.
     */
    // public static function storeOTP($email, $otp)
    // {
    //     $expiration = now()->addMinutes(5); // Set expiration time to 5 minutes
    //     DB::table('otp_table')->updateOrInsert(
    //         ['email' => $email],
    //         ['otp' => $otp, 'expiration' => $expiration]
    //     );
    // }

}
