<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $isConfirmation;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data, bool $isConfirmation = false)
    {
        $this->data = $data;
        $this->isConfirmation = $isConfirmation;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        if ($this->isConfirmation) {
            return $this->subject('Confirmation de réception - Khara Consulting')
                ->view('emails.contact-confirmation')
                ->with('data', $this->data);
        }

        return $this->subject('Nouveau message de contact - Khara Consulting')
            ->view('emails.contact-notification')
            ->with('data', $this->data);
    }
}
