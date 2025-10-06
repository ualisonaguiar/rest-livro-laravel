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
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Process send mail: " . $this->user->getEmail());

        try {
            Mail::to($this->user->getEmail())->send(new UsuarioRegistradoMail($this->user, $this->senha));
        } catch (Throwable $exception) {
            Log::error("Failed send mail: " . $this->user->getEmail());

            throw $exception;
        }
    }

    public function failed(Throwable $exception): void
    {
        Log::critical("Falha permanente no envio de e-mail para {$this->user->getEmail()}. Erro: " . $exception->getMessage());
    }
}
