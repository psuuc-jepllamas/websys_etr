<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recent Data Report</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
            width: 210mm;
            min-height: 297mm;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 25.4mm;
            box-sizing: border-box;
        }
        .header {
            background-color: #FFC107;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            margin-bottom: 5px;
        }
        .header .logo {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }
        .header .title {
            text-align: center;
            flex-grow: 1;
            font-weight: bold;
        }
        .header .title h1 {
            font-size: 24pt;
            color: #000;
        }
        .header .title h2 {
            margin: 0;
            font-size: 18pt;
            color: #000;
        }
        .header .flag {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-left: 10px;
        }
        .flag {
            height: 500px;
            width: 500px;
        }
        .table-container {
            width: 100%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #003087;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #003087;
            color: white;
            font-weight: bold;
        }
        .table td {
            font-size: 10pt;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .footer .seal {
            font-weight: bold;
            color: red;
        }
        .page-number {
            position: absolute;
            bottom: 25.4mm;
            right: 25.4mm;
            font-size: 10pt;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="C:\Users\Emman\Downloads\websys_etr\websys_etr\public\images\logo.png" alt="PSU Logo" style="margin-left: 75px;" class="logo">
        <div class="title">
            <h5>Republic of the Philippines</h5>
            <h1>Pangasinan State University</h1>
            <h3>URDANETA CITY CAMPUS</h3>
        </div>
        <img src="C:\Users\Emman\Downloads\websys_etr\websys_etr\public\images\Bagong_Pilipinas_logo.png" style="margin-right: 75px;" alt="Bagong Pilipinas Logo" class="flag">
    </div>
    <div class="page">
        <div class="table-container">
            <table class="table">
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
                    @forelse ($submissions as $submission)
                        <tr>
                            <td>{{ $submission->control_no }}</td>
                            <td>{{ $submission->fullname }}</td>
                            <td>{{ $submission->course }}</td>
                            <td>{{ $submission->type }}</td>
                            <td>{{ \Carbon\Carbon::parse($submission->ordate)->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No recent submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="page-number">Page 1 of 1</div>
    </div>
</body>
</html>