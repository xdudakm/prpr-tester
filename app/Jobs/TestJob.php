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
    private array $inputFileNames;

    /**
     * Create a new job instance.
     */
    public function __construct(string $fileName, $resultsFileName, $inputFileNames)
    {
        $this->fileName = $fileName;
        $this->inputFileNames = $inputFileNames;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        exec('echo tests: > /var/www/html/storage/app/private/tester/input.yaml');
        foreach ($this->inputFileNames as $inputFileName) {
            exec("cat /var/www/html/storage/app/private/tester/scenarios/" . $inputFileName . ".yaml >> /var/www/html/storage/app/private/tester/input.yaml");
        }

        shell_exec('cd /var/www/html/storage/app/private/tester && ./tester');

        $resultsFileName = $this->fileName . '_release.log';
        shell_exec("mv /var/www/html/storage/app/private/tester/results/" . $resultsFileName .
            ' /var/www/html/storage/app/public/results/' . $resultsFileName);
        shell_exec('rm /var/www/html/storage/app/private/tester/*/' . $this->fileName . '*');
    }
}
