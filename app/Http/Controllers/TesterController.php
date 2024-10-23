<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TesterController extends Controller
{
    public function runTest(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:c',
        ]);

        // Store the uploaded file
        $path = $request->file('file')->store('tester/files');
        $baseFileName = str_replace('.c', '', basename($path));
        $resultFilename = $baseFileName . '_release.log';

        TestJob::dispatchSync($baseFileName, $resultFilename);

        return response('Your results will be soon available at ' . route('results', $resultFilename));
    }

    public function getResults(Request $request, string $fileName)
    {
        $path = '/results/' . $fileName;
        if (!Storage::disk('public')->exists($path))
            return response('Working on it');
        $content = Storage::disk('public')->get($path);
        return response($content)->header('Content-Type', 'text/plain');
    }
}
