<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PSU Student Program</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <!-- DataTables CSS -->
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
            border: 1px solid #003087; /* Reduced border width */
            padding: 6px; /* Reduced padding for smaller cells */
            font-size: 0.9rem; /* Slightly smaller font size */
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
        /* Adjusted DataTable length menu styling */
        .dataTables_wrapper .dataTables_length {
            display: flex;
            align-items: center;
            gap: 8px; /* Space between elements */
            margin-bottom: 10px;
        }
        .dataTables_wrapper .dataTables_length label {
            margin-bottom: 0; /* Remove default margin */
        }
        .dataTables_wrapper .dataTables_length select {
            width: auto;
            min-width: 60px; /* Ensure dropdown isn't too small */
        }
        #recentDataTable {
            width: 100%;
            max-width: 800px; /* Reduced max-width for a regular size */
            margin: 0 auto;
        }
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin: 10px 0; /* Consistent vertical spacing */
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
        }
        .notification-badge {
            position: absolute;
            top: -10px;
            right: -10px;
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
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="header py-2">
            <div class="container d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Pangasinan State University Logo" class="me-2" style="width: 100px; height: auto;">
                <h2 class="mb-0">Pangasinan State University - Admin Dashboard</h2>
            </div>
        </header>

        <div class="d-flex flex-grow-1">
            <div class="sidebar">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-kanban"></i> <span class="ms-1">Dashboard</span></a>
                <a href="{{ route('admin.studentrecords') }}"><i class="bi bi-person-gear"></i> <span class="ms-1">Student Records</span></a>
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
                    <!-- Notification Button -->
                    @php
                        $unreadCount = $duplicateAttempts->whereNull('read_at')->count();
                    @endphp
                    <button class="btn btn-primary notification-btn" data-bs-toggle="modal" data-bs-target="#duplicateAttemptsModal">
                        <i class="bi bi-bell"></i> Notifications
                        @if ($unreadCount > 0)
                            <span class="badge bg-danger notification-badge me-2">{{ $unreadCount }}</span>
                        @endif
                    </button>
                </div>
                <!-- Error Message -->
                @if (isset($error))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Duplicate Attempts Modal -->
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
                <!-- Year and Month Filter for Cards and Graphs -->
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
                <!-- Cards -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Total Graduates ({{ $selectedMonth ? date('F', mktime(0, 0, 0, $selectedMonth, 1)) . ' ' : '' }}{{ $selectedYear }})
                            </div>
                            <div class="card-body text-center">
                                {{ $graduateCount }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Total Undergraduates ({{ $selectedMonth ? date('F', mktime(0, 0, 0, $selectedMonth, 1)) . ' ' : '' }}{{ $selectedYear }})
                            </div>
                            <div class="card-body text-center">
                                {{ $undergraduateCount }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Recent Data Table -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Recent Data
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end mb-3 align-items-center">
                                    <form class="filter-form d-flex align-items-center" method="GET" action="{{ route('admin.printRecentData') }}">
                                        <label for="print_period" class="me-2">Print Period:</label>
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
                <!-- Graphs -->
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
    </div>

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Chart.js Script -->
    <script>
        // Toggle Month select visibility for Print form
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

        // Define labels based on month selection
        @php
            $labels = $selectedMonth ? [date('F', mktime(0, 0, 0, $selectedMonth, 1))] : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        @endphp
        const labels = @json($labels);
        const undergradData = @json($selectedMonth ? [$undergraduateMonthlyCounts[$selectedMonth] ?? 0] : array_values($undergraduateMonthlyCounts));
        const gradData = @json($selectedMonth ? [$graduateMonthlyCounts[$selectedMonth] ?? 0] : array_values($graduateMonthlyCounts));

        // Log data for debugging
        console.log('Labels:', labels);
        console.log('Undergraduate Data:', undergradData);
        console.log('Graduate Data:', gradData);

        // Undergraduate Chart
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

        // Graduate Chart
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

        // Initialize DataTables for Recent Data
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
                dom: 'lfrt<"bottom"ip>', // Custom layout: l=length, f=filter, r=processing, t=table, i=info, p=pagination
                order: [[4, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [4] }, // Disable sorting on OR Date column
                    { width: '15%', targets: 0 }, // Control No.
                    { width: '25%', targets: 1 }, // Full Name
                    { width: '25%', targets: 2 }, // Program
                    { width: '15%', targets: 3 }, // Type
                    { width: '20%', targets: 4 }  // OR Date
                ]
            });
        });
    </script>
</body>
</html>