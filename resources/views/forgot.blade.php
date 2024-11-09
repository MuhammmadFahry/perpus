@extends('layouts.layout')

@section('title')
    Forgot Password - Garuda Perpus
@endsection

@section('content')
    @push('style')
        <style>
            body {
                background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Inter', sans-serif;
                color: #333;
            }

            .card {
                opacity: 0;
                transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
                transform: translateY(-30px) scale(0.95);
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 1.5rem;
                padding: 3rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 8px 24px rgba(0, 0, 0, 0.12);
                max-width: 420px;
                width: 90%;
                margin: 2rem auto;
                position: relative;
                overflow: hidden;
            }

            .card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 200%;
                height: 100%;
                background: linear-gradient(115deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                transition: 0.7s;
            }

            .card:hover::before {
                left: 100%;
            }

            .card.show {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            .card.hide {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            .form-control {
                background: rgba(255, 255, 255, 0.9);
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
                width: 100%;
                height: 45px;
                font-size: 0.95rem;
                letter-spacing: 0.025em;
            }

            .form-control:focus {
                outline: none;
                border-color: rgba(0, 0, 0, 0.3);
                box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
            }

            .btn-submit {
                width: 100%;
                background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
                color: #333;
                border: none;
                border-radius: 0.5rem;
                padding: 0.75rem;
                height: 45px;
                font-weight: 600;
                font-size: 0.95rem;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-top: 1.5rem;
                position: relative;
                overflow: hidden;
            }

            .btn-submit:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
            }

            .btn-submit .loading {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.6) 50%, rgba(255, 255, 255, 0) 100%);
                background-size: 936px 100%;
                animation: shimmer 2s infinite;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease;
            }

            .btn-submit:disabled .loading {
                opacity: 1;
            }

            .text-danger {
                color: #dc2626;
                font-size: 0.875rem;
                margin-top: 0.5rem;
                margin-bottom: 0.75rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .card-title {
                font-size: 2rem;
                font-weight: 700;
                text-align: center;
                margin-bottom: 2rem;
                color: #ffffff;
                letter-spacing: -0.025em;
            }

            .register-text {
                text-align: center;
                color: #6b7280;
                font-size: 0.95rem;
                margin-top: 1rem;
            }

            .register-text a {
                color: #ffffff;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.2s ease;
            }

            .register-text a:hover {
                opacity: 0.8;
                text-decoration: underline;
            }

            .input-group {
                position: relative;
                margin-bottom: 1.5rem;
                /* Menambahkan jarak di bawah input email */
            }

            .input-group-teks {
                width: 100%;
            }

            @keyframes shimmer {
                0% {
                    background-position: -468px 0;
                }

                100% {
                    background-position: 468px 0;
                }
            }
        </style>
    @endpush

    <x-form class="card">
        <x-slot:title>
            <h1 class="card-title">Forgot Password</h1>
        </x-slot:title>

        <x-slot:route>
            {{ route('password.email') }}
        </x-slot:route>

        <div class="input-group">
            <x-input-email class="form-control" placeholder="Enter your email">Email</x-input-email>
        </div>

        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <x-button-submit class="btn-submit">
            <span>Send Reset Link</span>
            <div class="loading"></div>
        </x-button-submit>

        <x-slot:haveLogin>
            <p class="register-text">
                Remember your password? <a href="{{ route('login') }}" onclick="goToLogin(event)">Login</a>
            </p>
        </x-slot:haveLogin>
    </x-form>

    @push('scripts')
        <script>
            function goToLogin(event) {
                event.preventDefault();
                const card = document.querySelector('.card');
                card.classList.add('hide');
                setTimeout(function() {
                    window.location.href = "{{ route('login') }}";
                }, 700);
            }

            window.onload = function() {
                setTimeout(function() {
                    document.querySelector('.card').classList.add('show');
                }, 200);
            }
        </script>
    @endpush
@endsection
