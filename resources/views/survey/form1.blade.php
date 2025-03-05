@extends('layout.app')

@section('title', 'Client Satisfaction Survey - Step 1')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="margin-top: 200px;">
    <div class="container shadow p-4 rounded bg-white" style="max-width: 700px;">
        <h1 class="text-center">Client Satisfaction Survey - Step 1</h1>
        <hr>
        <br>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('survey.storeStep1') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="client_type">Client Type:</label>
                <select class="form-select" id="client_type" name="client_type" required>
                    <option value="" disabled {{ old('client_type') ? '' : 'selected' }}>Select Type</option>
                    <option value="Citizen" {{ old('client_type') == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                    <option value="Business" {{ old('client_type') == 'Business' ? 'selected' : '' }}>Business</option>
                    <option value="Government" {{ old('client_type') == 'Government' ? 'selected' : '' }}>Government (Employee or another agency)</option>
                </select>
            </div>

            <div class="d-flex gap-3">
                <div class="mb-3 flex-fill">
                    <label class="form-label" for="date">Date Visited:</label>
                    <input class="form-control" type="date" id="date" name="date" value="{{ old('date') }}" required>
                </div>
                <div class="mb-3 flex-fill">
                    <label class="form-label" for="age">Age:</label>
                    <input class="form-control" type="number" id="age" name="age" min="0" max="120" value="{{ old('age') }}" required>
                </div>
            </div>

            <label class="form-label mb-2">Sex:</label>
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="sex" value="Male" {{ old('sex') == 'Male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="sex" value="Female" {{ old('sex') == 'Female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <div class="d-flex gap-3">
                <div class="mb-3 flex-fill">
                    <label class="form-label" for="office_visited">Office Visited:</label>
                    <input class="form-control" type="text" id="office_visited" name="office_visited" value="{{ old('office_visited') }}" required>
                </div>
                <div class="mb-3 flex-fill">
                    <label class="form-label" for="service">Service Availed:</label>
                    <input class="form-control" type="text" id="service" name="service" value="{{ old('service') }}" required>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a class="btn btn-outline-primary" href="{{ route('survey.intro') }}">Back</a>
                <button class="btn btn-primary" type="submit">Next</button>
            </div>
        </form>
    </div>
</div>

@endsection
