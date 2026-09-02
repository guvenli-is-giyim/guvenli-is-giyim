<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Yönetici Girişi - Güvenli İş Giyim</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;">

    <div class="card shadow-sm" style="width:100%;max-width:400px;">

        <div class="card-body p-4">

            <h4 class="mb-4 text-center">
                Yönetici Girişi
            </h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">

                @csrf

                <div class="mb-3">
                    <label class="form-label">E-posta</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Şifre</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Beni hatırla</label>
                </div>

                <button type="submit" class="btn btn-dark w-100">
                    Giriş Yap
                </button>

            </form>

        </div>

    </div>

</div>

</body>

</html>
