@extends('admin.template')

@section('title')
    {{$data->title}}
@endsection

@section('page-breadcrumb')
    {{$data->title}}
@endsection

@section('sub-breadcrumb')
    Data Riwayat {{$data->title}} {{env('APP_NAME')}}
@endsection

@section('content')
@endsection

@section('style-head')
@endsection

@section('script-head')
    <script>
        window._obj_level = {!! $data->level !!};
        const archives    = _obj_level.archives;
    </script>
@endsection

@section('script-body')
    <script>
        function datemaker(string) {
            const res            = /(\d{4})-(\d{2})-(\d{2})/m.exec(string);
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

            return [day + ' ' + month + ' ' + year, 'date-' + day + month + year];
        }
        _tagger.content = document.getElementById('content-container');

        for (let i = 0; i < archives.length; i++) {
            const archive  = archives[i];
            const studs    = archive.studs;
            const datename = datemaker(archive.updated_at);
            _tagger.tag(datename[1]);
            _card.render({
                element : datename[1],
                items   : [
                    {
                        title   : 'Arsip ' + datename[0],
                        label   : 'ti-user',
                        id      : 'data-' + datename[0],
                        content : _ui_factory.__general.compact_els('div',[
                            _btn_group.make([
                                _delete.render(function (e) {
                                    _popup.content({
                                        id : 'popup-delete-level',
                                        header : '<strong>hapus arsip pendaftaran</strong>',
                                        content : '<p>apakah anda yakin ingin menghapus arsip <code class="font-weight-bold">'+datename[0]+'</code> dari sistem?</p>',
                                        footer : _btn_group.make([
                                            _btn.render({
                                                operate : 'batal',
                                                type : 'success',
                                                title : 'batal',
                                                content : 'batal',
                                                fun : function () {
                                                    _popup.close('popup-delete-record');
                                                }
                                            }),
                                            _btn.render({
                                                operate : 'hapus',
                                                type : 'secondary',
                                                title : 'hapus',
                                                content : 'hapus',
                                                fun : function () {
                                                    _popup.close('popup-delete-record');
                                                    _transition.in();
                                                    _response.post({async:false, url:'{{url('deleteReport')}}', data:{id:archive.id}, file:new FormData()});
                                                    if (_response.response._status) {
                                                        let target = e.target;
                                                        let parent = target.parentNode;
                                                        while (parent.getAttribute('id') !== 'content-container') {
                                                            target = parent;
                                                            parent = parent.parentNode;
                                                        }
                                                        parent.removeChild(target);
                                                    }
                                                    _transition.out();
                                                }
                                            }),
                                        ]),
                                    });
                                }),
                                _btn.render({
                                    type    : 'success',
                                    title   : 'cetak laporan',
                                    operate : 'cetak',
                                    content : 'cetak laporan',
                                    fun     : function (e) {
                                        const win = window.open('{{url('/report')}}/' + archive.id, '_blank');
                                        win.focus();
                                    }
                                }),
                            ]),
                            _tables.render({
                                element  : 'table-' + datename[0],
                                template : 'custom',
                                column   : [
                                    {content : 'Profil'},
                                    {content : 'Tempat / Tanggal Lahir'},
                                    {content : 'Kelas / Ruang'},
                                    {content : 'Tanggal Daftar'},
                                ],
                            }),
                        ]),
                    }
                ],
            });
            console.log(studs);
            for (let j = 0; j < studs.length; j++) {
                const stud = studs[j];
                _tables.insert({
                    element : 'table-' + datename[0],
                    column  : [
                        {
                            content : '<div class="d-flex no-block align-items-center"><div class="mr-3"><img src="{{asset(env('PATH_STUDENT_PROFILE'))}}/'+stud.pic+'" alt="user" class="rounded-circle" width="45" height="45" /></div><div class=""><h5 class="text-dark mb-0 font-16 font-weight-medium">'+stud.name+'</h5><span class="text-muted font-14">'+stud.gender+'</span></div></div>',
                            click:function () {
                                console.log('click');
                            },
                            dblclick : function () {
                                console.log('dbl click');
                            }
                        },
                        {content : stud.place_birth + ' / ' + stud.day_birth + ' ' + stud.month_birth + ' ' + stud.year_birth,},
                        {content : 'kelas '+stud.grade + '/' + stud.group.toUpperCase()},
                        {content : datemaker(stud.register_time)[0]},

                    ],
                });
            }
        }
        _tagger.tag('popup-delete-record');
        _popup.init({element : 'popup-delete-record', align   : 'center',});
        _transition.out();
    </script>
@endsection
