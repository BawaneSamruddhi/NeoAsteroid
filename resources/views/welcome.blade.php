<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Asteroid Neo</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        {{-- scripts datepicker --}}
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
            <div class="content">
            <form action="{{ url('/dateStore') }}" method="post">
                @csrf
                    <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Enter Start Date">
                    <input type="text" id="end_date" name="end_date" class="form-control" placeholder="Enter End Date">
                    <input type="submit" name="submit" value="submit" id="submit"> 
                </form>
            </div>
        </div>
        <hr>


        {{-- script datepicker --}}
        <script>
            $( function() {
              $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
              
              $( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
              
            });
            </script>
            <script>
                $(document).ready(function() 
                {
                    $("#submit").click(function()
                    {
                    var start_date = $('#start_date').val();
                    alert(start_date);exit;
                    var end_date = $('#end_date').val();
                    alert(end_date);exit;
                        $.ajax({
                            url: /dateStore,
                            method: 'POST',
                            data: {start_date:start_date,end_date:end_date},
                            success:function(data)
                            {
                                alert('ok');
                                
                            }
                        
                            });
           
                    });
                });
        </script>
        
            
    </body>
</html>
