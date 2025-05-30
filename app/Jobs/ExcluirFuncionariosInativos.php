<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExcluirFuncionariosInativos implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Data limite: 30 dias 
        $limite = Carbon::now()->subDays(10);

        $usuarios = User::where('active', 0)
                        ->where('updated_at', '<=', $limite)
                        ->get();

        foreach ($usuarios as $usuario) {
            $usuario->delete();
        }
    }
}
