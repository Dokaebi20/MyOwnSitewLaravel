<?php 
if(!isset($_SESSION)){
   session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>{{$title}}</title> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="icon" href="../img/main_img/iconABC.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            body{
                font-family: 'Poppins', sans-serif;
                color: rgb(25, 135, 84);
                height: 100vh;
                width: 100vw;
            }
            .container_1{
                width: 100vw;
                height: 15vh;
                padding-right: auto;
                padding-left: auto;
                padding-top: 5vh;
                padding-bottom: auto;
                text-align: center;
                vertical-align: middle;
                display: inline-block;
                
            }
            .container_1 h1{
                font-weight: bold;
                
            }
            .container_2{
                font-size: 20px;
                margin-left: 40vw;
                margin-right: 40vw;
            }
            .container_3{
                font-weight: bold;
                display: grid;
                height: 10vh;
                align-content: space-around;
            }
            .container_3 a{
                text-decoration: none;
                text-align: center;
                color: rgb(25, 135, 84);
            }
            .btn{
                font-weight: bold;
                font-size: 20px;
            }
        </style>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

        <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
        
        <!-- Bootstrap Date-Picker Plugin -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    </head>
    <body>
        <div class="container_1">
            <h1>REGISTER</h1>
        </div>
        <div class="container_2">
            <form method="POST" action="/register">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputName1" class="form-label ">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" 
                    name="name" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label ">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                </div>
                <div class="container_3">
                    <button type="submit" class="btn btn-success">SIGN UP</button>
                </div>
            </form>
        </div>
    </body>
</html>
