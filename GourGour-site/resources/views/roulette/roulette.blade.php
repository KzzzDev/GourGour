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
                    <div class="modal-body">
                        @php
                        $log = DB::select('select date,shop_name from log order by id desc limit 20');
                        @endphp

                        @foreach ((array)$log as $item)
                        <h5>{{ $item->shop_name }}</h5>
                        @endforeach
                        @empty ($log)
                        <h2>データがありません</h2>
                        @endempty

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- <a class="nav-link text-light" aria-current="page" href="/signin">Sign-in/Sing-up</a> -->
            </li>
        </ul>
        <div class="container-sm" style="max-width:45rem">
            <h1 style="font-size: 3rem; text-align:center; margin: 5rem;">グルグル</h1>
            <!-- パンクズリスト -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page"><a href="/" style="color:#000">Top</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color:#000">ルーレット</li>
                </ol>
            </nav>
            @if($items)
            <canvas id="canvas" style="width: 100%"></canvas>
            <h2 id="result"></h2>
            <div id="labels"></div>
            
            <div class="d-grid col-6 mx-auto p-5" style="color: #ff3">
                <button class="btn btn-danger shadow" id="start" style="color: #fff">ルーレットスタート！</button>
            </div>
            @else
            <h2>一つも選択されていません・・</h2>
            @endif
        </div>

        <script>
            const canvas = document.getElementById("canvas")
            const context = canvas.getContext('2d');
            
            let center = {
                x: 375,
                y: 375
            }

            // 行きたい！で選択されたお店を追加する
            let radius = 360
            let items = @json($items); 
            let color_arr = ['#00b894', '#0984e3', '#fdcb6e', '#d63031', '#00cec9', '#6c5ce7', '#e84393', '#ffeaa7', '#0074bf', '#000fff']
            let data = [];
            for(let i=0; i<items.length; i++) {
                data.push({
                        name: items[i],
                        color: color_arr[i],
                        weight: 1
                    });
            }
                
            let sum_weight = 0
            let unit_weight = 0
            let stopFlag = false;
            let startFlag = false;
                
            //
            // メイン処理
            //
            data.forEach(e => {
                sum_weight += e.weight
            })
            unit_weight = 360 / sum_weight
            
            init()
            showLabel()
            drawRoullet(0)
            
            // ルーレットを描画する処理
            function drawRoullet(offset) {
                let uw_count = offset
                
                data.forEach(e => {
                    drawPie(center.x, center.y, uw_count, uw_count + unit_weight, radius, e.color)
                    uw_count += unit_weight
                })
            }
            
            // ルーレットを回す処理
            function runRoullet() {
                let count = 1; //終了までのカウント
                let lastCell = "";
                let deg_counter = 0 // 角度のカウント
                let acceleration = 1
                
                let timer = setInterval(function() {
                    
                    deg_counter += acceleration
                    
                    if (stopFlag) {
                        count++;
                    }
                    
                    if (count < 1000) {
                        acceleration = 1000 / (count)
                        drawRoullet(deg_counter);
                    } else {
                        count = 0;
                        clearInterval(timer);
                        endEvent();
                    }
                }, 10);
                
                // 終了時に結果を表示する
                let endEvent = function() {
                    count++;
                    let id = setTimeout(endEvent, 115);
                    if (count > 9) {
                        clearTimeout(id);
                        startFlag = false;
                        stopFlag = false;
                        let current_deg = 360 - Math.ceil((deg_counter - 90) % 360)
                        let sum = 0
                        let _i = 0
                        for (let i = 0; i < data.length; i++) {
                            if (unit_weight * sum < current_deg && current_deg < unit_weight * (sum + data[i].weight)) {
                                document.getElementById("result").innerHTML = "『" + data[i].name + "』に決定！！"
                                break
                            }
                            sum += data[i].weight
                        }
                    }
                };
            }
            
            document.getElementById("start").addEventListener("click", function() {
                // スタート連打を無効化
                if (startFlag === false) {
                    runRoullet();
                    startFlag = true;
                }
                const stop = () => {
                    stopFlag = true;
                }
                setTimeout(stop, 1000);
            });
                    
            function init() {
                canvas.width = 750;
                canvas.height = 750;
                
                let dst = context.createImageData(canvas.width, canvas.height);
                for (let i = 0; i < dst.data.length; i++) {
                    dst.data[i] = 255
                }
                context.putImageData(dst, 0, 0);
                // 背景色
                context.beginPath();
                context.fillStyle = '#FFA812';
                context.fillRect(0, 0, canvas.width, canvas.height);
            }
                    
            function drawPie(cx, cy, start_deg, end_deg, radius, color) {
                let _start_deg = (360 - start_deg) * Math.PI / 180;
                let _end_deg = (360 - end_deg) * Math.PI / 180;

                context.beginPath();
                context.moveTo(cx, cy)
                context.fillStyle = color;
                context.shadowBlur = 1;
                context.shadowColor="white";
                context.arc(cx, cy, radius, _start_deg, _end_deg, true);
                context.fill();

                showArrow()
            }

            function showLabel() {
                let label_el = document.getElementById("labels")

                let text = "<table>"

                for (let i = 0; i < data.length; i++) {
                    text += `
                    <tr>
                    <td style="width:20px;background-color:${data[i].color};"></td>
                    <td>${data[i].name}</td>
                    </tr>`
                }

                text += "</table>"
                label_el.innerHTML = text
            }

            function showArrow() {
                context.beginPath();
                context.moveTo(center.x, center.y - radius);
                context.lineTo(center.x + 80, center.y - radius - 80);
                context.lineTo(center.x - 80, center.y - radius - 80);
                context.closePath();
                context.stroke();
                context.fillStyle = "rgba(40,40,40)";
                context.fill();
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
