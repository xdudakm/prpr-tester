<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

class TestJob implements ShouldQueue
{
    use Queueable;

    private string $fileName;
    private string $resultsFileName;

    /**
     * Create a new job instance.
     */
    public function __construct(string $fileName, $resultsFileName)
    {
        $this->fileName = $fileName;
        $this->resultsFileName = $resultsFileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Inside handle function");
        Log::info(shell_exec('pwd'));
        shell_exec('cd ./storage/app/private/tester; ./tester');
        shell_exec("mv ./storage/app/private/tester/results/" . $this->resultsFileName .
            ' ./storage/app/public/results/' . $this->resultsFileName);
        shell_exec('rm ./storage/app/private/tester/*/' . $this->fileName . '*');
    }
}
