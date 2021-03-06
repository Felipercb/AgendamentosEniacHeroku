<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailAgendamento extends Mailable
{
    use Queueable, SerializesModels;

    public $info;
    public $data;
    public $qrcode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info, $data, $qrcode)
    {
        $this->info = $info;
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
            ->view('email.index');
    }
}
