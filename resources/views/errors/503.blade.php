<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - SIVO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/error.css') }}"> 
    <link rel="shortcut icon" href="{{ asset('assets/images/logodegradesemfundo.png') }}" type="image/png">
</head>

<body style="background-color: #ebf3ff;">
    <div id="error">
        

<div class="error-page container">
    <div class="col-md-8 col-12 offset-md-2">
        <div class="text-center">
            <h1 class="error-title">503 - Serviço indisponível</h1>
            <p class="fs-5 text-gray-600">Esta página está temporariamente indisponível, o sistema está passando por algumas atualizações e em breve estará disponível.</p>
            <a href="{{ route('dashboard.index') }}" class="btn btn-lg btn-outline-primary mt-3">Voltar para o inicio</a>
        </div>
    </div>
</div>


    </div>
</body>

</html>
