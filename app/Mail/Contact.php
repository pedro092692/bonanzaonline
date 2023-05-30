<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $info, $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($createForm)
    {
        $this->info = $createForm;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {   
        switch($this->info['subject']){
            case 1:
                $this->subject = "Mas informacion sobre un producto";
            break;

            case 2:
                $this->subject = "Tengo un problema con un pago";
            break;

            case 3:
                $this->subject = "Solicitud de trabajo";
            break;

            case 4:
                $this->subject = "Soy un proveedor";
            break;

            case 5:
                $this->subject = "Otros";
            break;
        }
        
        return new Envelope(
            from: new Address($this->info['email']),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // dd($this->info);
        return new Content(
            view: 'mail.contact-user',
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
