<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Microondas</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }

        .alert {
            position: absolute;
            top: 20px; /* Ajuste conforme necessário */
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: 90%;
            max-width: 400px;
        }

        .card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-custom {
            border-radius: 10px;
        }
    </style>
</head>
<body>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="card">
        <h3 class="text-center mb-4">Login</h3>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="E-mail" name="email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 btn-custom">Login</button>
        <div class="text-center mt-3">
            <p>Ainda não possui uma conta? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Registrar</a></p>
        </div>
    </div>
</form>

<!-- Registration Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Registrar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <input id="i-email" type="email" class="form-control" placeholder="E-mail" required>
                    </div>
                    <div class="mb-3">
                        <input id="i-password" type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button id="btn-registrar" type="button" class="btn btn-success w-100 btn-custom">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
 <script src="js/script.js"></script>

<script>
    $('#btn-registrar').on('click',function () {
        let body = new Object();
        body.email = $('#i-email').val();
        body.password = $('#i-password').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url : 'http://127.0.0.1:8000/cadastrar',
            data : body
        })
            .done(function(msg){
                alert(msg.data)
                window.location.href ='http://127.0.0.1:8000/login';

            })
            .fail(function (jqXHR, textSatus, msg) {
                var message = jqXHR.responseJSON.data;
                alert(message);
            })
    })

</script>
</body>
</html>
