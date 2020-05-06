var Permission = new Vue({
    el: '#js-menu-permission',
    data: {
        menuId: 0,
        counter: 0,
        values: []
    },

    methods: {
        setMenuId: function(id) {
            this.menuId = id;
        },
        setValues: function(values) {
            this.values = values;
        },
        add: function() {
            this.values.push({
                menu_id: this.menuId,
                name: null,
                method: null,
                query: null,
                counter: this.counter++,
            });
        },
        remove: function(index) {
            this.values.splice(index, 1);
        },
    }
});