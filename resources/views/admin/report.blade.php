<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{asset(env('ICON_PATH'))}}">
    <title>Arsip {{strtoupper($data[0]->type).' '.$data[0]->date[0]}}</title>
    <script src="{{asset(env('LIB_PATH').'extra/paged_js/paged.js')}}"></script>
    <script src="{{asset(env('LIB_PATH').'core/jquery/dist/jquery.min.js')}}"></script>
    <style>

        #header {
            margin-bottom: -0.25rem;
        }
        #logo-section img {
            display: block;
            margin: 0 auto 1rem;
        }
        #logo-section {
            display: inline-block;
            width: 20%;
        }
        #img-logo {
            width: 75px;
        }
        #title-section {
            display: inline-block;
            width: 80%;
        }
        h5 {
            margin-top: -1rem;
        }
        h2 {
            text-align: center;
            margin-bottom: -1rem;
            font-weight: bolder;
        }
        .break {
            page-break-after: always;
        }

        .rp-table-container {
            text-align: center;
        }

        .top {
            margin-top: 0.75em;
            margin-bottom: 0.75em;
            page-break-after: avoid;
        }

        .table-id {
            margin-bottom: 0.5em;
        }

        .rp-table {
            display: inline-table;
            border-collapse: collapse;
            width: 100%;
        }

        .rp-table>thead{
            font-weight: bolder;
        }

        .rp-table>tbody tr td:nth-child(2),
        .rp-table>tbody tr td:nth-child(3){
            text-align: left;
        }

        thead td {
            background-color: rgba(244, 208, 63,0.9);
            padding: 0.5em 0;
        }

        .danger {
            color : red;
        }

        .peserta-data {
            page-break-after: always;
        }

        .rp-table * {
            border: 1px solid black;
        }

        @page {
            size: A4;
            margin: 2cm 2cm 2cm 3cm;
        }
    </style>
</head>
<body>
<div class="break">
    <div id="header">
        <h2>ARSIP PENDAFTARAN</h2>
        <div id="logo-section">
            <img id="img-logo" src="{{asset(env('ICON_PATH'))}}" alt="">
        </div>
        <div id="title-section">
            <h3>CALON PESERTA DIDIK BARU {{strtoupper($data[0]->type)}} {{env('CLIENT_ORGANIZATION')}} {{env('CLIENT_CITY')}}</h3>
            <h5>{{env('CLIENT_ADDRESS')}} - {{env('CLIENT_REGION')}}. Telp {{env('CLIENT_TELP')}}, Email {{env('CLIENT_EMAIL')}}</h5>
        </div>
    </div>
    <hr>
    <div class="top">
        <table>
            <tr>
                <td><strong>Tanggal&nbsp;</strong></td>
                <td><strong> : </strong></td>
                <td><strong>{{$data[0]->date[2].' '.$data[0]->date[1].' '.$data[0]->date[0]}}</strong></td>
            </tr>
            <tr>
                <td><strong>Angkatan</strong></td>
                <td><strong> : </strong></td>
                <td><strong>{{$data[0]->date[0]}}</strong></td>
            </tr>
        </table>
    </div>
    <div class="peserta-data">
        <div class="table-id"><strong>Data Calon : </strong></div>
        <div class="rp-table-container">
            <table class="rp-table">
                <thead>
                <tr>
                    <td>No.</td>
                    <td>Nama Lengkap</td>
                    <td>NIK</td>
                    <td>Jenis Kelamin</td>
                    <td>Kelas</td>
                    <td>Tanggal Daftar</td>
                </tr>
                </thead>
                <tbody>
                @php
                    $students = $data[1]->studs;
                    $iter = 0;
                @endphp
                @foreach($students as $student)
                    @php
                        $studdate = \App\Http\back\_Archive::date($student->register_time);
                        $studdate = $studdate[2].' '.$studdate[1].' '.$studdate[0];
                        $iter++;
                    @endphp
                    <tr>
                        <td>{{$iter}}.</td>
                        <td>&nbsp;&nbsp;{{$student->name}}</td>
                        <td>&nbsp;&nbsp;{{$student->citizen_identity}}</td>
                        <td>{{$student->gender}}</td>
                        <td>{{$student->grade.'/'.strtoupper($student->group)}}</td>
                        <td>{{$studdate}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    const read = () => {
        window.print();
    };
    setTimeout(read, 1000);
</script>
</body>
</html>
