<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PSU Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
            padding: 0.5rem 0;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin: 20px auto;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border: 2px solid #003087;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #003087;
            border-color: #003087;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: rgb(238, 215, 145);
            color: #003087;
            border-color: rgb(238, 215, 145);
        }
        .footer {
            background-color: #ffc107;
            padding: 1rem 0;
        }
        .footer img {
            width: 100px;
            height: auto;
        }
        .footer .contact img {
            width: 20px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .alert {
            border: 2px solid #003087;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="header">
            <div class="container d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2">
                <h2 class="mb-0">Pangasinan State University - Admin Register</h2>
            </div>
        </header>

        <div class="main-content">
            <h1 class="text-center mb-4" style="color: #003087;">Register</h1>
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Register Form -->
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" name="Fullname" id="fullname" class="form-control" value="{{ old('Fullname') }}" required aria-label="Full Name">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required aria-label="Username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required aria-label="Password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required aria-label="Confirm Password">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Already have an account? <a href="{{ route('login') }}" style="color: #003087;">Login</a>
            </p>
        </div>

        <footer class="footer">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2">
                    <h3 class="mb-0 fw-bold" style="font-size: 1.8em;">Pangasinan State University</h3>
                </div>
                <div class="text-end contact">
                    <p class="fw-bold mb-2">Contact us:</p>
                    <div class="d-flex align-items-center mb-1">
                        <img src="{{ asset('images/phone.png') }}" alt="Phone">
                        <span>(+63)9168-247-711</span>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <img src="{{ asset('images/email.png') }}" alt="Email">
                        <span>psu@gmail.com</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/location.png') }}" alt="Location">
                        <span>Pangasinan, Philippines</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>