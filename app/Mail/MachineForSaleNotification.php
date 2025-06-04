<?php

namespace App\Mail;

use App\Models\Machine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MachineForSaleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $machine;

    /**
     * Create a new message instance.
     */
    public function __construct(Machine $machine)
    {
        $this->machine = $machine;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Momento de Despedirnos! Máquina con Alta Vida Útil: ' . $this->machine->serial_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.machine-for-sale', 
            with: [
                'machineName' => $this->machine->serial_number,
                'machineId' => $this->machine->id,
                'lifetimeKm' => $this->machine->lifetime_km,
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
        return [];
    }
}
