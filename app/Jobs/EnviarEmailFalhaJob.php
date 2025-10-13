<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnviarEmailFalhaJob implements ShouldQueue
{
    use Queueable;

    private string $email;
    private Mailable $mailable;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email, Mailable $mailable)
    {
        $this->email = $email;
        $this->mailable = $mailable;
        $this->onQueue('fila_falha_enviar_email');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->send($this->mailable);
        } catch (\Exception $exception) {
            Log::error('Falha ao enviar e-mail: ' . $this->email, [
                'erro' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
            EnviarEmailFalhaJob::dispatch($this->email, $this->mailable);
        }
    }
}
