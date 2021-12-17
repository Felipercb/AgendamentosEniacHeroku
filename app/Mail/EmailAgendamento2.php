<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAgendamento2 extends Mailable
{
    use Queueable, SerializesModels;

    public $infoDestinatario;
    public $infoAgendamento;
    public $data;
    public $qrcode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($infoDestinatario, $infoAgendamento, $data, $qrcode)
    {
        $this->infoDestinatario = $infoDestinatario;
        $this->infoAgendamento = $infoAgendamento;
        $this->data = $data;
        $this->qrcode = $qrcode;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Agendamento criado com Sucesso!')
            ->view('email.index2');
    }
}
