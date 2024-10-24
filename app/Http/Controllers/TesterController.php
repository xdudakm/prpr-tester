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
        $resultFilename = $baseFileName . '_release.log';

        TestJob::dispatch($baseFileName, $resultFilename, $functions);

        return view('submitted', ['url' => URL::signedRoute('results', $resultFilename)]);
    }

    public function getResults(Request $request, string $fileName)
    {
        if ($request->hasValidSignature()) {
            $path = '/results/' . $fileName;
            $content = Storage::disk('public')->get($path);
            if ($content != null)
                return view('results', ['result' => $content]);
            return view('submitted', ['url' => Url::signedRoute('results', $fileName)]);
        }
        return view('home');
    }
}
