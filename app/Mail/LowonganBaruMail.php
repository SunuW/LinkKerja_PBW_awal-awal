<?php
 
namespace App\Mail;
 
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
 
class LowonganBaruMail extends Mailable
{
    use Queueable, SerializesModels;
 
    public function __construct(public Lowongan $lowongan, public User $penerima)
    {
    }
 
    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Lowongan baru: ' . $this->lowongan->judul_posisi);
    }
 
    public function content(): Content
    {
        return new Content(view: 'emails.lowongan-baru');
    }
}
