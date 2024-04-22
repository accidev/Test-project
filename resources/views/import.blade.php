<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <title>Import Excel</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom styles for this template -->
    <link href="../css/cover.css" rel="stylesheet">
</head>
<body class="h-100 text-white bg-dark">
<a href="/" class="btn btn-outline-warning m-3 p-3">На главную</a>
<form action="{{ url('/import') }}" method="POST"  enctype="multipart/form-data">
    @csrf
    <div class="w-100 h-100 p-3 text-center ">
        <main class="mt-5">
            <h1 class="mb-5">Загрузите excel файл для импорта</h1>
            <p class="lead d-flex justify-content-center">
                <input type="file" name="file" class="form-control w-auto me-2"/>
                <button type="submit" class="btn btn-success">Загрузить</button>
            </p>
        </main>
    </div>
</form>
</body>
</html>
