<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main page</title>


    <!-- Bootstrap core CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/changeView.js'])

    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        body {
            background: rgb(226, 123, 63);
            background: radial-gradient(circle, rgba(226, 123, 63, 0.6389727766106443) 0%, rgba(205, 233, 148, 0.8126422443977591) 100%);
        }

        svg {
            width: 32px;
            height: 32px;
        }
    </style>

</head>
<body class="bg-light">
<main class="container">
    <div class="my-3 p-5 bg-body rounded-5 shadow-sm">
        <div class="d-flex border-bottom p-2">
            <h4 class="mt-2">Список товаров</h4>
            <div class="btn-group h-50 ms-auto mt-3">
                <button type="button" class="btn btn-sm btn-outline-secondary fs-5" name="listButton"><img
                        src="./list-task.svg"> / <img
                        src="./border-all.svg"></button>
            </div>
            <a href="/import" class="btn btn-outline-success ms-auto pt-3">Импортировать файл</a>
        </div>
        <div class="d-flex justify-content-center row">
            @if(count($products))
                <div class="col-sm-12" id="list">
                    @foreach($products as $product)
                        <div class="row p-2 bg-white border rounded-4 mt-2">
                            <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                                            src="{{$product["path"]}}"></div>
                            <div class="col-md-6 mt-1">
                                <h3>{{$product['name']}}</h3>
                                <div class="d-flex flex-row">
                                    <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                    <h3>Цена: {{$product['price']}}</h3>
                                </div>
                                <p class="text-justify text-truncate para mb-0">{{$product['description']}}<br><br></p>
                            </div>
                            <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                <div class="d-flex flex-column mt-4"><a href="/product/{{$product["id"]}}"
                                                                        class="btn btn-primary btn">Детали</a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-12" id="cards" hidden>
                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
                        @foreach($products as $product)
                            <div class="col">
                                <a href="/product/{{$product["id"]}}" class="card text-decoration-none">
                                    <img src="{{$product["path"]}}" class="card-img-top" alt="img">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$product["name"]}}</h5>
                                        <p class="card-text text-truncate">{{$product["description"]}}<br><br></p>
                                        <h4 class="card-text">Цена: {{$product["price"]}}</h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h3 class="mt-2 justify-content-center">Продукты не найдены!</h3>
            @endif
        </div>
    </div>
</main>
</body>
</html>


