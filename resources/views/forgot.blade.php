@extends('layouts.layout')

@section('title')
    Login
@endsection

@section('content')
    @push('style')
        <style>
            /* Animation Styles */
            .card {
                opacity: 0;
                transition: opacity 0.7s ease-in-out, transform 0.7s ease-in-out;
                transform: translateY(-30px);
            }

            .card.show {
                opacity: 1;
                transform: translateY(0);
            }

            .card.hide {
                opacity: 0;
                transform: translateY(30px);
            }
        </style>
    @endpush

    <x-form class="card">
        <x-slot:title>
            Forgot Password
        </x-slot:title>

        <x-slot:route>
            {{ route('password.email') }}
        </x-slot:route>

        <x-input-email>
            Email
        </x-input-email>


        <x-button-submit>
            Login
        </x-button-submit>

        <!-- Link to Register and Forgot Password -->
        <x-slot:haveLogin>
            Remember Password <a href="{{ route('login') }}" onclick="goToLogin(event)">Login</a>
        </x-slot:haveLogin>

        @error('email')
            <p class="mt-3 text-center text-danger">
                {{ $message }}
            </p>
        @enderror
    </x-form>

    @push('scripts')
        <script>
            
            function goToLogin(event) {
                event.preventDefault();
                const card = document.querySelector('.card');
                card.classList.add('hide');
                setTimeout(function() {
                    window.location.href = "{{ route('login') }}";
                }, 700); // Match this duration to the CSS transition time
            }

            window.onload = function() {
                setTimeout(function() {
                    document.querySelector('.card').classList.add('show');
                }, 200); // Delay before showing the card on page load
            }
        </script>
    @endpush
@endsection
