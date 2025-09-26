@extends('layouts.app')

@section('content')
    <div class="register-container">
        <div class="register-card">
            <!-- Left side - Image/Branding -->
             <div class="register-image">
                <div class="brand-overlay"></div>
                <div class="brand-content">
                    <div class="branding-top">
                        <h1>Create Account</h1>
                        <p>Join us and start your journey today</p>
                    </div>

                    <div class="illustration">
                        <svg width="200" height="200" viewBox="0 0 500 500">
                            <circle cx="250" cy="250" r="200" fill="rgba(255,255,255,0.1)" />
                            <path
                                d="M355 170C355 226.885 309.183 273 250 273C190.817 273 145 226.885 145 170C145 113.115 190.817 67 250 67C309.183 67 355 113.115 355 170Z"
                                fill="white" fill-opacity="0.25" />
                            <path d="M145 350C145 297.533 191.533 255 250 255C308.467 255 355 297.533 355 350V400H145V350Z"
                                fill="white" fill-opacity="0.25" />
                        </svg>
                    </div>

                    <div class="branding-bottom">
                        <p>&copy; 2025 Your Company. All rights reserved.</p>
                    </div>
                </div>
            </div>

            <!-- Right side - Registration Form -->x
            <div class="register-form">
                <div class="form-header">
                    <h2>Create an Account</h2>
                    <p>Fill in your details to get started</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <div class="input-with-icon">
                            <span class="icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21"
                                        stroke="#718096" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                        stroke="#718096" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <input id="name" type="text" class="form-input @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="John Doe">
                        </div>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-with-icon">
                            <span class="icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z"
                                        stroke="#718096" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <input id="email" type="email" class="form-input @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="name@example.com">
                        </div>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-with-icon">
                            <span class="icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z"
                                        stroke="#718096" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11"
                                        stroke="#718096" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <input id="password" type="password" class="form-input @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <div class="input-with-icon">
                            <span class="icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z"
                                        stroke="#718096" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11"
                                        stroke="#718096" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                            <input id="password-confirm" type="password" class="form-input" name="password_confirmation"
                                required autocomplete="new-password" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="terms-policy">
                        <input id="terms" name="terms" type="checkbox" required>
                        <label for="terms">
                            I agree to the <a href="#" class="terms-link">Terms of Service</a> and <a
                                href="#" class="terms-link">Privacy Policy</a>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            Create Account
                        </button>
                    </div>

                    <div class="login-link">
                        <p>
                            Already have an account?
                            <a href="{{ route('login') }}">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>

                <div class="social-login">
                    <div class="separator">
                        <span>or register with</span>
                    </div>
                    <div class="social-buttons">
                        <button class="social-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.605-3.369-1.343-3.369-1.343-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.022A9.578 9.578 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.291 2.747-1.022 2.747-1.022.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.933.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.416 22 12c0-5.523-4.477-10-10-10z" />
                            </svg>
                        </button>
                        <button class="social-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </button>
                        <button class="social-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Main Container */
        .register-container {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Register Card */
        .register-card {
            width: 100%;
            max-width: 900px;
            display: flex;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            animation: fadeIn 0.6s ease-out;
        }

        /* Left Panel - Image */
        .register-image {
            display: none;
            width: 50%;
            background-color: #3b82f6;
            color: white;
            padding: 40px;
            position: relative;
        }

        .brand-overlay {
            position: absolute;
            inset: 0;
            background-color: #3b82f6;
            opacity: 0.9;
        }

        .brand-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .register-image h1 {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .register-image p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 15px;
        }

        .illustration {
            margin: 30px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .branding-bottom p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Right Panel - Form */
        .register-form {
            width: 100%;
            background-color: white;
            padding: 30px;
        }

        .form-header {
            margin-bottom: 25px;
            text-align: center;
        }

        .form-header h2 {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }

        .form-header p {
            color: #6b7280;
            margin-top: 8px;
            font-size: 14px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        .input-with-icon {
            position: relative;
        }

        .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .form-input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            outline: none;
        }

        .form-input.is-invalid {
            border-color: #ef4444;
        }

        .error-message {
            display: block;
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Terms & Policy */
        .terms-policy {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .terms-policy input {
            margin-right: 8px;
            margin-top: 3px;
        }

        .terms-policy label {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.4;
        }

        .terms-link {
            color: #3b82f6;
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-primary {
            display: flex;
            justify-content: center;
            width: 100%;
            padding: 10px 12px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        /* Login Link */
        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link p {
            font-size: 14px;
            color: #4b5563;
        }

        .login-link a {
            color: #3b82f6;
            font-weight: 500;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Social Login */
        .social-login {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e5e7eb;
        }

        .separator span {
            padding: 0 10px;
            font-size: 13px;
            color: #6b7280;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #d1d5db;
            background: none;
            color: #4b5563;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .social-btn:hover {
            border-color: #9ca3af;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (min-width: 768px) {
            .register-image {
                display: block;
            }

            .register-form {
                width: 50%;
            }

            .form-header {
                text-align: left;
            }
        }
    </style>
@endsection
