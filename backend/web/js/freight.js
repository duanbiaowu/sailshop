var Freight = new Vue({
    el: '#freight-template-form',
    data: {
        areas: []
    },
    methods: {
        append: function() {
            this.areas.push(this.defaultValue());
        },

        remove: function(index) {
            this.areas.splice(index, 1);
        },

        setArea: function(id) {
            $('#js-area-form').modal();
        },

        defaultValue: function() {
            return {
                weight: 1000,
                cost: 10,
                append_weight: 1000,
                append_cost: 10
            };
        }
    }
});
