<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Pendaftaran</title>
    <link rel="icon" type="image/png" href="{{asset(env('ICON_PATH'))}}">
    <link rel="stylesheet" href="{{asset(env('CSS_SUB').'bootstrap.css')}}">
    <style>#main{height:95vh}#footer{height:5vh}</style>
    <script>
        window.rec = {!! $data !!};
    </script>
</head>
<body>
<div class="container-fluid">
    <div id="main">
        <div class="row pt-5">
            <div class="col-lg-2 col-md-1"></div>
            <div class="col-lg-8 col-md-10">
                <h1 id="daftar" class="card-title text-center pt-5 pb-5"></h1>
                <div class="row">
                    <div class="col-lg-2 col-md-1"></div>
                    <div id="card-fill" class="col-lg-8 col-md-10">
                        <h3 class="h3">Status Pendaftaran</h3>
                        <h4 class="h4 text-muted">status : <span id="control-status" class="text-warning"></span></h4>
                        <hr>
                        <form class="form-group">
                            <h6 class="text-dark mt-4">Nama lengkap siswa</h6>
                            <label for="nama-siswa" class="d-none">Nama</label>
                            <input class="form-control" type="text" id="nama-siswa" value="malkolp" disabled>
                            <h6 class="text-dark mt-4">Nomor Induk Kependudukan Siswa</h6>
                            <label for="nik" class="d-none">Nama</label>
                            <input class="form-control" type="text" id="nik" value="malkolp" disabled>
                            <h6 class="text-dark mt-4">Tujuan Pendidikan Siswa</h6>
                            <label for="tujuan-pendidikan" class="d-none">Nama</label>
                            <input class="form-control" type="text" id="tujuan-pendidikan" value="malkolp" disabled>
                            <h6 class="text-dark mt-4">Tanggal Registrasi</h6>
                            <label for="tanggal-registrasi" class="d-none">Nama</label>
                            <input class="form-control" type="text" id="tanggal-registrasi" value="malkolp" disabled>
                        </form>
                        <hr>
                        <p class="text-muted">
                            Proses verifikasi yang dilakukan oleh admin mungkin membutuhkan waktu beberapa jam.
                        </p>
                    </div>
                    <div class="col-lg-2 col-md-1"></div>
                </div>
            </div>
            <div class="col-lg-2 col-md-1"></div>
        </div>
    </div>
    <div id="footer" class="text-center">
        Copyright © {{env('APP_YEAR')}}. From <a href="{{env('APP_AUTHOR_INFO')}}" target="_blank" class="px-1 font-weight-bold text-dark">{{env('APP_NAME')}}</a> All rights reserved.
    </div>
</div>
<script>
    const control_status  = document.getElementById('control-status');
    const control_nama    = document.getElementById('nama-siswa');
    const control_nik     = document.getElementById('nik');
    const control_target  = document.getElementById('tujuan-pendidikan');
    const control_tanggal = document.getElementById('tanggal-registrasi');

    if (!rec.verified) {
        control_status.innerText = 'menunggu verifikasi admin.';
        control_status.setAttribute('class', 'text-warning');
    }
    else {
        control_status.innerText = 'sudah terverifikasi.';
        control_status.setAttribute('class', 'text-success');
    }
    control_nama.value   = rec.student.name;
    control_nik.value    = rec.student.citizen_identity;
    control_target.value = rec.student.level.name.toUpperCase() + ' kelas ' + rec.student.grade.grade + '' + rec.student.group.name.toUpperCase();
    const res            = /(\d{4})-(\d{2})-(\d{2})/m.exec(rec.updated_at);
    const year           = res[1];
    const day            = res[3];
    let month;
    if (res[2] === '01')
        month = 'januari';
    else if (res[2] === '02')
        month = 'februari';
    else if (res[2] === '03')
        month = 'maret';
    else if (res[2] === '04')
        month = 'april';
    else if (res[2] === '05')
        month = 'mei';
    else if (res[2] === '06')
        month = 'juni';
    else if (res[2] === '07')
        month = 'juli';
    else if (res[2] === '08')
        month = 'agustus';
    else if (res[2] === '09')
        month = 'september';
    else if (res[2] === '10')
        month = 'oktober';
    else if (res[2] === '11')
        month = 'november';
    else
        month = 'desember';
    control_tanggal.value = day + ' ' + month + ' ' + year;

</script>
</body>
</html>
