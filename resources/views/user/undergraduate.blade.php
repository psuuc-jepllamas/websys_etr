<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Transfer Credentials System</title>
    <!-- Bootstrap CSS -->
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
            width: 80px;
        }
        .main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .login-container {
            display: flex;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 1200px;
            width: 100%;
        }
        .login-left {
            background-color: #ffc107;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .login-left img {
            width: 100px;
            margin-bottom: 20px;
        }
        .login-left h3 {
            font-size: 1.8em;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }
        .login-right {
            padding: 40px;
            flex: 1;
        }
        .login-right h2 {
            font-size: 2em;
            margin-bottom: 30px;
        }
        .login-right .form-control {
            border: 2px solid #003087;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1.1em;
        }
        .login-right .btn {
            background-color: #003087;
            color: white;
            font-size: 1.2em;
            text-transform: uppercase;
            border-radius: 25px;
            padding: 10px;
            width: 150px;
        }
        .login-right .forgot-password, .login-right .register-link {
            color: #003087;
            text-decoration: none;
            font-size: 0.9em;
        }
        .login-right .forgot-password:hover, .login-right .register-link:hover {
            text-decoration: underline;
        }
        .pre-footer {
            background-color: rgba(135, 206, 250, 0.5);
        }
        .pre-footer .social-icons img {
            width: 40px;
            margin: 0 10px;
        }
        .footer {
            background-color: #ffc107;
        }
        .footer img {
            width: 100px;
        }
        .footer .right img {
            width: 20px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .login-right .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .login-right .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
    </style>
</head>
<body>
    <header class="header py-2">
        <div class="container d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2" style="width: 100px; height: auto;">
            <h2 class="mb-0">Pangasinan State University</h2>
        </div>
    </header>

    <main class="main">
        <div class="login-container">
            <div class="login-left">
                <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2" style="width: 200px; height: 200px;">
                <h3>Pangasinan State University</h3>
                <h4>Undergraduate</h4>
            </div>
            <div class="login-right">
                <h4>Fill out your information</h4>
                <br>
                <!-- Display success or error messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('user.undergraduate.store') }}">
                    @csrf
                    <div class="mb-3">
                        <select name="type" id="" class="form-control">
                            <option value="undergraduate">Undergraduate</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="fullname">Full name</label>
                        <input type="text" name="fullname" class="form-control" style="border-width: 3px;" placeholder="Enter your full name" required>
                        @error('fullname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" style="border-width: 3px;" placeholder="Enter your address" required>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="yearlevel">Year level (Select below)</label>
                        <select name="yearlevel" id="yearlevel" class="form-control">
                            <option value="1ST Year">1ST Year</option>
                            <option value="2ND Year">2ND Year</option>
                            <option value="3RD Year">3RD Year</option>
                            <option value="4TH Year">4TH Year</option>
                        </select>
                        @error('yearlevel')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="transfercourse">Program (Select below)</label>
                        <select name="course" id="course" class="form-control">
                            <option value="BSCE">BS Civil Engineering</option>
                            <option value="BSME">BS Mechanical Engineering</option>
                            <option value="BSEE">BS Electrical Engineering</option>
                            <option value="BSCOE">BS Computer Engineering</option>
                            <option value="BSMath">BS Mathematics</option>
                            <option value="BSArch">BS Architecture</option>
                            <option value="BSIT">BS Information Technology</option>
                            <option value="ABEL">AB English Language</option>
                            <option value="BSSE-FIL">Bachelor of Secondary Education major in Filipino</option>
                            <option value="BSSE-SCI">Bachelor of Secondary Education major in Science</option>
                            <option value="BECED">Bachelor of Early Childhood Education</option>
                        </select>
                        @error('transfercourse')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="entrance">Entrance School</label>
                        <input type="text" name="entrance" class="form-control" style="border-width: 3px;" placeholder="Enter your entrance school" required>
                        @error('entrance')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="orno">OR No.</label>
                        <input type="text" name="orno" class="form-control" style="border-width: 3px;" placeholder="Enter your OR No." required>
                        @error('orno')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ordate">OR Date</label>
                        <input type="date" name="ordate" class="form-control" style="border-width: 3px;" required>
                        @error('ordate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <a href="{{ route('welcome') }}" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="footer py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2" style="width: 100px; height: auto;">
                <h3 class="mb-0 fw-bold" style="font-size: 1.8em;">Pangasinan State University</h3>
            </div>
            <div class="text-end">
                <p class="fw-bold mb-2">Contact us:</p>
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

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>