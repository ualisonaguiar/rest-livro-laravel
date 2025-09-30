<?php

namespace App\Mail;

use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioRegistradoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $senha;

    public function __construct(Users $usuario, String $senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function build()
    {
        return $this->subject('Bem-vindo ao sistema')
                    ->view('emails.usuario_registrado');
    }
}
