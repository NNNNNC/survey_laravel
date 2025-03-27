    @extends('layout.app')

    @section('content')

    <style>
        /* Custom styling for radio buttons */
        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #000;
            /* Black border for visibility */
            background-color: #fff;
            /* White background */
            appearance: none;
            /* Remove default styling */
            border-radius: 50%;
            /* Make it circular */
            outline: none;
            cursor: pointer;
            transition: 0.2s all ease-in-out;
        }

        /* Change border color on hover */
        .form-check-input:hover {
            border-color: #007bff;
            /* Bootstrap primary color */
        }

        /* Style for checked radio button */
        .form-check-input:checked {
            background-color: #007bff;
            /* Blue fill when selected */
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
    <div class="container" style="margin-top: 140px;">
        <div class="card mt-4 p-4 shadow">
            <div class="card-body">
                <h1 class="text-center mb-4">Client Satisfaction Survey - Step 3</h1>
                <hr>

                <form action="{{ route('survey.storeFinal') }}" method="POST">
                    @csrf

                    <h5 class="text-muted text-center mb-4 h-100">
                        Please rate your satisfaction for the following aspects of the service you received. <br>
                        <small>(☹️ = <span class="text-danger">Strongly Disagree</span>, 😀 = <span class="text-success">Strongly Agree</span>, <span class="text-primary">Leave blank if not applicable</span>)</small>
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    @php
                                    $ratings = [
                                    ["emoji" => "☹️", "text" => "Strongly Disagree"],
                                    ["emoji" => "🙁", "text" => "Disagree"],
                                    ["emoji" => "😐", "text" => "Neither Agree nor Disagree"],
                                    ["emoji" => "🙂", "text" => "Agree"],
                                    ["emoji" => "😀", "text" => "Strongly Agree"]
                                    ];
                                    @endphp
                                    <th class="text-center" style="width: 40%; vertical-align: middle;"><h5>Questions</h5></th>
                                    @foreach($ratings as $rating)
                                    <th style="width: 5%; text-align: center; vertical-align: top;">
                                        <div class="d-flex flex-column align-items-center text-center" style="word-wrap: break-word; overflow-wrap: break-word; max-width: 100%;">
                                            <span style="font-size: 1.5rem;">{{ $rating['emoji'] }}</span>
                                            <small style="line-height: 1.2;">{{ $rating['text'] }}</small>
                                        </div>
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $questions = [
                                'SQD0' => 'SQDO. I am satisfied with the service that I availed.',
                                'SQD1' => 'SQD1. I spent a reasonable amount of time for my transaction.',
                                'SQD2' => "SQD2. The office followed the transaction's requirements and steps.",
                                'SQD3' => "SQD3. The steps for my transaction were easy and simple.",
                                'SQD4' => "SQD4. I easily found information about my transaction.",
                                'SQD5' => "SQD5. I paid a reasonable amount of fees for my transaction.",
                                'SQD6' => "SQD6. I feel the office was fair to everyone, or 'walang palakasan'.",
                                'SQD7' => "SQD7. I was treated courteously by the staff.",
                                'SQD8' => "SQD8. I got what I needed from the government office.",
                                ];
                                @endphp

                                @foreach ($questions as $key => $question)
                                <tr>
                                    <td class="text-start fw-bold">{{ $question }}</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                        <input class="form-check-input" type="radio" name="{{ $key }}" value="{{ $i }}">
                                        </td>
                                        @endfor
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <label for="email" class="form-label fw-bold">Email Address (Optional):</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        <label for="comment" class="fw-bold mt-3">Comment (Optional): </label>
                        <textarea name="comments" id="comments" class="form-control mt-2" placeholder="Enter your comments"></textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a class="btn btn-outline-primary px-4" href="{{ route('survey.step2') }}">Back</a>
                        <button class="btn btn-primary" type="submit" id="submitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const submitBtn = document.getElementById("submitBtn");

            form.addEventListener("submit", function() {
                submitBtn.disabled = true;
            });
        });
    </script>
    @endsection