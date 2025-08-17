<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $messageModel;

    public function __construct(ContactMessage $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    public function build()
    {
        return $this->subject('Nieuw contactformulier')
            ->view('emails.contact')
            ->with(['m' => $this->messageModel]);
    }
}
