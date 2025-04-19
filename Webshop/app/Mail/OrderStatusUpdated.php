<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $oldStatus;
    public $newStatus;
    public $isPaymentStatusUpdate;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, $oldStatus, $newStatus, $isPaymentStatusUpdate = false)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->isPaymentStatusUpdate = $isPaymentStatusUpdate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $updateType = $this->isPaymentStatusUpdate ? 'fizetési státusz' : 'rendelési státusz';
        return new Envelope(
            subject: 'Rendelésed státusza megváltozott - ' . $this->order->order_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-status-updated',
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