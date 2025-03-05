@extends('layout.app')

@section('title', 'Client Satisfaction Survey - Step 2')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="margin-top: 120px; padding-bottom: 50px;">
    <div class="container shadow p-5 rounded bg-white" style="max-width: 900px;">
        <h1 class="text-center mb-4">Client Satisfaction Survey - Step 2</h1>

        <h5><strong>INSTRUCTIONS:</strong> Check mark (✔) your answer to the Citizen's Charter (CC) questions. The Citizen's Charter is an official document that reflects the services of a government agency/office, including its requirements, fees, and processing times.</h5>

        <form action="{{ route('survey.step3') }}" method="GET">
            @csrf

            <fieldset class="mt-4">
                <legend class="fw-bold">CC 1: Awareness of the Citizen's Charter</legend>
                <p>Which of the following best describes your awareness of a CC?</p>

                <div class="form-check">
                    <input class="form-check-input" id="a1" type="checkbox" name="awareness[]" value="1">
                    <label class="form-check-label" for="a1">I know what a CC is and I saw this office's CC.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="a2" type="checkbox" name="awareness[]" value="2">
                    <label class="form-check-label" for="a2">I know what a CC is but I did NOT see this office's CC.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="a3" type="checkbox" name="awareness[]" value="3">
                    <label class="form-check-label" for="a3">I learned of the CC only when I saw this office's CC.</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="a4" type="checkbox" name="awareness[]" value="4">
                    <label class="form-check-label" for="a4">I do not know what a CC is and I did not see one in this office.</label>
                </div>
            </fieldset>

            <fieldset class="mt-4">
                <legend class="fw-bold">CC 2: Visibility of the Citizen's Charter</legend>
                <p>If aware of CC (answered 1-3 in CC1), would you say that the CC of this office was ...?</p>

                <div class="form-check">
                    <input class="form-check-input" id="v1" type="checkbox" name="visibility[]" value="1">
                    <label class="form-check-label" for="v1">Easy to see (Madaling makita)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="v2" type="checkbox" name="visibility[]" value="2">
                    <label class="form-check-label" for="v2">Somewhat easy to see (Medyo madaling makita)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="v3" type="checkbox" name="visibility[]" value="3">
                    <label class="form-check-label" for="v3">Difficult to see (Mahirap makita)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="v4" type="checkbox" name="visibility[]" value="4">
                    <label class="form-check-label" for="v4">Not visible at all (Hindi makita)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="v5" type="checkbox" name="visibility[]" value="5">
                    <label class="form-check-label" for="v5">N/A (Hindi naaangkop)</label>
                </div>
            </fieldset>

            <fieldset class="mt-4">
                <legend class="fw-bold">CC 3: Helpfulness of the Citizen's Charter</legend>
                <p>If aware of CC (answered 1-3 in CC1), how much did the CC help you in your transaction?</p>

                <div class="form-check">
                    <input class="form-check-input" id="h1" type="checkbox" name="helpfulness[]" value="1">
                    <label class="form-check-label" for="h1">Helped very much (Sobrang nakatulong)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="h2" type="checkbox" name="helpfulness[]" value="2">
                    <label class="form-check-label" for="h2">Somewhat helped (Nakatulong naman)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="h3" type="checkbox" name="helpfulness[]" value="3">
                    <label class="form-check-label" for="h3">Did not help (Hindi nakatulong)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="h4" type="checkbox" name="helpfulness[]" value="4">
                    <label class="form-check-label" for="h4">N/A (Hindi naaangkop)</label>
                </div>
            </fieldset>
            <br>
            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-outline-primary" href="{{ route('survey.step1') }}">Back</a>
                <button class="btn btn-primary" type="submit">Next</button>
            </div>
        </form>
    </div>
</div>

@endsection
