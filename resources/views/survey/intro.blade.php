@extends('layout.app')

@section('title', 'Client Satisfaction Survey')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <img class="d-block mx-auto mb-4" src="{{ asset('images/psu_seal_black.png') }}" alt="PSU Seal" width="150">
        <h1 class="display-5 fw-bold text-body-emphasis">HELP US SERVE YOU BETTER</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                This Client Satisfaction Measurement (CSM) tracks the customer experience of government offices. 
                Your feedback on your recently concluded transaction will help this office provide a better service. 
                Personal information shared will be kept confidential, and you always have the option to not answer this form.
            </p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="{{ route('survey.step1') }}" class="btn btn-primary btn-lg px-4 gap-3">Start Survey</a>
            </div>
        </div>
    </div>
</div>

@endsection
