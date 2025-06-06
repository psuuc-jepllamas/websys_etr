<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PSU Student Program</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
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
            position: relative;
            min-height: 100px;
        }
        .header img {
            width: 100px;
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
            color: #000;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card {
            border: 2px solid #003087;
            border-radius: 10px;
            background-color: #ffffff;
            cursor: pointer;
        }
        .card-header {
            background-color: #003087;
            color: white;
            font-weight: bold;
            border-bottom: 2px solid #003087;
        }
        .card-body {
            font-size: 2rem;
            color: #003087;
            padding: 20px;
            text-align: center;
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
        .filter-form select {
            border: 2px solid #003087;
            border-radius: 5px;
            padding: 5px;
        }
        .filter-form button {
            background-color: #003087;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 6px 15px;
        }
        .filter-form button:hover {
            background-color: #ffc107;
            color: #003087;
        }
        canvas {
            max-height: 300px;
            width: 100% !important;
        }
        .table-container {
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #003087;
            padding: 6px;
            font-size: 1rem;
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
        #recentDataTable {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin: 10px 0;
        }
        .dataTables_wrapper .bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .btn-primary {
            background-color: #003087;
            border-color: #003087;
            border-radius: 25px;
            padding: 8px 15px;
        }
        .btn-primary:hover {
            background-color: #ffc107;
            color: #003087;
            border-color: #ffc107;
        }
        .duplicate-attempt-item {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 5px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .duplicate-attempt-item.unread {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .notification-btn {
            position: relative;
            padding: 0.375rem 0.75rem;
        }
        .notification-badge {
            position: absolute;
            top: -10px;
            font-size: 0.8rem;
            padding: 4px 8px;
        }
        .modal-content {
            border: 2px solid #003087;
            border-radius: 10px;
        }
        .modal-header {
            background-color: #003087;
            color: white;
            border-bottom: 2px solid #003087;
        }
        .modal-body {
            background-color: #ffffff;
        }
        #studentDataModal .modal-body table {
            width: 100%;
            border-collapse: collapse;
        }
        #studentDataModal .modal-body th, #studentDataModal .modal-body td {
            border: 1px solid #003087;
            padding: 8px;
            text-align: left;
        }
        #studentDataModal .modal-body th {
            background-color: #003087;
            color: white;
        }
        .filter-form p, 
        .filter-form label[for="print_year"],
        .filter-form label[for="print_month"] {
            font-size: 1.2rem;
        }
        .filter-form select#print_period, 
        .filter-form select#print_month, 
        .filter-form select#print_year {
            font-size: 1.2rem;
        }
        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_length span {
            font-size: 1.2rem;
        }
        .dataTables_wrapper .dataTables_filter label {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="header py-2">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2" style="width: 70px; height: auto;">
                    <h2 class="mb-0">Registrar's Office - Admin Dashboard</h2>
                </div>
                @php
                    $unreadCount = $duplicateAttempts->whereNull('read_at')->count();
                @endphp
                <button id="notifbutton" class="btn btn-primary notification-btn" data-bs-toggle="modal" data-bs-target="#duplicateAttemptsModal">
                    <i class="bi bi-bell"></i>
                    @if ($unreadCount > 0)
                        <span class="badge bg-danger notification-badge">{{ $unreadCount }}</span>
                    @endif
                </button>
            </div>
        </header>

        <div class="d-flex flex-grow-1">
            <div class="sidebar">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-kanban"></i> <span class="ms-1">Dashboard</span></a>
                <a href="{{ route('admin.studentrecords') }}"><i class="bi bi-person-gear"></i> <span class="">Student Records</span></a>
                <a href="{{ route('admin.studentrecords') }}" class="ms-3 {{ request()->routeIs('admin.studentrecords') ? 'active' : '' }}"><i class="bi bi-person"></i> <span class="ms-1">Undergraduate</span></a>
                <a href="{{ route('admin.studentrecordsgraduate') }}" class="ms-3 {{ request()->routeIs('admin.studentrecordsgraduate') ? 'active' : '' }}"><i class="bi bi-mortarboard"></i> <span class="ms-1">Graduate</span></a>
                <form action="{{ route('logout') }}" method="post" id="logout_form">
                    @csrf
                    <button type="submit"><i class="bi bi-box-arrow-right"></i> <span class="ms-1">Logout</span></button>
                </form>
            </div>

            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Student Program Management</h2>
                </div>
                @if (isset($error))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="modal fade" id="duplicateAttemptsModal" tabindex="-1" aria-labelledby="duplicateAttemptsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="duplicateAttemptsModalLabel">Duplicate Submission Attempts</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($duplicateAttempts->isEmpty())
                                    <p>No duplicate submission attempts.</p>
                                @else
                                    @foreach ($duplicateAttempts as $attempt)
                                        <div class="duplicate-attempt-item {{ $attempt->read_at ? '' : 'unread' }}">
                                            <p>Duplicate submission attempt by {{ $attempt->student_name }} ({{ $attempt->type }}) with OR No. {{ $attempt->or_no }} on {{ \Carbon\Carbon::parse($attempt->attempted_at)->format('F d, Y H:i') }}</p>
                                            @if (!$attempt->read_at)
                                                <form action="{{ route('admin.duplicate.mark', $attempt->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="studentDataModal" tabindex="-1" aria-labelledby="studentDataModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="studentDataModalLabel">Student Data</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Course</th>
                                            <th>OR Date</th>
                                            <th>Address</th>
                                            <th>Year Level</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentDataTable">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="filter-form mb-4" method="GET" action="{{ route('admin.dashboard') }}">
                    <div class="d-flex align-items-center">
                        <label for="year" class="me-2">Select Year for Chart:</label>
                        <select name="year" id="year" class="me-3" onchange="this.form.submit()">
                            @foreach (range(2025, 2030) as $y)
                                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                        <label for="month" class="me-2">Select Month for Chart:</label>
                        <select name="month" id="month" onchange="this.form.submit()">
                            <option value="" {{ !$selectedMonth ? 'selected' : '' }}>All Months</option>
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="ms-2">Filter</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card" data-type="undergraduate" data-bs-toggle="modal" data-bs-target="#studentDataModal">
                            <div class="card-header">
                                Total Undergraduates ({{ $selectedMonth ? date('F', mktime(0, 0, 0, $selectedMonth, 1)) . ' ' : '' }}{{ $selectedYear }})
                            </div>
                            <div class="card-body text-center">
                                {{ $undergraduateCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card" data-type="graduate" data-bs-toggle="modal" data-bs-target="#studentDataModal">
                            <div class="card-header">
                                Total Graduates ({{ $selectedMonth ? date('F', mktime(0, 0, 0, $selectedMonth, 1)) . ' ' : '' }}{{ $selectedYear }})
                            </div>
                            <div class="card-body text-center">
                                {{ $graduateCount }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Recent Data
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end mb-3 align-items-center">
                                    <form class="filter-form d-flex align-items-center" method="GET" action="{{ route('admin.printRecentData') }}">
                                        <p class="me-2">Print Period:</p>
                                        <select name="recent_period" id="print_period" class="me-3" onchange="togglePrintMonthSelect(this)">
                                            <option value="day">This Day</option>
                                            <option value="week">This Week</option>
                                            <option value="month">Month</option>
                                        </select>
                                        <label for="print_month" class="me-2" id="print_month_label" style="display: none;">Month:</label>
                                        <select name="recent_month" id="print_month" class="me-3" style="display: none;">
                                            @foreach (range(1, 12) as $m)
                                                <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                            @endforeach
                                        </select>
                                        <label for="print_year" class="me-2">Year:</label>
                                        <select name="recent_year" id="print_year" class="me-3">
                                            @foreach (range(2025, 2030) as $y)
                                                <option value="{{ $y }}">{{ $y }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary">Print as PDF</button>
                                    </form>
                                </div>
                                <div class="table-container">
                                    <table id="recentDataTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Control No.</th>
                                                <th>Full Name</th>
                                                <th>Program</th>
                                                <th>Type</th>
                                                <th>OR Date</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentSubmissions as $submission)
                                                <tr>
                                                    <td>{{ $submission->control_no }}</td>
                                                    <td>{{ $submission->fullname }}</td>
                                                    <td>{{ $submission->course }}</td>
                                                    <td>{{ $submission->type }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($submission->ordate)->format('Y-m-d') }}</td>
                                                    <td>{{ $submission->created_at }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No recent submissions found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Graduate Enrollment ({{ $selectedMonth ? date('F', mktime(0, 0, 0, $selectedMonth, 1)) : 'All Months' }}, {{ $selectedYear }})
                            </div>
                            <div class="card-body">
                                <canvas id="graduateChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Undergraduate Enrollment ({{ $selectedMonth ? date('F', mktime(0, 0, 0, $selectedMonth, 1)) : 'All Months' }}, {{ $selectedYear }})
                            </div>
                            <div class="card-body">
                                <canvas id="undergraduateChart"></canvas>
                            </div>
                        </div>
                    </div>
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
        function togglePrintMonthSelect(select) {
            const monthSelect = document.getElementById('print_month');
            const monthLabel = document.getElementById('print_month_label');
            if (select.value === 'month') {
                monthSelect.style.display = 'inline-block';
                monthLabel.style.display = 'inline-block';
            } else {
                monthSelect.style.display = 'none';
                monthLabel.style.display = 'none';
            }
        }

        @php
            $labels = $selectedMonth ? [date('F', mktime(0, 0, 0, $selectedMonth, 1))] : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        @endphp
        const labels = @json($labels);
        const undergradData = @json($selectedMonth ? [$undergraduateMonthlyCounts[$selectedMonth] ?? 0] : array_values($undergraduateMonthlyCounts));
        const gradData = @json($selectedMonth ? [$graduateMonthlyCounts[$selectedMonth] ?? 0] : array_values($graduateMonthlyCounts));

        console.log('Labels:', labels);
        console.log('Undergraduate Data:', undergradData);
        console.log('Graduate Data:', gradData);

        try {
            const undergradCtx = document.getElementById('undergraduateChart').getContext('2d');
            new Chart(undergradCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Undergraduate Enrollment',
                        data: undergradData,
                        backgroundColor: '#003087',
                        borderColor: '#003087',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Students'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error rendering undergraduate chart:', error);
        }

        try {
            const gradCtx = document.getElementById('graduateChart').getContext('2d');
            new Chart(gradCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Graduate Enrollment',
                        data: gradData,
                        backgroundColor: '#003087',
                        borderColor: '#003087',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Students'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error rendering graduate chart:', error);
        }

        $(document).ready(function() {
            $('#recentDataTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
                pageLength: 5,
                language: {
                    search: "Search recent submissions:",
                    lengthMenu: "<span>Show</span> _MENU_ <span>entries</span>"
                },
                dom: 'lfrt<"bottom"ip>',
                order: [[4, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [4] },
                    { width: '15%', targets: 0 },
                    { width: '25%', targets: 1 },
                    { width: '25%', targets: 2 },
                    { width: '15%', targets: 3 },
                    { width: '20%', targets: 4 }
                ]
            });

            $('.card').on('click', function() {
                const type = $(this).data('type');
                console.log('Fetching data for type:', type);
                const year = $('#year').val();
                const month = $('#month').val();

                $.ajax({
                    url: '{{ route("admin.getStudentData") }}',
                    method: 'GET',
                    data: { year: year, month: month, type: type },
                    success: function(response) {
                        const students = response.students;
                        let html = '';
                        if (students.length > 0) {
                            students.forEach(student => {
                                html += `
                                    <tr>
                                        <td>${student.id}</td>
                                        <td>${student.fullname}</td>
                                        <td>${student.course}</td>
                                        <td>${new Date(student.ordate).toLocaleDateString()}</td>
                                        <td>${student.address || 'N/A'}</td>
                                        <td>${student.yearlevel || 'N/A'}</td>
                                    </tr>
                                `;
                            });
                        } else {
                            html = '<tr><td colspan="6" class="text-center">No students found.</td></tr>';
                        }
                        $('#studentDataTable').html(html);
                        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                        $('#studentDataModalLabel').text(`${type.charAt(0).toUpperCase() + type.slice(1)} Student Data (${month ? monthNames[parseInt(month) - 1] + ' ' : ''}${year})`);
                        $('#studentDataModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching student data:', error);
                        $('#studentDataTable').html('<tr><td colspan="6" class="text-center">Error loading data.</td></tr>');
                        $('#studentDataModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>