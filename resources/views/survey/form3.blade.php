@extends('layout.app')

@section('content')
<div class="container" style="margin-top: 140px;">
    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Survey Form Container -->
    <div class="card mt-4 p-4 shadow">
        <div class="card-body">
            <h1 class="text-center mb-4">Client Satisfaction Survey - Step 3</h1>
            <hr>

            <form action="{{ route('survey.storeFinal') }}" method="POST">
                @csrf

                <input type="hidden" name="service_satisfaction" id="averageInput">

                <h5 class="text-muted text-center mb-4 h-100">
                    Please rate your satisfaction for the following aspects of the service you received. <br>
                    <small>(☹️ = Very Dissatisfied, 😀 = Very Satisfied)</small>
                </h5>

                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                @php
                                    $emoji = ["☹️","🙁","😐","🙂","😀"];
                                @endphp
                                <th class="text-center">Questions</th>
                                @for ($i = 0; $i < count($emoji); $i++)
                                    <th>{{ $emoji[$i] }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $questions = [
                                    'question1' => 'SQDO. I am satisfied with the service that I availed.',
                                    'question2' => 'SQD1. I spent a reasonable amount of time for my transaction.',
                                    'question3' => "SQD2. The office followed the transaction's requirements and steps.",
                                    'question4' => "SQD3. The steps for my transaction were easy and simple.",
                                    'question5' => "SQD4. I easily found information about my transaction.",
                                    'question6' => "SQD5. I paid a reasonable amount of fees for my transaction.",
                                    'question7' => "SQD6. I feel the office was fair to everyone, or 'walang palakasan'.",
                                    'question8' => "SQD7. I was treated courteously by the staff.",
                                    'question9' => "SQD8. I got what I needed from the government office.",
                                ];
                            @endphp

                            @foreach ($questions as $key => $question)
                                <tr>
                                    <td class="text-start fw-bold">{{ $question }}</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input class="form-check-input" type="radio" name="{{ $key }}" value="{{ $i }}" required>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <label for="comment">Comment: </label>
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>

                <h4 id="averageScore" class="text-center mt-3">Average Score: N/A</h4>

                <div class="d-flex justify-content-between mt-4">
                    <a class="btn btn-outline-primary px-4" href="{{ route('survey.step2') }}">Back</a>
                    <button class="btn btn-primary" type="submit" id="submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const submitBtn = document.getElementById("submitBtn");
        const averageInput = document.getElementById("averageInput");
        const averageScoreDisplay = document.getElementById("averageScore");

        function calculateAverage() {
            let total = 0;
            let count = 0;

            document.querySelectorAll("input[type='radio']:checked").forEach(input => {
                total += parseInt(input.value);
                count++;
            });

            let average = count > 0 ? (total / count).toFixed(2) : "N/A";

            // Update the hidden input and display
            averageInput.value = count > 0 ? average : "";
            averageScoreDisplay.innerText = `Average Score: ${average}`;
        }

        document.querySelectorAll("input[type='radio']").forEach(input => {
            input.addEventListener("change", calculateAverage);
        });

        form.addEventListener("submit", function () {
            submitBtn.disabled = true;
        });
    });
</script>
@endsection


<!-- ☹️🙁😐🙂😀 -->