@extends('layout.app')

@section('title', 'Client Satisfaction Survey')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;0,700;0,800;1,500;1,600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
    }

    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
</style>

<div class="d-flex justify-content-center align-items-center vh-100" style="z-index: 2;">
    <div class="text-center">
        @if(session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        <img class="d-block mx-auto mb-4"
            src="{{ asset('images/psu_seal_black.png') }}"
            alt="PSU Seal"
            width="150">
        
        <h1 class="text-white display-5  text-shadow">HELP US SERVE YOU BETTER</h1>
        
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4 text-white text-shadow">
                This Client Satisfaction Measurement (CSM) tracks the customer experience of government offices.
                Your feedback on your recently concluded transaction will help this office provide a better service.
                Personal information shared will be kept confidential, and you always have the option to not answer this form.
            </p>
        </div>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center shadow">
            <a href="{{ route('survey.step1') }}" class="btn btn-primary btn-lg px-4 gap-3">Start Survey</a>
        </div>
    </div>
</div>

</div>

@endsection