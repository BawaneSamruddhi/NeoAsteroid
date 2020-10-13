<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Asteroid Neo Chart</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        {{-- style --}}
        <style>
            body, html
            {
                background: #f1f1f1;
                padding-top: 50px;
            }

            .wrapper
            {
                width:60%;
                display:block;
                overflow:hidden;
                margin:0 auto;
                padding: 60px 50px;
                background:#fff;
                border-radius:4px;
            }

            canvas
            {
                background:#fff;
            }

            a
            {
                margin-top:50px;
                display: block;
                text-decoration: none;
                color: #80b6f4;
                font-weight: bold;
                text-align: center;
            }
        </style>
        
          
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h6>Fastest Asteroid ID :</h6> {{$fastest_ast_id}}
                    <h6>Fastest Asteroid in km/h :</h6> {{$fastest_ast_speed}}
                    <hr>
                    <h6>Closest Asteroid ID :</h6> {{$closest_ast_id}}
                    <h6>Closest Asteroid in km/h :</h6> {{$closest_ast_distance}}
                    <hr>
                    <h6>Average Size of the Asteroids in kilometers (Minimum Diameter):</h6> {{$averageAstMin}}
                    <h6>Average Size of the Asteroids in kilometers (Maximum Diameter):</h6> {{$averageAstMax}}
                </div>
                    <div class="col-md-9 col-md-offset-3">
                    <div class="wrapper">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext("2d");

        
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!!$astDateWiseJson!!},
                datasets: [{
                    label: "Total number of asteroids for each day",
                    borderColor: "#80b6f4",
                    pointBorderColor: "#80b6f4",
                    pointBackgroundColor: "#80b6f4",
                    pointHoverBackgroundColor: "#80b6f4",
                    pointHoverBorderColor: "#80b6f4",
                    pointBorderWidth: 10,
                    pointHoverRadius: 10,
                    pointHoverBorderWidth: 1,
                    pointRadius: 3,
                    fill: false,
                    borderWidth: 4,
                    data: {!!$astDateWiseCountJson!!}
                }]
            },
            options: {
                legend: {
                    position: "bottom"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 7,
                            padding: 20
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });
    </script>

</html>
