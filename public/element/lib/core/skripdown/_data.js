//@ NAME   : _ui_factory LIB
//@ HANDLE : document object UI.
//@ AUTHOR : Malko.

window._data = {
    __retrieve: function (object) {
        let data = object._refresh();
        let new_memory = {};
        if (!Array.isArray(data))
            data = [data];
        for (let i = 0; i < data.length; i++) {
            new_memory[data[i].id] = data[i];
            if (i+1 < data.length)
                data[i]._next = data[i+1];
            else
                data[i]._next = undefined;
        }
        if (data.length > 0)
            object._first = data[0];
        object.data = null;
        object._len = data.length;
        object.data = new_memory;
    },
    insert: function (pointer=(_data.level.data), id, data) {
        pointer[id] = data;
    },
    get: function (pointer=(_data.level.data), id) {
        return pointer[id];
    },
    level : {
        data : {},
        _len: 0,
        _first : undefined,
        _refresh : undefined,
        refresh : function (fun=undefined) {
            if (fun !== undefined)
                _data.level._refresh = fun;
            _data.__retrieve(_data.level);
        }
    },
    grade : {
        data : {},
        _len: 0,
        _first : undefined,
        _refresh : undefined,
        refresh : function (fun=undefined) {
            if (fun !== undefined)
                _data.grade._refresh = fun;
            _data.__retrieve(_data.grade);
        }
    },
    group : {
        data : {},
        _len: 0,
        _first : undefined,
        _refresh : undefined,
        refresh : function (fun=undefined) {
            if (fun !== undefined)
                _data.group._refresh = fun;
            _data.__retrieve(_data.group);
        }
    },
    student : {
        data : {},
        _len: 0,
        _first : undefined,
        _refresh : undefined,
        refresh : function (fun=undefined) {
            if (fun !== undefined)
                _data.student._refresh = fun;
            _data.__retrieve(_data.student);
        }
    },
    veryfied : {
        data : {},
        _len: 0,
        _first : undefined,
        _refresh : undefined,
        refresh : function (fun=undefined) {
            if (fun !== undefined)
                _data.veryfied._refresh = fun;
            _data.__retrieve(_data.veryfied);
        }
    },
    unveryfied : {
        data : {},
        _len: 0,
        _first : undefined,
        _refresh : undefined,
        refresh : function (fun=undefined) {
            if (fun !== undefined)
                _data.unveryfied._refresh = fun;
            _data.__retrieve(_data.unveryfied);
        }
    },
    teacher : {
        data : {},
        _len: 0,
        _first : undefined,
        _refresh : undefined,
        refresh : function (fun=undefined) {
            if (fun !== undefined)
                _data.teacher._refresh = fun;
            _data.__retrieve(_data.teacher);
        }
    },
}
