<!-- resources/views/contact/form.blade.php -->

@extends('layouts.master')

{{-- Pass body class to master layout --}}
@section('body-class', 'contact-page')

@section('content')
<div class="container-fluid h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-12 d-flex justify-content-center align-items-center h-100">
            <div class="card shadow-lg"
                 style="width: 50%; background-color: rgba(255, 255, 255, 0.85); padding: 2rem; border-radius: 16px; margin-top: 100px;">
                <h3 class="text-center mb-4">Contact Us</h3>
                <form method="POST" action="{{ route('contact.form') }}" class="row g-3 text-center">
                    @csrf

                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="col-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
