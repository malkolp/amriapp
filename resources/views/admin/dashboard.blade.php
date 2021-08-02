@extends('admin.template')

@section('title')
    Dashboard
@endsection

@section('page-breadcrumb')
    Dashboard
@endsection

@section('sub-breadcrumb')
    Dashboard Admin {{env('APP_NAME')}}
@endsection

@section('content')
    <div id="nav-card"></div>
    <div id="make-level"></div>
@endsection

@section('style-head')
@endsection

@section('script-head')

@endsection

@section('script-body')
    <script>
        _sidebar.new('list-pendaftaran','{{url('/manage/')}}');
        _sidebar.new('list-data','/data/');
        _tagger.content = document.getElementById('content-container');
        _navcard.render({
            element : 'nav-card',
            items   : [
                {id:'amount_levels', value:level._len,label:'jumlah sekolah',icon:'home'},
                {id:'amount_students', value:student._len,label:'jumlah pendaftar',icon:'users'},
                {id:'amount_verified', value:veryfied._len,label:'terverifikasi',icon:'user-check'},
                {id:'amount_unverified', value:unveryfied._len,label:'belum terverifikasi',icon:'user-x'},
            ],
        });
        _card.render({
            element : 'make-level',
            items : [
                {
                    title : 'Data Sekolah',
                    label : 'ti-user',
                    id : 'data-sekolah',
                    content : _tables.render({
                        element : 'level-data',
                        template : 'custom',
                        column : [
                            {content : 'Tingkatan'},
                            {content : 'Jumlah Kelas'},
                            {content : 'Jumlah Pendaftar'},
                            {content : 'Terverifikasi'},
                            {content : 'Belum Terverifikasi'},
                            {content : 'Aksi'},
                        ]
                    }),
                },
                {
                    title : 'Form Tambah Sekolah',
                    label : 'ti-plus',
                    id : 'form-sekolah',
                    content : _formfield.render({
                        element : 'form-new',
                        width : ['sm-12', 'md-8', 'lg-5'],
                        fields : [
                            {name:'tingkatan',type : 'select', values:schools},
                            {name:'ruang',type : 'text',placeholder:'jumlah ruang setiap kelas'},
                            {name:'siswa',type : 'text',placeholder:'jumlah siswa setiap ruang'},
                            {type:'empty'},
                            {type:'submit', placeholder: 'tambah'},
                        ]
                    })[0],
                }
            ]
        });
        _form.for({
            submit   : 'form-new-ip-4-submit',
            elements : ['form-new-ip-0','form-new-ip-1','form-new-ip-2'],
            optional : {},
            alias    : {},
            func     : function (elements) {
                _transition.in();
                const tempData = _formdata.make(elements);
                _response.post({async:false,url:'{{url('insertLevel')}}',data:tempData[0], file: tempData[1]});
                if (_response.response._status) {
                    const school  = _response.response;
                    const name    = 'data-'+school.name;
                    const content = document.createElement('div');
                    content.setAttribute('class', 'pt-4 pb-4 mt-4 mb-4 text-center text-muted');
                    content.innerText = 'pendaftaran belum dibuka';
                    _sidebar.add('list-pendaftaran', school);
                    _sidebar.add('list-data', school);
                    _navcard.update('amount_levels',level._len + 1);
                    _navcard.success('amount_levels',1);
                    if (_select.hasOne('form-new-ip-0')) {
                        _card.hide('form-sekolah');
                    }
                    _card.focus('data-sekolah');
                    _select.remove('form-new-ip-0', tempData[0]['tingkatan']);
                    _tables.insert({
                       element : 'level-data',
                       column : [
                           {content: school.name},
                           {content: school.grades.length},
                           {content: 'tidak ada'},
                           {content: 'tidak ada'},
                           {content: 'tidak ada'},
                           {content: _delete.render(
                                function (e) {
                                    _popup.content({
                                        id : 'popup-delete-level',
                                        header : '<strong>hapus sekolah</strong>',
                                        content : '<p>apakah anda yakin ingin menghapus <code class="font-weight-bold">'+school.name.toUpperCase()+'</code> dari sistem?</p>',
                                        footer : _btn_group.make([
                                            _btn.render({
                                                operate : 'batal',
                                                type : 'success',
                                                title : 'batal',
                                                content : 'batal',
                                                fun : function () {
                                                    _popup.close('popup-delete-level');
                                                }
                                            }),
                                            _btn.render({
                                                operate : 'hapus',
                                                type : 'secondary',
                                                title : 'hapus',
                                                content : 'hapus',
                                                fun : function () {
                                                    _popup.close('popup-delete-level');
                                                    _transition.in();
                                                    let row = e.target;
                                                    while (row.tagName !== 'TR') {row = row.parentElement;}
                                                    _tables.touch('level-data', row.getAttribute('data-row'));
                                                    _response.post({async:false, url:'{{url('deleteLevel')}}', data:{level:school.name}, file:new FormData()});
                                                    if (_response.response._status) {
                                                        _card.show('form-sekolah');
                                                        _navcard.update('amount_levels', level._len - 1);
                                                        _navcard.danger('amount_levels', 1);
                                                        _tables.remove();
                                                        _card.remove('data-' + school.name);
                                                        _sidebar.remove('list-pendaftaran', school.id);
                                                        _sidebar.remove('list-data', school.id);
                                                        _select.add('form-new-ip-0',{value:school.name,label:school.name.toUpperCase()});
                                                    }
                                                    level.refresh();
                                                    _transition.out();
                                                }
                                            }),
                                        ]),
                                        type : 'secondary',
                                    });
                                })
                           },
                       ],
                    });
                    _tagger.tag(name);
                    _card.render({
                        element : name,
                        items : [
                            {
                                title : 'Data <span class="text-uppercase">'+school.name+'</span>',
                                label : 'ti-user',
                                id : 'data-'+school.name,
                                content : content
                            },
                        ],
                    });
                }
                level.refresh();
                _transition.out();
            }
        });
        if (level._len > 0) {
            if (level._len === 4)
                _card.hide('form-sekolah');
            let _node = level._first;
            let iter  = 1;
            while (_node !== undefined) {
                const name  = 'data-' + _node.name;
                const lev   = _node;
                const iter_ = iter;
                let content = undefined;
                let amount_students   = lev.students.length,
                    amount_verified   = 0,
                    amount_unverified = 0;
                if (lev.open) {
                    content = _tables.render({
                        element : 'level-'+lev.name,
                        template : 'custom',
                        column : [
                            {content : 'Profil'},
                            {content : 'Tempat Tanggal Lahir'},
                            {content : 'Kelas / Ruang'},
                            {content : 'Token'},
                            {content : 'Status Verifikasi'},
                        ]
                    });
                    const students = lev.students;
                    for (let i = 0; i < students.length; i++) {
                        const student = students[i];
                        let status;
                        if (student.registrations[0].verified) {
                            status = '<span class="text-success">terverifikasi</span>';
                            amount_verified++;
                        }
                        else {
                            status = '<span class="text-danger">belum</span>';
                            amount_unverified++;
                        }
                        _tables.insert({
                            element : 'level-'+lev.name,
                            template : 'custom',
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
                                {content : status},
                            ],
                        });
                    }
                } else {
                    content = document.createElement('div');
                    content.setAttribute('class', 'pt-4 pb-4 mt-4 mb-4 text-center text-muted');
                    content.innerText = 'pendaftaran belum dibuka';
                }
                if (amount_students === 0)
                    amount_students = 'tidak ada';
                else amount_students += ' orang';
                if (amount_verified === 0)
                    amount_verified = 'tidak ada';
                else amount_verified += ' orang';
                if (amount_unverified === 0)
                    amount_unverified = 'tidak ada';
                else amount_unverified += ' orang';
                _tagger.tag(name);
                _card.render({
                    element : name,
                    items : [
                        {
                            title : 'Data <span class="text-uppercase">'+lev.name+'</span>',
                            label : 'ti-user',
                            id : 'data-'+lev.name,
                            content : content
                        },
                    ],
                });
                _tables.insert({
                    element : 'level-data',
                    column  : [
                        {content: lev.name.toUpperCase()},
                        {content: lev.grades.length},
                        {content: amount_students},
                        {content: amount_verified},
                        {content: amount_unverified},
                        {content: _delete.render(
                                function () {
                                    _popup.content({
                                        id : 'popup-delete-level',
                                        header : '<strong>hapus sekolah</strong>',
                                        content : '<p>apakah anda yakin ingin menghapus <code class="font-weight-bold">'+lev.name.toUpperCase()+'</code> dari sistem?</p>',
                                        footer : _btn_group.make([
                                            _btn.render({
                                                operate : 'batal',
                                                type : 'success',
                                                title : 'batal',
                                                content : 'batal',
                                                fun : function () {
                                                    _popup.close('popup-delete-level');
                                                }
                                            }),
                                            _btn.render({
                                                operate : 'hapus',
                                                type : 'secondary',
                                                title : 'hapus',
                                                content : 'hapus',
                                                fun : function () {
                                                    _popup.close('popup-delete-level');
                                                    _transition.in();
                                                    _tables.touch('level-data', iter_);
                                                    _response.post({async:false, url:'{{url('deleteLevel')}}', data:{level:lev.name}, file:new FormData()});
                                                    if (_response.response._status) {
                                                        _card.show('form-sekolah');
                                                        _navcard.update('amount_levels',level._len - 1);
                                                        _navcard.danger('amount_levels',1);
                                                        _tables.remove();
                                                        _card.remove('data-' + lev.name);
                                                        _sidebar.remove('list-pendaftaran', lev.id);
                                                        _sidebar.remove('list-data', lev.id);
                                                        _select.add('form-new-ip-0',{value:lev.name,label:lev.name.toUpperCase()});
                                                    }
                                                    _transition.out();
                                                }
                                            }),
                                        ]),
                                    });
                                })
                        },
                    ]
                });
                _node = _node._next;
                iter++;
            }
        }
        _tagger.tag('popup-delete-level');
        _popup.init({element : 'popup-delete-level', align   : 'center',});
        _transition.out();
    </script>
@endsection

