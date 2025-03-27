<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Survey;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    public function show()
    {
        Log::info('Survey intro page viewed.');
        return view('survey.intro');
    }

    public function form1()
    {
        Log::info('Survey step 1 form viewed.');

        // Fetch the offices and services
        $offices = Office::with('services')->get();

        // Pass both offices and services to the view
        return view('survey.form1', compact('offices'));
    }

    public function getServicesByOffice($officeId)
    {
        if (!$officeId) {
            return response()->json(['error' => 'Office ID is required'], 400);
        }

        $services = Services::where('office_id', $officeId)->get();

        if ($services->isEmpty()) {
            return response()->json(['message' => 'No services found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'services' => $services,
        ]);
    }


    public function form2()
    {
        Log::info('Survey step 2 form viewed.', ['session_data' => session('survey_data', [])]);
        return view('survey.form2');
    }

    public function form3()
    {
        Log::info('Survey step 3 form viewed.');
        return view('survey.form3');
    }

    public function storeStep1(Request $request): RedirectResponse
    {
        Log::info('Attempting to store step 1 data.', ['data' => $request->all()]);

        $validatedData = $request->validate([
            'client_type' => 'required|string',
            'date' => 'required|date',
            'age' => 'required|integer|min:0|max:120',
            'sex' => 'required|string',
            'office_visited' => 'required|integer|min:0|max:1000',
            'service' => 'required|integer|min:0|max:1000',
        ]);

        $surveyData = session('survey_data', []);
        $surveyData = array_merge($surveyData, $validatedData);

        session(['survey_data' => $surveyData]);

        Log::info('Step 1 data stored successfully.', ['session_data' => $surveyData]);

        return redirect()->route('survey.step2')->with('success', 'Step 1 completed successfully!');
    }

    public function storeStep2(Request $request): RedirectResponse
    {
        Log::info('Attempting to store step 2 data.', ['data' => $request->all()]);

        $validatedData = $request->validate([
            'awareness' => 'required|integer|min:0|max:5',
            'visibility' => 'required|integer|min:0|max:5',
            'helpfulness' => 'required|integer|min:0|max:5',
        ]);

        $surveyData = session('survey_data', []);
        $surveyData = array_merge($surveyData, $validatedData);
        session(['survey_data' => $surveyData]);

        Log::info('Step 2 data stored successfully.', ['session_data' => $surveyData]);

        return redirect()->route('survey.step3')->with('success', 'Step 2 completed successfully!');
    }

    public function storeFinal(Request $request): RedirectResponse
    {
        if (!session()->has('survey_data')) {
            return redirect()->route('survey.step1')->withErrors(['error' => 'Session expired. Please restart the survey.']);
        }

        Log::info('Attempting to store final step data.', ['data' => $request->all()]);


        $validatedData = $request->validate([
            'SQD0' => 'nullable|integer|min:1|max:5',
            'SQD1' => 'nullable|integer|min:1|max:5',
            'SQD2' => 'nullable|integer|min:1|max:5',
            'SQD3' => 'nullable|integer|min:1|max:5',
            'SQD4' => 'nullable|integer|min:1|max:5',
            'SQD5' => 'nullable|integer|min:1|max:5',
            'SQD6' => 'nullable|integer|min:1|max:5',
            'SQD7' => 'nullable|integer|min:1|max:5',
            'SQD8' => 'nullable|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
            'email' => 'nullable|email|max:255',
        ]);

        // Retrieve existing survey data from session and merge it
        $surveyData = array_merge(session('survey_data', []), $validatedData);
        session()->put('survey_data', $surveyData);

        Log::info('Final survey data prepared for saving.', ['survey_data' => $surveyData]);

        try {
            // Ensure the model exists and is properly configured
            if (class_exists(Survey::class)) {
                Survey::create($surveyData);
                Log::info('Survey data saved to database.');
            } else {
                Log::warning('Survey model does not exist. Data was not saved to the database.');
            }
        } catch (\Exception $e) {
            Log::error('Error saving survey data.', ['error' => $e->getMessage()]);
            return redirect()->route('survey.step3')->withErrors(['error' => 'An error occurred while saving your survey. Please try again.']);
        }

        // Clear session data after saving
        session()->forget('survey_data');
        Log::info('Survey session data cleared. Redirecting to home.');

        return redirect()->route('survey.intro')->with('success', 'Thank you for visiting Palawan State University! Your survey has been submitted successfully.');
    }
}
