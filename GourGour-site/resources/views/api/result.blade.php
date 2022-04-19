<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #FFA812;
        }
    </style>
    <title>店決めルーレットサイト グルグル</title>
</head>
<body>
    <!-- ナビゲーションバー -->
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <!-- <button type="button" class="btn btn-outline-light m-3" onclick="location.href='/signin'">Sign-in/Sign-up</button> -->
            <button type="button" class="btn btn-outline-dark m-3"  data-bs-toggle="modal" data-bs-target="#exampleModal">Log</button>
            <!-- <button type="button" class="btn btn-outline-light m-3"  data-bs-toggle="modal" data-bs-target="#exampleModal">Log</button> -->
            <!-- Button trigger modal -->
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">行きたい履歴</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                    $log = DB::select('select date,shop_name from log order by id desc limit 20');
                    function delete_query(){
                        // 履歴を消すクエリ
                        DB::delete('delete from log;');          
                    }
                    @endphp

                    @foreach ((array)$log as $item)
                    <h5>{{ $item->shop_name }}</h5>
                    @endforeach
                    @empty ($log)
                    <h3>履歴はありません・・・・</h3>
                    @endempty

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-danger" onclick="delete_log()">履歴を削除する</button> -->
                </div>
                </div>
            </div>
            </div>
            <!-- <a class="nav-link text-light" aria-current="page" href="/signin">Sign-in/Sing-up</a> -->
        </li>
    </ul>
    <div class="container-sm" style="max-width:45rem; margin-bottom: 15rem">
        <h1 style="font-size: 3rem; text-align:center; margin: 5rem;">グルグル</h1>
        <!-- パンクズリスト -->
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                <li class="breadcrumb-item active" aria-current="page"><a href="/" style="color:#000">Top</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color:#000">検索結果</li>
            </ol>
        </nav>
        <form method="POST" action="/roulette">
            @csrf

            @php
            $date = json_decode($date, true);
            @endphp
            @foreach($date as $i)
            <div class="card mb-3 shadow">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{$i["photo"]["pc"]["l"]}}" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">
                                {{$i["name"]}}
                            </h4>
                            <p class="card-text" style="color: coral;">{{$i["genre"]["catch"]}}</p>
                            <p class="card-text">{{$i["catch"]}}</p>
                            <p class="card-text">価格帯：{{$i["budget"]["name"]}}</p>
                            <a class="card-text">{{$i["urls"]["pc"]}}</a>
                            <p class="card-text"><small class="text-muted">{{$i["address"]}}</small></p>
                            <input type="checkbox" class="btn-check" name="wantToEat[]" id="{{$i["name"]}}" value="{{$i["name"]}}" autocomplete="off">
                            <label class="btn btn-outline-danger" for="{{$i["name"]}}">行きたい！</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid col-4 mx-auto fixed-bottom p-5" style="color: #ff3;max-width:30rem;">
                <button class="btn btn-danger shadow-sm" type="submit" style="color: #fff;min-width:10rem">ルーレットスタート！</button>
            </div>
            @endforeach
            @empty($date)
            <h2>該当するお店はありません・・・</h2>
            @endempty

        </form>
    </div>
    <!-- <script>
        function delete_log(){
            let query = "<" + "?php delete_query(); ?>";
            document.write(query);
            document.getElementById('log').innerHTML = "<h3>履歴はありません</h3>";
        }
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>