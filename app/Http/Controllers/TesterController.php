<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class TesterController extends Controller
{

    public function runTest(Request $request)
    {
        if (!$request->exists('functions'))
            return redirect()->back()->with('error', 'No function selected');

        $functions = $request->get('functions');
        $unsupported = collect($functions)->diff(collect(config('app.supported_functions')));

        if ($unsupported->count() > 0)
            return response('Unsupported functions: ' . $unsupported->implode(','));
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:c',
        ]);

        // Store the uploaded file
        $path = $request->file('file')->store('tester/files');
        $baseFileName = str_replace('.c', '', basename($path));

        TestJob::dispatch($baseFileName, $functions);

        return view('submitted', ['url' => URL::route('results', $baseFileName)]);
    }

    public function getResults(Request $request, string $fileName)
    {
        $fileSubmitted = Storage::disk('local')->exists('tester/files/' . $fileName . '.c');
        $path = '/results/' . $fileName . '_release.valgrind';
        $content = Storage::disk('public')->get($path);
        if ($content != null)
            return view('results', ['result' => $content]);
        else if (!$fileSubmitted)
            return view('home');
        return view('submitted', ['url' => URL::route('results', $fileName)]);
    }
}
