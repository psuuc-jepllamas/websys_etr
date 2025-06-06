<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PSU Undergraduate Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        }
        .header img {
            width: 80px;
        }
        .sidebar {
            background-color: #003087;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar a, .sidebar button {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar a:hover, .sidebar button:hover {
            background-color: rgb(238, 215, 145);
            color: #003087;
        }
        .sidebar a.active {
            background-color: #ffc107;
            color: #003087;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .table-container {
            margin-top: 20px;
        }
        .table th, .table td {
            border: 2px solid #003087;
        }
        .btn-primary {
            background-color: #003087;
            border-color: #003087;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #ffc107;
            color: #003087;
            border-color: #ffc107;
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
        .footer .right {
            width: 100px;
        }
        .filter-form select {
            border: 2px solid #003087;
            border-radius: 5px;
            padding: 5px;
        }
        .filter-form button {
            background-color: #003087;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 6px 15px;
        }
        .filter-form button:hover {
            background-color: #ffc107;
            color: #003087;
        }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #003087;
            border-radius: 5px;
            padding: 5px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 5px;
            margin: 0 2px;
            padding: 5px 10px;
            color: #003087 !important;
            border: 1px solid #003087;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #ffc107 !important;
            color: #003087 !important;
            border-color: #ffc107 !important;
        }
        .dataTables_wrapper .dataTables_length {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }
        .dataTables_wrapper .dataTables_length label {
            margin-bottom: 0;
        }
        .dataTables_wrapper .dataTables_length select {
            width: auto;
            min-width: 60px;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="header py-2">
            <div class="container d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2" style="width: 70px; height: auto;">
                <h2 class="mb-0">Registrar's Office - Undergraduate Records</h2>
            </div>
        </header>

        <div class="d-flex flex-grow-1">
            <div class="sidebar">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-kanban"></i> <span class="ms-1">Dashboard</span></a>
                <a href="{{ route('admin.studentrecords') }}"><i class="bi bi-person-gear"></i> <span class="ms-1">Student Records</span></a>
                <a href="{{ route('admin.studentrecords') }}" class="ms-3 {{ request()->routeIs('admin.studentrecords') ? 'active' : '' }}"><i class="bi bi-person"></i> <span class="ms-1">Undergraduate</span></a>
                <a href="{{ route('admin.studentrecordsgraduate') }}" class="ms-3 {{ request()->routeIs('admin.studentrecordsgraduate') ? 'active' : '' }}"><i class="bi bi-mortarboard"></i> <span class="ms-1">Graduate</span></a>
                <form action="{{ route('logout') }}" method="post" id="logout-form">
                    @csrf
                    <button type="submit" form="logout-form" aria-label="Logout"><i class="bi bi-box-arrow-right"></i> <span class="ms-1">Logout</span></button>
                </form>
            </div>

            <div class="main-content">
                <h1 class="mb-4">Undergraduate Program</h1>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form class="filter-form mb-4" method="GET" action="{{ route('admin.studentrecords') }}">
                    <div class="d-flex align-items-center">
                        <label for="undergrad_year_level" class="me-2">Year Level:</label>
                        <select name="year_level" id="undergrad_year_level" class="me-3" onchange="this.form.submit()">
                            <option value="" {{ $selectedYearLevel == '' ? 'selected' : '' }}>All Levels</option>
                            <option value="1st Year" {{ $selectedYearLevel == '1st Year' ? 'selected' : '' }}>1st Year</option>
                            <option value="2nd Year" {{ $selectedYearLevel == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3rd Year" {{ $selectedYearLevel == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4th Year" {{ $selectedYearLevel == '4th Year' ? 'selected' : '' }}>4th Year</option>
                        </select>
                        <label for="undergrad_course" class="me-2">Program:</label>
                        <select name="undergrad_course" id="undergrad_course" onchange="this.form.submit()">
                            <option value="" {{ $undergradCourse == '' ? 'selected' : '' }}>All Programs</option>
                            @foreach ($undergradCourses as $course)
                                <option value="{{ $course }}" {{ $undergradCourse == $course ? 'selected' : '' }}>{{ $course }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="ms-2">Filter</button>
                    </div>
                </form>
                <div class="table-container">
                    <table id="undergraduateTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Control No.</th>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Address</th>
                                <th>Year Level</th>
                                <th>Program</th>
                                <th>Entrance School</th>
                                <th>OR No.</th>
                                <th>OR Date</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>TC-{{ $student->course }}-{{ $student->id }}-UG-{{ \Carbon\Carbon::parse($student->ordate)->year }}</td>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->fullname }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td>{{ $student->yearlevel }}</td>
                                    <td>{{ $student->course }}</td>
                                    <td>{{ $student->entrance }}</td>
                                    <td>{{ $student->orno }}</td>
                                    <td>{{ $student->ordate }}</td>
                                    <td>{{ $student->created_at }}</td>
                                    <td>Undergraduate</td>
                                    <td>
                                        <a href="{{ route('admin.printCredential', ['id' => $student->id, 'type' => 'undergrad']) }}" class="btn btn-primary"><i class="bi bi-printer"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No undergraduate records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#undergraduateTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
                language: {
                    search: "Search records:",
                    lengthMenu: "<span>Show</span> _MENU_ <span>entries</span>"
                },
                columnDefs: [
                    { orderable: false, targets: 10 }
                ]
            });
        });
    </script>
</body>
</html>