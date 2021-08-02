@extends('template')

@section('title')
    {{env('APP_NAME')}}
@endsection

@section('page-description')
    {{env('APP_DESCRIPTION')}}
@endsection

@section('nav-title')
    Ummul Qurro'
@endsection

@section('app-nav')
    <li class="nav-item">
        <a class="nav-link page-scroll" href="#daftar">DAFTAR </a>
    </li>
    <li class="nav-item">
        @if (\Illuminate\Support\Facades\Auth::check())
            <a class="nav-link page-scroll" href="{{url('/dashboard')}}">ADMIN </a>
        @else
            <a class="nav-link page-scroll" href="{{url('/login')}}">LOGIN </a>
        @endif
    </li>
@endsection

@section('page-subtitle')
    {{env('APP_DESCRIPTION')}}
@endsection

@section('content-body')
    <div class="container-fluid pt-5">
        <div class="row pt-5">
            <div class="col-lg-2 col-md-1"></div>
            <div class="col-lg-8 col-md-10">
                <h1 id="daftar" class="card-title text-center pt-5 pb-5">Formulir Pendaftaran</h1>
                <div class="row">
                    <div class="col-lg-2 col-md-1"></div>
                    <div id="card-fill" class="col-lg-8 col-md-10">
                        <div class="form-group">
                            <div class="card-title h4" style="margin-bottom: -0.5rem">
                                <div class="row">
                                    <div class="col-3" id="tab-title-anak">
                                        Data Anak
                                    </div>
                                    <div class="col-3" id="tab-title-ayah">
                                        Data Ayah
                                    </div>
                                    <div class="col-3" id="tab-title-ibu">
                                        Data Ibu
                                    </div>
                                    <div class="col-3" id="tab-title-pembayaran">
                                        Pembayaran
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div id="tab-body-anak">
                                <label for="form-nama" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nama lengkap calon siswa</h6>
                                <input id="form-nama" type="text" class="form-control" placeholder="nama">
                                <label for="form-nik" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nomor induk kependudukan calon siswa</h6>
                                <input id="form-nik" type="text" class="form-control" placeholder="NIK">
                                <h6 class="h6 text-dark mt-4 mb-2 small">jenis kelamin</h6>
                                <div>
                                    <div class="form-check form-check-inline mr-5">
                                        <input class="form-check-input mr-4" type="radio" name="jenisKelamin" id="form-jenis-kelamin-1" value="laki-laki" checked>
                                        <label class="form-check-label" for="form-jenis-kelamin-1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-5">
                                        <input class="form-check-input mr-4" type="radio" name="jenisKelamin" id="form-jenis-kelamin-2" value="perempuan">
                                        <label class="form-check-label" for="form-jenis-kelamin-2">Perempuan</label>
                                    </div>
                                </div>
                                <h6 class="h6 text-dark mt-4 mb-2 small">tempat tanggal lahir</h6>
                                <div class="row">
                                    <div class="col-2">
                                        <label for="form-tanggal-lahir-siswa" class="d-none"></label>
                                        <select name="" id="form-tanggal-lahir-siswa" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="form-bulan-lahir-siswa" class="d-none"></label>
                                        <select name="" id="form-bulan-lahir-siswa" class="form-control">
                                            <option value="januari">januari</option>
                                            <option value="februari">februari</option>
                                            <option value="maret">maret</option>
                                            <option value="april">april</option>
                                            <option value="mei">mei</option>
                                            <option value="juni">juni</option>
                                            <option value="juli">juli</option>
                                            <option value="agustus">agustus</option>
                                            <option value="september">september</option>
                                            <option value="oktober">oktober</option>
                                            <option value="november">november</option>
                                            <option value="desember">desember</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="form-tahun-lahir-siswa" class="d-none"></label>
                                        <input id="form-tahun-lahir-siswa" type="text" class="form-control" placeholder="tahun">
                                    </div>
                                    <div class="col-5">
                                        <label for="form-tempat-lahir-siswa" class="d-none"></label>
                                        <input id="form-tempat-lahir-siswa" type="text" class="form-control" placeholder="tempat">
                                    </div>
                                </div>
                                <label for="form-alamat-siswa" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">alamat lengkap calon siswa</h6>
                                <input id="form-alamat-siswa" type="text" class="form-control" placeholder="alamat">
                                <h6 class="h6 text-dark mt-4 mb-2 small">tujuan pendidikan <code>tingkatan / kelas / ruang</code></h6>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="form-tingkatan-siswa" class="d-none"></label>
                                        <select name="" id="form-tingkatan-siswa" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="form-kelas-siswa" class="d-none"></label>
                                        <select name="" id="form-kelas-siswa" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="form-ruang-siswa" class="d-none"></label>
                                        <select name="" id="form-ruang-siswa" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <h6 class="h6 text-dark mt-4 mb-2 small">status anak</h6>
                                <div>
                                    <div class="form-check form-check-inline mr-5">
                                        <input class="form-check-input mr-4" type="radio" name="status_anak" id="form-status-anak-1" value="anak kandung" checked>
                                        <label class="form-check-label" for="form-status-anak-1">Kandung</label>
                                    </div>
                                    <div class="form-check form-check-inline ml-5">
                                        <input class="form-check-input mr-4" type="radio" name="status_anak" id="form-status-anak-2" value="anak angkat">
                                        <label class="form-check-label" for="form-status-anak-2">Angkat</label>
                                    </div>
                                </div>
                                <h6 class="h6 text-dark mt-4 mb-2 small">Foto profil <code>dalam ukuran 3x4</code></h6>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="form-foto">
                                        <label class="custom-file-label" for="form-foto">Pilih Berkas</label>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div id="tab-body-ayah">
                                <label for="form-nama-ayah" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nama lengkap ayah</h6>
                                <input id="form-nama-ayah" type="text" class="form-control" placeholder="nama">
                                <label for="form-nik-ayah" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nomor induk kependudukan ayah</h6>
                                <input id="form-nik-ayah" type="text" class="form-control" placeholder="NIK">
                                <h6 class="h6 text-dark mt-4 mb-2 small">tempat tanggal lahir</h6>
                                <div class="row">
                                    <div class="col-2">
                                        <label for="form-tanggal-lahir-ayah" class="d-none"></label>
                                        <select name="" id="form-tanggal-lahir-ayah" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="form-bulan-lahir-ayah" class="d-none"></label>
                                        <select name="" id="form-bulan-lahir-ayah" class="form-control">
                                            <option value="januari">januari</option>
                                            <option value="februari">februari</option>
                                            <option value="maret">maret</option>
                                            <option value="april">april</option>
                                            <option value="mei">mei</option>
                                            <option value="juni">juni</option>
                                            <option value="juli">juli</option>
                                            <option value="agustus">agustus</option>
                                            <option value="september">september</option>
                                            <option value="oktober">oktober</option>
                                            <option value="november">november</option>
                                            <option value="desember">desember</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="form-tahun-lahir-ayah" class="d-none"></label>
                                        <input id="form-tahun-lahir-ayah" type="text" class="form-control" placeholder="tahun">
                                    </div>
                                    <div class="col-5">
                                        <label for="form-tempat-lahir-ayah" class="d-none"></label>
                                        <input id="form-tempat-lahir-ayah" type="text" class="form-control" placeholder="tempat">
                                    </div>
                                </div>
                                <label for="form-alamat-ayah" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">alamat lengkap ayah</h6>
                                <input id="form-alamat-ayah" type="text" class="form-control" placeholder="alamat">
                                <label for="form-no-hp-ayah" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nomor telepon ayah</h6>
                                <input id="form-no-hp-ayah" type="text" class="form-control" placeholder="nomor telepon">
                                <label for="form-email-ayah" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">alamat e-mail ayah</h6>
                                <input id="form-email-ayah" type="text" class="form-control" placeholder="e-mail">
                                <label for="form-pekerjaan-ayah" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">pekerjaan ayah</h6>
                                <input id="form-pekerjaan-ayah" type="text" class="form-control" placeholder="pekerjaan">
                                <label for="form-penghasilan-ayah" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">penghasilan ayah <code>per bulan</code></h6>
                                <input id="form-penghasilan-ayah" type="text" class="form-control" placeholder="penghasilan (rupiah)">
                            </div>
                            <div id="tab-body-ibu">
                                <label for="form-nama-ibu" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nama lengkap ibu</h6>
                                <input id="form-nama-ibu" type="text" class="form-control" placeholder="nama">
                                <label for="form-nik-ibu" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nomor induk kependudukan ibu</h6>
                                <input id="form-nik-ibu" type="text" class="form-control" placeholder="NIK">
                                <h6 class="h6 text-dark mt-4 mb-2 small">tempat tanggal lahir</h6>
                                <div class="row">
                                    <div class="col-2">
                                        <label for="form-tanggal-lahir-ibu" class="d-none"></label>
                                        <select name="" id="form-tanggal-lahir-ibu" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="form-bulan-lahir-ibu" class="d-none"></label>
                                        <select name="" id="form-bulan-lahir-ibu" class="form-control">
                                            <option value="januari">januari</option>
                                            <option value="februari">februari</option>
                                            <option value="maret">maret</option>
                                            <option value="april">april</option>
                                            <option value="mei">mei</option>
                                            <option value="juni">juni</option>
                                            <option value="juli">juli</option>
                                            <option value="agustus">agustus</option>
                                            <option value="september">september</option>
                                            <option value="oktober">oktober</option>
                                            <option value="november">november</option>
                                            <option value="desember">desember</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="form-tahun-lahir-ibu" class="d-none"></label>
                                        <input id="form-tahun-lahir-ibu" type="text" class="form-control" placeholder="tahun">
                                    </div>
                                    <div class="col-5">
                                        <label for="form-tempat-lahir-ibu" class="d-none"></label>
                                        <input id="form-tempat-lahir-ibu" type="text" class="form-control" placeholder="tempat">
                                    </div>
                                </div>
                                <label for="form-alamat-ibu" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">alamat lengkap ibu</h6>
                                <input id="form-alamat-ibu" type="text" class="form-control" placeholder="alamat">
                                <label for="form-no-hp-ibu" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">nomor telepon ibu</h6>
                                <input id="form-no-hp-ibu" type="text" class="form-control" placeholder="nomor telepon">
                                <label for="form-email-ibu" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">alamat e-mail ibu</h6>
                                <input id="form-email-ibu" type="text" class="form-control" placeholder="e-mail">
                                <label for="form-pekerjaan-ibu" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">pekerjaan ibu</h6>
                                <input id="form-pekerjaan-ibu" type="text" class="form-control" placeholder="pekerjaan">
                                <label for="form-penghasilan-ibu" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">penghasilan ibu <code>per bulan</code></h6>
                                <input id="form-penghasilan-ibu" type="text" class="form-control" placeholder="penghasilan (rupiah)">
                            </div>
                            <div id="tab-body-pembayaran">
                                <h6 class="h6 text-dark mt-4 mb-2 small">Foto hasil transfer <code>dalam bentuk gambar</code></h6>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="form-transaksi">
                                        <label class="custom-file-label" for="form-transaksi">Pilih Berkas</label>
                                    </div>
                                </div>
                                <label for="form-token" class="d-none"></label>
                                <h6 class="h6 text-dark mt-4 mb-2 small">Token pendaftaran calon siswa. <code>Token dapat digunakan untuk mengecek status pendaftaran calon siswa</code></h6>
                                <input id="form-token" type="text" class="form-control" value="hHweo89He_u324F2_2d" readonly>
                                <div class="form-check form-check-inline mt-4 pt-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="setuju">
                                        <label class="custom-control-label" for="setuju">Saya setuju mendaftarkan anak saya <span id="nama-calon"></span> pada <span id="tingkatan-calon"></span> Yayasan Ummul Qurro'.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5">
                                <div class="col-6">
                                    <button id="prev-btn" class="btn btn-secondary" type="button">kembali</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button id="next-btn" class="btn btn-secondary" type="button">berikutnya</button>
                                    <button id="submit-btn" class="btn btn-success" type="button">daftar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-1"></div>
                </div>
            </div>
            <div class="col-lg-2 col-md-1"></div>
        </div>
    </div>
@endsection

@section('style-head')
    <style>#header{background-image: url("{{env('BG_PATH')}}");}</style>
@endsection

@section('script-head')
    <script>@include('root.token')</script>
    <script>
        const levels  = _data.level;
        levels.refresh(function () {_response.get('{{url('/levels')}}',false);return _response.response;});
    </script>
@endsection

@section('script-body')
    <script src="{{env('JS_SUB').'form-control.js'}}"></script>
    <script>
        let able = false;
        let nod_ = levels._first;
        while (nod_ !== undefined) {
            if (nod_.open) {
                able = true;
                break;
            }
            nod_ = nod_._next;
        }
        if (able) {
            console.log('len = '+levels._len);
            tabs.init({prev : 'prev-btn', next : 'next-btn', submit : 'submit-btn'});
            tabs.add([
                {title : 'tab-title-anak', body : 'tab-body-anak',},
                {title : 'tab-title-ayah', body : 'tab-body-ayah',},
                {title : 'tab-title-ibu', body : 'tab-body-ibu',},
                {title : 'tab-title-pembayaran', body : 'tab-body-pembayaran',}
            ]);

            collections.set({
                name : 'form-daftar',
                submit : 'submit-btn',
                fields : [
                    {el:'form-nama', name:'nama_siswa', validator : 'name'},
                    {el:'form-nik', name:'nik_siswa', validator : 'number'},
                    {el:['form-jenis-kelamin-1','form-jenis-kelamin-2'], name:'jenis_kelamin',},
                    {el:'form-tanggal-lahir-siswa', name:'tanggal_lahir_siswa'},
                    {el:'form-bulan-lahir-siswa', name:'bulan_lahir_siswa'},
                    {el:'form-tahun-lahir-siswa', name:'tahun_lahir_siswa', validator: 'year'},
                    {el:'form-tempat-lahir-siswa', name:'tempat_lahir_siswa', validator: 'name'},
                    {el:'form-alamat-siswa', name:'alamat_siswa',},
                    {el:'form-tingkatan-siswa', name:'tingkatan_siswa',},
                    {el:'form-kelas-siswa', name:'kelas_siswa',},
                    {el:'form-ruang-siswa', name:'ruang_siswa',},
                    {el:['form-status-anak-1','form-status-anak-2'], name:'status_anak',},
                    {el:'form-foto', name:'foto_siswa', validator: 'noEmpty'},
                    {el:'form-nama-ayah', name:'nama_ayah', validator: 'name'},
                    {el:'form-nik-ayah', name:'nik_ayah', validator: 'number'},
                    {el:'form-tanggal-lahir-ayah', name:'tanggal_lahir_ayah'},
                    {el:'form-bulan-lahir-ayah', name:'bulan_lahir_ayah'},
                    {el:'form-tahun-lahir-ayah', name:'tahun_lahir_ayah', validator: 'year'},
                    {el:'form-tempat-lahir-ayah', name:'tempat_lahir_ayah', validator: 'name'},
                    {el:'form-alamat-ayah', name:'alamat_ayah',},
                    {el:'form-no-hp-ayah', name:'no_hp_ayah', validator: 'phone'},
                    {el:'form-email-ayah', name:'email_ayah', validator: 'email'},
                    {el:'form-pekerjaan-ayah', name:'pekerjaan_ayah',},
                    {el:'form-penghasilan-ayah', name:'penghasilan_ayah', validator: 'number'},
                    {el:'form-nama-ibu', name:'nama_ibu', validator: 'name'},
                    {el:'form-nik-ibu', name:'nik_ibu', validator: 'number'},
                    {el:'form-tanggal-lahir-ibu', name:'tanggal_lahir_ibu'},
                    {el:'form-bulan-lahir-ibu', name:'bulan_lahir_ibu'},
                    {el:'form-tahun-lahir-ibu', name:'tahun_lahir_ibu', validator: 'year'},
                    {el:'form-tempat-lahir-ibu', name:'tempat_lahir_ibu', validator: 'name'},
                    {el:'form-alamat-ibu', name:'alamat_ibu',},
                    {el:'form-no-hp-ibu', name:'no_hp_ibu', validator: 'phone'},
                    {el:'form-email-ibu', name:'email_ibu', validator: 'email'},
                    {el:'form-pekerjaan-ibu', name:'pekerjaan_ibu',},
                    {el:'form-penghasilan-ibu', name:'penghasilan_ibu', validator: 'number'},
                    {el:'form-transaksi', name: 'transaksi', validator: 'noEmpty'},
                    {el:'form-token', name: 'token'},
                    {el:'setuju', name: 'setuju', validator: 'check'},
                ],
            });
            _school.registration({
                level : levels,
                sel_level : 'form-tingkatan-siswa',
                sel_grade : 'form-kelas-siswa',
                sel_group : 'form-ruang-siswa',
            });
            document.getElementById('form-token').value = _rand.pass(18,'alphanumeric');
            document.getElementById('submit-btn').addEventListener('click', function () {
                const data = collections.collect('form-daftar');
                _response.post({async:false, url:'{{url('insertRegistration')}}',data:data[0],file:data[1]});
                if (_response.response._status) {
                    document.getElementById('daftar').innerHTML = '';
                    const card     = document.getElementById('card-fill');
                    card.setAttribute('style', 'margin-bottom:12rem');
                    card.innerHTML = '<h3 class="h3">Pendaftaran Berhasil !</h3><h4 class="h4 text-black-50">menunggu verifikasi admin.</h4><hr><p>Proses verifikasi yang dilakukan oleh admin mungkin membutuhkan waktu beberapa jam. Status verifikasi pendaftaran dapat dilihat pada alamat <a href="{{url('/registration')}}/'+_response.response.token+'"> ini</a>.</p>';
                }
                console.log(_response.response);
            });
        }
        else {
            document.getElementById('daftar').innerHTML = '';
            document.getElementById('card-fill').innerHTML = '<h3 class="text-muted text-center" style="padding-bottom: 12rem">Pendaftaran Belum Dibuka</h3>';
        }
    </script>
@endsection
