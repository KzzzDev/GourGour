<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body {
            background-color: coral;
            }
        </style>
        <title>店決めルーレットサイト グルグル</title>
    </head>
    <body>
        <div class="container-sm" style="max-width:45rem">
            <h1 style="font-size: 3rem; text-align:center; color:#fff; margin: 5rem;">グルグル</h1>
            <!-- パンクズリスト -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page"><a href="/" style="color:#333">Top</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:#333">使用履歴</li>
                </ol>
            </nav>
            @foreach ($result as $item)
            <h2>{{ $item->date }}</h2>
            <h2>{{ $item->history }}</h2>
            @endforeach
            @empty ($result)
            <h2>履歴はありません</h2>
            @endempty
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
