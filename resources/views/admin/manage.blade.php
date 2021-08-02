@extends('admin.template')

@section('title')
    {{$data->title}}
@endsection

@section('page-breadcrumb')
    {{$data->title}}
@endsection

@section('sub-breadcrumb')
    Kelola {{$data->title}} {{env('APP_NAME')}}
@endsection

@section('content')
    <div id="card-akses-pendaftaran"></div>
    <div id="card-tabel-pendaftaran"></div>
@endsection

@section('style-head')
@endsection

@section('script-head')
    <script>
        window._obj_level = {!! $data->level !!};
    </script>
@endsection

@section('script-body')
    <script>
        _tagger.content = document.getElementById('content-container');
        window.card_content = '<div class="pt-4 pb-4 mt-4 mb-4 text-center text-muted">pendaftaran belum dibuka</div>';
        window.secondary    = {
            text : '<p><span class="text-uppercase">{{$data->type}}</span> pada {{env('APP_NAME')}} dapat menerima calon peserta didik hingga <code class="font-weight-bold">'+(_obj_level.quota * _obj_level.room)+'</code> orang dimana tiap kelas memiliki <code class="font-weight-bold">'+_obj_level.room+'</code> ruang dengan quota <code class="font-weight-bold">'+_obj_level.quota+'</code> orang. Klik tombol <small class="bg-secondary text-white pt-1 pb-1 pl-2 pr-2 rounded">tutup</small> untuk menutup akses pendaftaran dan menyimpannya sebagai arsip.</p>',
            btn : 'tutup',
            role : 2,
            fun : function () {
                _popup.content({
                    id : 'popup-close-access',
                    header : '<strong>tutup akses pendaftaran</strong>',
                    content : '<p>apakah anda yakin ingin menghapus <code class="font-weight-bold">{{strtoupper($data->type)}}</code> dari sistem?</p>',
                    footer : _btn_group.make([
                        _btn.render({
                            operate : 'batal',
                            type : 'success',
                            title : 'batal',
                            content : 'batal',
                            fun : function () {
                                _popup.close('popup-close-access');
                            }
                        }),
                        _btn.render({
                            operate : 'tutup',
                            type : 'secondary',
                            title : 'tutup',
                            content : 'tutup',
                            fun : function () {
                                _popup.close('popup-close-access');
                                _transition.in();
                                _switcher.switch('switch-akses');
                                _response.post({async:false, url:'{{url('close')}}',data:{id:_obj_level.id}, file:new FormData()});
                                if (_response.response._status) {
                                    window._obj_level = _response.response;
                                    _card.remove('card-tabel-pendaftaran');
                                    _tagger.tag('card-tabel-pendaftaran');
                                    window.card_content = '<div class="pt-4 pb-4 mt-4 mb-4 text-center text-muted">pendaftaran belum dibuka</div>';
                                    _card.render({
                                        element : 'card-tabel-pendaftaran',
                                        items : [
                                            {
                                                title : 'Data Pendaftaran <span class="text-uppercase">{{$data->type}}</span>',
                                                label : 'ti-user',
                                                id : 'tabel-pendaftaran',
                                                content : card_content,
                                            }
                                        ],
                                    });
                                }
                                _transition.out();
                            }
                        }),
                    ]),
                });
            }
        }
        window.primary      = {
            text : '<p><span class="text-uppercase">{{$data->type}}</span> pada {{env('APP_NAME')}} dapat menerima calon peserta didik hingga <code class="font-weight-bold">'+(_obj_level.quota * _obj_level.room)+'</code> orang dimana tiap kelas memiliki <code class="font-weight-bold">'+_obj_level.room+'</code> ruang dengan quota <code class="font-weight-bold">'+_obj_level.quota+'</code> orang. Klik tombol <small class="bg-success text-white pt-1 pb-1 pl-2 pr-2 rounded">buka</small> untuk membuka akses pendaftaran.</p>',
            btn : 'buka',
            role : 1,
            fun : function () {
                _transition.in();
                _response.post({async:false, url:'{{url('open')}}',data:{id:_obj_level.id}, file:new FormData()});
                if (_response.response._status) {
                    window._obj_level = _response.response;
                    _card.remove('card-tabel-pendaftaran');
                    _tagger.tag('card-tabel-pendaftaran');
                    window.card_content = _tables.render({
                        element : 'table-{{$data->type}}',
                        template : 'custom',
                        column : [
                            {content : 'Profil'},
                            {content : 'Tempat / Tanggal Lahir'},
                            {content : 'Kelas / Ruang'},
                            {content : 'Token'},
                            {content : 'Aksi'},
                        ],
                    });
                    _card.render({
                        element : 'card-tabel-pendaftaran',
                        items : [
                            {
                                title : 'Data Pendaftaran <span class="text-uppercase">{{$data->type}}</span>',
                                label : 'ti-user',
                                id : 'tabel-pendaftaran',
                                content : card_content,
                            }
                        ],
                    });
                }
                _switcher.switch('switch-akses');
                _transition.out();
            }
        }
        if (_obj_level.open) {
            let temp            = window.primary;
            window.primary      = window.secondary;
            window.secondary    = temp;
            window.card_content = _tables.render({
                element : 'table-{{$data->type}}',
                template : 'custom',
                column : [
                    {content : 'Profil'},
                    {content : 'Tempat / Tanggal Lahir'},
                    {content : 'Kelas / Ruang'},
                    {content : 'Token'},
                    {content : 'Aksi'},
                ],
            });
        }
        _card.render({
            element : 'card-akses-pendaftaran',
            items : [
                {
                    title : 'Akses Pendaftaran',
                    label : 'ti-user',
                    id    : 'akses-pendaftaran',
                    content : _switcher.render({
                        id : 'switch-akses',
                        primary : window.primary,
                        secondary : window.secondary,
                    }),
                }
            ],
        });
        _card.render({
            element : 'card-tabel-pendaftaran',
            items : [
                {
                    title : 'Data Pendaftaran <span class="text-uppercase">{{$data->type}}</span>',
                    label : 'ti-user',
                    id : 'tabel-pendaftaran',
                    content : card_content,
                }
            ],
        });
        if (_obj_level.open && _obj_level.students.length > 0) {
            function insertTable(rows) {
                for (let i = 0; i < rows.length; i++) {
                    let operate_param = {};
                    const student = rows[i];
                    //const iter_   = i + 1;
                    if (student.registrations[0].verified)
                        operate_param = {type:'secondary',title:'batal verifikasi', operate:'batal', content:'batal'};
                    else
                        operate_param = {type:'success',title:'verifikasi', operate:'verifikasi', content:'verifikasi'};
                    _tables.insert({
                        element : 'table-{{$data->type}}',
                        column  : [
                            {
                                content : '<div class="d-flex no-block align-items-center"><div class="mr-3"><img src="{{asset(env('PATH_STUDENT_PROFILE'))}}/'+student.pic+'" alt="user" class="rounded-circle" width="45" height="45" /></div><div class=""><h5 class="text-dark mb-0 font-16 font-weight-medium">'+student.name+'</h5><span class="text-muted font-14">'+student.gender+'</span></div></div>',
                                click:function () {
                                    console.log('click');
                                },
                                dblclick : function () {
                                    console.log('dbl click');
                                }
                            },
                            {content : student.place_birth + ' / ' + student.day_birth + ' ' + student.month_birth + ' ' + student.year_birth,},
                            {content : 'kelas '+student.grade.grade + '/' + student.group.name.toUpperCase()},
                            {content : '<a href="{{url('/registration')}}/'+student.registrations[0].token+'" target="_blank">'+student.registrations[0].token+'</a>'},
                            {content : _btn_group.make(
                                    [
                                        _delete.render(function (e) {
                                            const event = e;
                                            _popup.content({
                                                id : 'popup-delete-record',
                                                header : '<strong>hapus data</strong>',
                                                content : '<p>apakah anda yakin ingin menghapus <code class="font-weight-bold">'+student.name+'</code> dari pendaftaran <code class="font-weight-bold">{{strtoupper($data->type)}}</code>?</p>',
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
                                                            _response.post({async:false, url:'{{url('deleteRegistration')}}', data:{token:student.registrations[0].token}, file: new FormData()});
                                                            if (_response.response._status) {
                                                                let target = event.target;
                                                                let parent = target.parentNode;
                                                                while (parent.nodeName !== 'TR') {
                                                                    parent = parent.parentNode;
                                                                }
                                                                target = parent;
                                                                parent = parent.parentNode;
                                                                parent.removeChild(target);
                                                            }
                                                            _transition.out();
                                                        }
                                                    }),
                                                ]),
                                            });
                                        }),
                                        _btn.render({
                                            type  : operate_param.type,
                                            title : operate_param.title,
                                            operate : operate_param.operate,
                                            content : operate_param.content,
                                            fun   : function (e) {
                                                _transition.in();
                                                const operate = e.target.getAttribute('data-operate');
                                                console.log('operate = '+operate);
                                                if (operate === 'verifikasi')
                                                    _response.post({async:false, url:'{{url('verify')}}', data:{token:student.registrations[0].token}, file: new FormData()});
                                                else
                                                    _response.post({async:false, url:'{{url('unverify')}}', data:{token:student.registrations[0].token}, file: new FormData()});
                                                if (_response.response._status) {
                                                    const clicked = e.target;
                                                    if (operate === 'verifikasi') {
                                                        clicked.setAttribute('class', 'btn btn-sm rounded-0 btn-secondary');
                                                        clicked.setAttribute('title', 'batal');
                                                        clicked.setAttribute('data-operate', 'batal');
                                                        clicked.innerHTML = 'batal';
                                                    }
                                                    else {
                                                        clicked.setAttribute('class', 'btn btn-sm rounded-0 btn-success');
                                                        clicked.setAttribute('title', 'verifikasi');
                                                        clicked.setAttribute('data-operate', 'verifikasi');
                                                        clicked.innerHTML = 'verifikasi';
                                                    }
                                                }
                                                _transition.out();
                                            }
                                        }),
                                    ])
                            },
                        ],
                    });
                }
            }

            const students      = _obj_level.students;
            let verified_row    = [],
                nonverified_row = [];
            for (let i = 0; i < students.length; i++) {
                if (students[i].registrations[0].verified)
                    verified_row.push(students[i]);
                else
                    nonverified_row.push(students[i]);
            }
            insertTable(nonverified_row);
            insertTable(verified_row);
        }
        _tagger.tag('popup-delete-record');
        _popup.init({element : 'popup-delete-record', align   : 'center'});
        _tagger.tag('popup-close-access');
        _popup.init({element : 'popup-close-access', align   : 'center'});
        _transition.out();
    </script>
@endsection
