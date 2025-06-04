<?php

namespace App\Mail;

use App\Models\Machine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Assignment;

class MaintenanceNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $machine;
    public $assignment;
    
    public function __construct( Machine $machine, Assignment $assignment )
    {
        $this->machine = $machine;
        $this->assignment = $assignment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alerta de Mantenimiento Requerido para Máquina: ' . $this->machine->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.maintenance-notification',
            with: [
                'machineName' => $this->machine->serial_number,
                'machineId' => $this->machine->id,
                'currentKm' => $this->machine->current_km, 
                'kmAtLastMaintenance' => $this->machine->lifetime_km, 
                'assignmentId' => $this->assignment->id,
                'kmTraveledAssignment' => $this->assignment->km_traveled,
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
