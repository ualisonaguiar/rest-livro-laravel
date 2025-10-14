<?php

namespace App\Jobs;

use App\Mail\UsuarioRegistradoMail;
use App\Models\Users;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EnvioEmailCadastroUsuarioJob implements ShouldQueue
{
    use Queueable;

    public $tries = 5;
    public $backoff = [10, 30, 60, 120, 300];

    private Users $user;
    private String $senha;

    /**
     * Create a new job instance.
     */
    public function __construct(Users $user, String $senha)
    {
        $this->user = $user;
        $this->senha = $senha;
        $this->onQueue('envio_email_cadastro_usuario');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info("Process send mail: " . $this->user->getEmail());
            $mailable = new UsuarioRegistradoMail($this->user, $this->senha);

            Mail::to($this->user->getEmail(), $this->user->getNome())->send($mailable);
        } catch (Throwable $exception) {

            Log::error('Falha ao enviar e-mail: ' . $this->user->getEmail(), [
                'erro' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
            
            EnviarEmailFalhaJob::dispatch($this->user->getEmail(), $mailable);
        }
    }

    public function failed(Throwable $exception): void
    {
        Log::critical("Falha no envio de e-mail para {$this->user->getEmail()}. Erro: " . $exception->getMessage());
    }
}
