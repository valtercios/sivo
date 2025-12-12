<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - SIVO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/error.css') }}"> 
    <link rel="shortcut icon" href="{{ asset('assets/images/logodegradesemfundo.png') }}" type="image/png">
</head>
</head>

<body>
    <div id="error">
        

<div class="error-page container">
    <div class="col-md-8 col-12 offset-md-2">
        <div class="text-center">
            <img class="img-error" src="{{ baseImage64('assets/images/samples/error-404.svg') }} " alt="Not Found">
            <h1 class="error-title">404 - Página não encontrada</h1>
            <p class='fs-5 text-gray-600'>Não encontramos o que você está procurando.</p>
            <a href="{{ route('dashboard.index') }}" class="btn btn-lg btn-outline-primary mt-3">Voltar para o inicio</a>
        </div>
    </div>
</div>


    </div>
</body>

</html>
