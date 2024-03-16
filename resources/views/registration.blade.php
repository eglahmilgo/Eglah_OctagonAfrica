
@extends('layout')
@section('title', 'Registration')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('registration.post') }}" method="POST" id="Form">
                @csrf

                <div class="mb-3">
                    <label for="InputName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="InputName" name="name">
                </div>

                <div class="mb-3">
                    <label for="InputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordInput" name="password">
                </div>
                or
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="useFingerprint" name="useFingerprint">
                    <label class="form-check-label" for="useFingerprint">Use Fingerprint</label>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const useFingerprintCheckbox = document.getElementById('useFingerprint');
        const passwordInput = document.getElementById('passwordInput');

        useFingerprintCheckbox.addEventListener('change', function () {
            if (this.checked) {
                passwordInput.type = 'hidden', 'show password';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
</script>

@endsection
