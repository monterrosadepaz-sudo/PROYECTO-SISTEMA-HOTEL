<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>⚠️ Modo Rescate Activado</title>
    <style>
        body {
            background-color: #0d0d0d;
            color: #ff4c4c;
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            animation: pulseBackground 5s infinite;
        }

        @keyframes pulseBackground {
            0% { background-color: #0d0d0d; }
            50% { background-color: #1a0000; }
            100% { background-color: #0d0d0d; }
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            padding: 40px;
            background-color: #1a1a1a;
            border: 2px solid #ff0000;
            box-shadow: 0 0 20px #ff0000;
        }

        h1 {
            font-size: 2rem;
            text-align: center;
            color: #ff0000;
            text-shadow: 0 0 10px #ff0000;
        }

        p, li {
            font-size: 1rem;
            line-height: 1.6;
            color: #ff9999;
        }

        ul {
            margin-top: 20px;
        }

        .form-group {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #ffcccc;
        }

        input {
            width: 100%;
            padding: 10px;
            background-color: #2a2a2a;
            border: 1px solid #ff4c4c;
            color: #fff;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 0 10px #ff0000;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #990000;
        }

        .warning {
            background-color: #330000;
            padding: 20px;
            border-left: 5px solid #ff0000;
            margin-bottom: 30px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: #ff9999;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚠️ MODO RESCATE ACTIVADO ⚠️</h1>

        @if($usuariosVacios)
            <div class="warning">
                <p>Has ingresado al protocolo de emergencia. Este modo solo se activa cuando <strong>no existen usuarios registrados</strong>.</p>
                <ul>
                    <li>Estás a punto de crear un usuario temporal con privilegios administrativos.</li>
                    <li>Este acceso será auditado y debe eliminarse tras recuperación.</li>
                    <li>Si no sabes lo que estás haciendo, <strong>sal de inmediato</strong>.</li>
                </ul>
            </div>

            <form method="POST" action="{{ route('login.rescate.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido">
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" required>
                </div>

                <div class="form-group">
                    <label for="contrasenha">Contraseña</label>
                    <input type="password" name="contrasenha" required>
                </div>

                <button type="submit">CREAR USUARIO DE RESCATE</button>
            </form>
        @else
            <div class="warning">
                <p>⚠️ El modo rescate ha sido desactivado automáticamente. Ya existen usuarios registrados en el sistema.</p>
            </div>
            <a href="{{ route('login') }}" class="back-link">← Volver al login</a>
        @endif
    </div>
</body>
</html>
