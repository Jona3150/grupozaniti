<!DOCTYPE html>
<html lang="es"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaniti - Panel de Administración</title>
    <style>
        /* Mantenemos tus estilos originales */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0faff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            border-top: 5px solid #00b4d8; 
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo-container img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        h2 { color: #1a202c; margin-bottom: 5px; font-size: 1.5rem; }
        p { color: #718096; margin-bottom: 30px; font-size: 0.9rem; }

        .form-group { text-align: left; margin-bottom: 20px; }
        label { display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 8px; color: #2d3748; }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #edf2f7;
            border-radius: 8px;
            background-color: #f7fafc;
            box-sizing: border-box;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #00b4d8;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0, 180, 216, 0.2);
        }

        /* Estilo para mensajes de error */
        .error-message {
            background-color: #fff5f5;
            color: #c53030;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            border: 1px solid #feb2b2;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: #00b4d8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover { background-color: #0096b4; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('img/logobg.png') }}" alt="Zaniti Logo">
        </div>
        
        <h2>Panel de Administración</h2>
        <p>Ingresa tus credenciales para continuar</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form action="{{ url('/admin-login') }}" method="POST">
            @csrf <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="usuario@zaniti.com" required>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="********" required>
            </div>

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>
    </div>

</body>
</html>