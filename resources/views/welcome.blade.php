<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Transfer Credentials System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('{{ asset("images/background.png") }}') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .header {
            background-color: #003087;
            color: white;
        }
        .header img {
            width: 50px;
        }
        .main {
            flex: 1;
            text-align: center;
            color: black;
        }
        .main h1 {
            color:rgb(255, 255, 255);
            font-weight: bold;
            font-size: 6em;
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 2px 2px 0 #000;
        }
        .main .btn {
            border: 5px solid #003087;
            padding: 10px 30px;
            color: #003087;
            font-size: 2.5em;
            font-weight: bold;
            text-transform: uppercase;
        }
        .main .btn:hover {
            background-color: #003087;
            color: white;
        }
        .pre-footer {
            background-color: rgba(135, 206, 250, 0.5); 
        }
        .pre-footer .social-icons img {
            width: 20px;
            margin: 0 5px;
        }
        .footer {
            background-color: #ffc107;
        }
        .footer img {
            width: 50px;
        }
        .footer .right img {
            width: 15px;
            margin-right: 5px;
            vertical-align: middle;
        }
        .description {
            font-size: 3.5em;
            margin: 20px 0;
            color:rgb(255, 255, 255);
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 2px 2px 0 #000;
        }
    </style>
</head>
<body>
    <header class="header py-2">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2" style="width: 65px; height: auto;">
            <h5 class="mb-0">Pangasinan State University - Region's Premier University of Choice</h5>
        </div>
    </header>

    <main class="main d-flex flex-column justify-content-center align-items-center py-5">
        <h1>Transfer Credentials</h1>
        <p class="description">NOTE: Make sure you have your OR, Form 137 and completed clearance with you</p>
        <div class="d-flex">
            <a href="{{route('user.graduate')}}" class="btn btn-outline-primary me-5">Graduate</a>
            <a href="{{route('user.undergraduate')}}" class="btn btn-outline-primary">Undergraduate</a>
        </div>
    </main>

    <footer class="footer py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                Copyright ©2025 Jesus Emmanuel Llamas
                <br>
                All Rights Reserved . Terms of Use | Privacy Policy
            </div>
            <div class="text-end">
                <div class="d-flex align-items-center mb-1">
                    <img src="{{ asset('images/phone.png') }}" alt="Phone" class="me-2" style="width: 20px;">
                    <span>(+63)9168-247-711</span>
                </div>
                <div class="d-flex align-items-center mb-1">
                    <img src="{{ asset('images/email.png') }}" alt="Email" class="me-2" style="width: 20px;">
                    <span>psu@gmail.com</span>
                </div>
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/location.png') }}" alt="Location" class="me-2" style="width: 20px;">
                    <span>Pangasinan, Philippines</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>