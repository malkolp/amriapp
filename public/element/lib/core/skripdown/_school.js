window._school = {
    level : {
        'sma' : {value:'sma',label:'SMA'},
        'smp' : {value:'smp',label:'SMP'},
        'sd'  : {value:'sd',label:'SD'},
        'tk'  : {value:'tk',label:'TK'},
    },
    make : function (level) {
        let start = ['sma','smp','sd','tk'];
        while (level !== undefined) {
            for (let i = 0; i < start.length; i++) {
                if (level.name === start[i])
                    start.splice(i, i+1);
            }
            level = level._next;
        }
        let vals = [];
        for (let i = 0; i < start.length; i++) {
            vals.push(_school.level[start[i]]);
        }

        return vals;
    },
    registration : function (input) {
        function makeOption(objects, part, prefix) {
            const arr = [];
            for (let i = 0; i < objects.length; i++) {
                if (!objects[i].full) {
                    const opt = document.createElement('option');
                    opt.setAttribute('value',objects[i].id);
                    opt.innerText = prefix+(' '+objects[i][part]).toUpperCase();
                    arr.push(opt);
                }
            }
            return arr;
        }

        function setOptions(options, select) {
            select.innerHTML = '';
            for (let i = 0; i < options.length; i++) {
                select.appendChild(options[i]);
            }
        }

        const levels       = input.level;
        const level_select = document.getElementById(input.sel_level);
        const grade_select = document.getElementById(input.sel_grade);
        const group_select = document.getElementById(input.sel_group);
        const root         = {};

        let node = levels._first;
        while (node !== undefined) {
            const pointer = node;
            if (pointer.open) {
                const opt = document.createElement('option');
                opt.setAttribute('value', pointer.id);
                opt.innerText = pointer.name.toUpperCase();
                level_select.appendChild(opt);
                const grades = pointer.grades;
                root[pointer.id] = {};
                root[pointer.id]['grades']  = {};
                root[pointer.id]['options'] = makeOption(grades, 'grade', 'Kelas');
                for (let i = 0; i < grades.length; i++) {
                    const grade  = grades[i];
                    if (!grade.full) {
                        const groups = grade.groups;
                        root[pointer.id]['grades'][grade.id]            = {};
                        root[pointer.id]['grades'][grade.id]['groups']  = {};
                        root[pointer.id]['grades'][grade.id]['options'] = makeOption(groups, 'name', 'Ruang');

                    }
                }
            }
            node = node._next;
        }
        setOptions(root[level_select.value]['options'], grade_select);
        setOptions(root[level_select.value]['grades'][grade_select.value]['options'], group_select);

        level_select.addEventListener('change',function () {
            setOptions(root[level_select.value]['options'], grade_select);
            setOptions(root[level_select.value]['grades'][grade_select.value]['options'], group_select);
        });
        grade_select.addEventListener('change', function () {
            setOptions(root[level_select.value]['grades'][grade_select.value]['options'], group_select);
        })
    }
}
