<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\DB;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;
     public $token;
     public $email;

     public $company;

    /**
     * Create a new message instance.
     */
    public function __construct($token,$email)
    {
        $this->token = $token;
         $this->email = $email;
        $this->company = DB::table('company_profiles')->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forget Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email::forgetPassword', // ini path view yang kamu buat nanti
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}