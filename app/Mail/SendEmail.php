<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    public $isi_email;
    protected $viewName;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isi_email,$viewName = null)
    {
        $this->isi_email = $isi_email;
        $this->viewName = $viewName ?? 'admin.email.email';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Selamat datang!')
        ->view($this->viewName);
        // ->text('admin.email.plain');
    }
}