window._sidebar = {
    list : {},
    new  : function (doc, accessor) {
        if (typeof doc === 'string') {
            doc  = document.getElementById(doc);
        }
        doc.accessor = accessor;
        const id = doc.getAttribute('id');
        _sidebar.list[id] = doc;
    },
    add  : function (id, object) {
        const list = _sidebar.list[id];
        if (list.children.length === 1 && list.children[0].getAttribute('data-empty') === '1') {
            list.innerHTML = '';
        }
        const item = document.createElement('li');
        const anch = document.createElement('a');
        const span = document.createElement('span');
        item.setAttribute('class', 'sidebar-item');
        item.setAttribute('id', id + '-' + object.id);
        anch.setAttribute('href', list.accessor + '/' + object.name);
        anch.setAttribute('class', 'sidebar-link');
        span.setAttribute('class', 'hide-menu');
        span.innerHTML = object.name.toUpperCase();
        anch.appendChild(span);
        item.appendChild(anch);
        list.appendChild(item);
    },
    remove : function (id, target) {
        console.log(id + '-' + target);
        const list   = _sidebar.list[id];
        target       = document.getElementById(id + '-' + target);
        list.removeChild(target);
        if (list.children.length === 0) {
            const empty = document.createElement('li');
            const anchr = document.createElement('a');
            const spans = document.createElement('span');
            empty.setAttribute('class', 'sidebar-item');
            empty.setAttribute('data-empty', '1');
            anchr.setAttribute('class', 'sidebar-link');
            anchr.setAttribute('href', '#');
            spans.setAttribute('class','hide-menu text-muted');
            empty.appendChild(anchr);
            anchr.appendChild(spans);
            list.appendChild(empty);
        }
    }
}
