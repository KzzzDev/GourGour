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
                        <div class="modal-body" id="log">
                            @php
                            $log = DB::select('select date,shop_name from log order by id desc limit 20');
                            @endphp
                            @empty ($log)
                            <h3>履歴はありません・・・</h3>
                            @endempty
                        
                            @foreach ((array)$log as $item)
                            <h5>{{ $item->shop_name }}</h5>
                            @endforeach
                            @php
                            $check = FALSE;
                            @endphp
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-danger" onclick="check()">履歴を削除する</button> -->
                    </div>
                    </div>
                </div>
                </div>
                <!-- <a class="nav-link text-light" aria-current="page" href="/signin">Sign-in/Sing-up</a> -->
            </li>
        </ul>
        <div class="container-sm" style="max-width:45rem">
        <h1 style="font-size: 3rem; text-align:center; margin: 5rem;">グルグル</h1>
        
            <form method="POST" action="/api">
                @csrf
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">エリア・店名を入力</label>
                    <input type="text" class="form-control shadow" id="exampleFormControlInput1" placeholder="例：新宿" name="erea">
                </div>
                <div class="form-floating mb-4 shadow">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="genre">
                    <option selected value="">選択しない</option>
                    <option value="G001">居酒屋</option>
                    <option value="G002">ダイニングバー・バル</option>
                    <option value="G003">創作料理</option>
                    <option value="G004">和食</option>
                    <option value="G005">洋食</option>
                    <option value="G006">イタリアン・フレンチ</option>
                    <option value="G007">中華</option>
                    <option value="G008">焼肉・ホルモン</option>
                    <option value="G009">アジア・エスニック料理</option>
                    <option value="G010">各国料理</option>
                    <option value="G011">カラオケ・パーティ</option>
                    <option value="G012">バー・カクテル</option>
                    <option value="G013">ラーメン</option>
                    <option value="G014">カフェ・スイーツ</option>
                    <option value="G015">その他グルメ</option>
                    <option value="G016">お好み焼き・もんじゃ</option>
                    </select>
                    <label for="floatingSelect">ジャンルを選択</label>
                </div>
                <div class="form-floating mb-5 shadow">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="budget">
                    <option selected value="">選択しない</option>
                    <option value="B009">～500円</option>
                    <option value="B010">501～1000円</option>
                    <option value="B011">1001～1500円</option>
                    <option value="B001">1501～2000円</option>
                    <option value="B002">2001～3000円</option>
                    <option value="B003">3001～4000円</option>
                    <option value="B008">4001～5000円</option>
                    <option value="B004">5001～7000円</option>
                    <option value="B005">7001～10000円</option>
                    <option value="B006">10001～15000円</option>
                    <option value="B012">15001～20000円</option>
                    <option value="B013">20001～30000円</option>
                    <option value="B014">30001円～</option>
                    </select>
                    <label for="floatingSelect">価格帯を選択</label>
                </div>

                <div class="d-grid col-6 mx-auto" style="color: #ff3">
                    <button class="btn btn-danger shadow" type="submit" style="color: #fff">検索</button>
                </div>
            </form>
        </div>
        <script>
            // function delete_log(){
            //     @php
            //     global $check;
            //     if($check){
                    
            //         // 履歴を消すクエリ
            //         DB::delete('delete from log;');
            //     }
            //     @endphp
            //     document.getElementById('log').innerHTML = "<h3>履歴はありません</h3>";
            //     {{-- delete_query() --}}
            // }
            // function check(){
            //     @php
            //     global $check;
            //     $check = TRUE;
            //     @endphp
            //     delete_log();
            // }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
