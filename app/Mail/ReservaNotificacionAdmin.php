<?php

namespace App\Mail;

use App\Models\SemanaCasilla;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservaNotificacionAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public SemanaCasilla $semana,
        public string $nombre,
        public string $email,
        public ?string $tlf = null,
        public ?string $observaciones = null,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva solicitud de reserva - Semana '.$this->semana->numero_sem.' ('.$this->semana->anyo.')',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reserva-admin',
        );
    }
}
