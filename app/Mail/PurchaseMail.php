<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param  \LaravelDaily\Invoices\Invoice  $invoice
     * @param  \App\Models\Order  $order
     */
    public function __construct($invoice, $order)
    {
        $this->invoice = $invoice;
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Facture de votre commande');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.purchase-mail',
            with: [
                'invoice' => $this->invoice,
                'order' => $this->order,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk(
                'public',
                $this->invoice->filename,
                $this->invoice->filename.'.pdf'
            ),
        ];
    }
}
