<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\DB;

class VerifikasiEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $link;
    public $uuid;
    public $company;
    

    /**
     * Create a new message instance.
     */
  public function __construct($link, $uuid)
    {
        $this->link = $link;
        $this->uuid = $uuid;
        $this->company = DB::table('company_profiles')->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifikasi Email Anda',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email::verifikasi', // ini path view yang kamu buat nanti
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