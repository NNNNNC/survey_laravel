<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{
    // Show the introduction page (Home)
    public function show()
    {
        return view('survey.intro');
    }

    // Show Step 1 Form
    public function form1()
    {
        return view('survey.form1');
    }

    // Show Step 2 Form
    public function form2()
    {
        return view('survey.form2');
    }

    // Show Step 3 Form
    public function form3()
    {
        return view('survey.form3');
    }

    // Store Step 1 Data
    public function storeStep1(Request $request)
    {
        $request->validate([
            'client_type' => 'required|string',
            'date' => 'required|date',
            'age' => 'required|integer|min:0|max:120',
            'sex' => 'required|string',
            'office_visited' => 'required|string',
            'service' => 'required|string',
        ]);

        // Store Step 1 data in session
        session(['survey_data' => $request->all()]);

        return redirect()->route('survey.step2')->with('success', 'Step 1 completed successfully!');
    }

    // Store Step 2 Data
    public function storeStep2(Request $request)
    {
        $request->validate([
            'staff_friendliness' => 'required|integer|between:1,5',
            'efficiency' => 'required|integer|between:1,5',
            'clarity' => 'required|integer|between:1,5',
        ]);

        // Merge with existing session data
        session()->put('survey_data', array_merge(session('survey_data', []), $request->all()));

        return redirect()->route('survey.step3')->with('success', 'Step 2 completed successfully!');
    }

    // Handle Final Submission (Step 3)
    public function storeFinal(Request $request)
    {
        $request->validate([
            'service_satisfaction' => 'required|integer|between:1,5',
            'transaction_time' => 'required|integer|between:1,5',
            'comments' => 'nullable|string|max:1000',
        ]);

        // Retrieve session data safely
        $surveyData = session('survey_data', []);

        // Merge with final step data
        $surveyData = array_merge($surveyData, $request->all());

        // Check if Survey model exists and save data
        if (class_exists(Survey::class)) {
            Survey::create($surveyData);
        }

        // Clear session data after submission
        session()->forget('survey_data');

        // Redirect to home page with success message
        return redirect('/');
    }
}
