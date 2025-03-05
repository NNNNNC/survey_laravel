<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Models\Survey;

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
        return view('survey.form1');
    }

    public function form2()
    {
        Log::info('Survey step 2 form viewed.');
        Log::info('Survey step 2 form viewed.', ['session_data' => session('survey_data')]);
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
            'office_visited' => 'required|string',
            'service' => 'required|string',
        ]);

        // Store in session explicitly
        session()->put('survey_data', $validatedData);

        Log::info('Step 1 data stored successfully.', ['session_data' => session('survey_data')]);

        return redirect()->route('survey.step2')->with('success', 'Step 1 completed successfully!');
    }

    public function storeStep2(Request $request)
    {
        Log::info('Attempting to store step 2 data.', ['data' => $request->all()]);

        $validatedData = $request->validate([
            'awareness' => 'required|int',
            'visibility' => 'required|int',
            'helpfulness' => 'required|int',
        ]);

        Log::info('Session before step 2 merge.', ['session_data' => session('survey_data')]);

        // Merge Step 2 data into session
        $surveyData = session('survey_data', []);
        $surveyData = array_merge($surveyData, $validatedData);
        session()->put('survey_data', $surveyData);

        Log::info('Step 2 data stored successfully.', ['session_data' => session('survey_data')]);

        return redirect()->route('survey.step3')->with('success', 'Step 2 completed successfully!');
    }
    public function storeFinal(Request $request)
    {
        Log::info('Attempting to store final step data.', ['data' => $request->all()]);

        // Log session data BEFORE merging to check if previous steps exist
        Log::info('Session data before final merge.', ['session_data' => session('survey_data')]);

        $validatedData = $request->validate([
            'service_satisfaction' => 'required|numeric|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        // Merge session data with final step
        $surveyData = array_replace_recursive((array) session('survey_data', []), $validatedData);
        session()->put('survey_data', $surveyData);

        // Log after merging
        Log::info('Final survey data prepared for saving.', ['survey_data' => $surveyData]);

        // Ensure the table exists before saving
        if (class_exists(Survey::class)) {
            Survey::create($surveyData);
            Log::info('Survey data saved to database.');
        } else {
            Log::warning('Survey model does not exist. Data was not saved to the database.');
        }

        // Clear session
        session()->forget('survey_data');
        Log::info('Survey session data cleared. Redirecting to home.');

        return redirect()->route('survey.intro.php')->with('success', 'Survey submitted successfully!');
    }

}
