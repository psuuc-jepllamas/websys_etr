<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Graduate Transfer Credential</title>
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
            margin-top: -100px;
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
            margin: 0;
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
        .control-no {
            font-weight: bold;
            margin-bottom: 10px;
            margin-left: 95px;
        }
        .content {
            text-align: center;
        }
        .content h1 {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content p {
            margin: 10px 0;
            line-height: 1.5;
        }
        .content p strong {
            font-weight: bold;
        }
        .registrar {
            margin-top: 20px;
            font-weight: bold;
        }
        .seal {
            margin-top: 10px;
            font-weight: bold;
            color: red;
        }
        .school-info {
            margin-top: 20px;
            text-align: left;
        }
        .school-info p {
            margin: 5px 0;
            border-bottom: 1px solid black;
            width: 300px;
        }
        .request {
            margin-top: 20px;
            text-align: left;
        }
        .request p {
            margin: 5px 0;
        }
        .consent {
            margin-top: 20px;
            text-align: center;
        }
        .consent h2 {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .consent p {
            margin: 5px 0;
            border-bottom: 1px solid black;
            width: 200px;
            display: inline-block;
        }
        .note {
            margin-top: 30px;
            text-align: left;
            font-weight: bold;
        }
        .page-number {
            position: absolute;
            bottom: 25.4mm;
            right: 25.4mm;
            font-size: 10pt;
        }
        .ootr {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="C:\Users\Emman\Downloads\websys_etr\websys_etr\public\images\logo.png" style="margin-left: 75px;" alt="PSU Logo" class="logo">
        <div class="title">
            <h5>Republic of the Philippines</h5>
            <h1>Pangasinan State University</h1>
            <h3>URDANETA CITY CAMPUS</h3>
        </div>
        <img src="C:\Users\Emman\Downloads\websys_etr\websys_etr\public\images\Bagong_Pilipinas_logo.png" style="margin-right: 75px;" alt="Bagong Pilipinas Logo" class="flag">
    </div>
    <div class="control-no">
        <h5>{{ $controlNo }}</h5>
    </div>
    <div class="ootr">
        <h3>OFFICE OF THE REGISTRAR</h3>
    </div>
    <div class="page">
        <h5>TO WHOM IT MAY CONCERN:</h5>
        <div class="content">
            <p>
                This is to certify that <strong>{{ $fullname }}</strong> of <strong>{{ $address }}</strong>,
                a <strong>{{ $course }}</strong> graduate of this University,
                is hereby granted <strong>TRANSFER CREDENTIALS</strong> this
                <strong>{{ $dayOrdinal }}</strong> day of <strong>{{ $monthYear }}</strong>.
            </p>
            <p>
                Transcript of Record of the above student will be forwarded upon the request of the school where he/she transferred.
            </p>
            <div class="registrar">
                MARICEL A. BONGOLAN, MIT<br>
                Registrar
            </div>
            <br>
            <div class="seal">
                NOT VALID WITHOUT UNIVERSITY SEAL
            </div>
            <br>
        </div>
        <hr>
        <br>
        <div class="school-info">
            <p>Name of School/College/University: _____________________________</p>
            <p>Address: _____________________________</p>
            <p>Date: _____________________________</p>
        </div>
        <div class="request">
            <p>The Registrar</p>
            <p>Pangasinan State University</p>
            <p>Urdaneta Campus, Urdaneta City</p>
            <p>Sir/Madam:</p>
            <p>
                Please furnish us with the Official Transcript of Records of <strong>{{ $fullname }}</strong>
                who has been enrolled in this school upon presentation of his/her
                <strong>TRANSFER CREDENTIALS</strong> dated <strong>{{ $dayOrdinal }} of {{ $monthYear }}</strong>.
            </p>
        </div>
        <div class="consent">
            <h2>WITH MY CONSENT:</h2>
            <p>______________________________</p><br>
            <p>Requesting Officer</p>
            <p>______________________________</p><br>
            <p>Student Signature</p>
            <p>Title: ______________________________</p>
        </div>
        <div class="note">
            Note: <strong>This document is issued only once. Please return it if unused.</strong>
        </div>
    </div>
</body>
</html>