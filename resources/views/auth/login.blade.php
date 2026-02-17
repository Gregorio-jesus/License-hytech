<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Hytech SaaS</title>
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>

    <div class="background-image" style="background-image: url('{{ asset('img/fondo.jpg') }}');"></div>
    
    <div class="container">

        <div class="login-box">

            <div class="logo-container">
                <img src="{{ asset('img/logo-sesion.png') }}" alt="HyTech" class="logo">
            </div>

            <h3>Inicia sesión en tu cuenta</h3>

            @if ($errors->any())
                <div style="color: #ff8a8a; text-align: center; margin-bottom: 15px; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="login-form" action="{{ url('/login') }}" method="POST">
                @csrf {{-- Token de seguridad obligatorio --}}
                
                <div class="input-group">
                    <label for="email">Correo electrónico:</label>

                    <div class="input-wrapper">
                        <img src="{{ asset('img/usuario.png') }}" alt="Usuario" class="input-icon">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Usuario o Correo electrónico" required autofocus>
                    </div>

                </div>

                <div class="input-group">
                    <label for="password">Contraseña:</label>

                    <div class="input-wrapper">
                        <img src="{{ asset('img/candado.png') }}" alt="Contraseña" class="input-icon">
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    </div>

                </div>

                <button type="submit" class="btn-login">Iniciar sesión</button>

            </form>
        </div>
    </div>
</body>
</html>