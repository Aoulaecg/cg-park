<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Console Admin | CGPark</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Manrope', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at 20% 20%, rgba(63,70,242,0.12), transparent 40%),
                linear-gradient(135deg, #07244a 0%, #0d3761 50%, #0b2d52 100%);
        }

        .login-shell {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-brand-title {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 0.06em;
        }

        .login-brand-sub {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.5);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .login-card {
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 32px 64px rgba(0,0,0,0.28);
        }

        .login-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #0b2d52;
            margin-bottom: 6px;
        }

        .login-sub {
            font-size: 0.88rem;
            color: rgba(26,43,60,0.58);
            margin-bottom: 28px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 18px;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #0b2d52;
        }

        .form-control {
            padding: 12px 16px;
            border: 1px solid rgba(11,45,82,0.14);
            border-radius: 10px;
            font-family: 'Manrope', sans-serif;
            font-size: 0.92rem;
            color: #1a2b3c;
            background: #fff;
            transition: border-color 150ms, box-shadow 150ms;
        }

        .form-control:focus {
            outline: none;
            border-color: #3F46F2;
            box-shadow: 0 0 0 3px rgba(63,70,242,0.12);
        }

        .form-control.is-invalid { border-color: #dc2626; }

        .form-error {
            font-size: 0.8rem;
            color: #dc2626;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.88rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #0b2d52, #1a4f82);
            color: #fff;
            font-family: 'Manrope', sans-serif;
            font-size: 0.96rem;
            font-weight: 800;
            cursor: pointer;
            letter-spacing: 0.04em;
            transition: opacity 150ms, transform 150ms;
            margin-top: 8px;
        }

        .btn-login:hover { opacity: 0.9; transform: translateY(-1px); }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.4);
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <div class="login-brand">
            <div class="login-brand-title">CGPark</div>
            <div class="login-brand-sub">Console d'administration</div>
        </div>

        <div class="login-card">
            <h1 class="login-title">Connexion</h1>
            <p class="login-sub">Accès réservé aux administrateurs autorisés.</p>

            @if ($errors->has('credentials'))
                <div class="alert-error">{{ $errors->first('credentials') }}</div>
            @endif

            <form action="{{ route('console.login.post') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                    >
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        autocomplete="current-password"
                        required
                    >
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">Se connecter</button>
            </form>
        </div>

        <p class="login-footer">© {{ date('Y') }} CGPark — Accès sécurisé</p>
    </div>
</body>
</html>
