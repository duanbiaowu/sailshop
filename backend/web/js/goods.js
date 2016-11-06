var Goods = new Vue({
    el: '#js-goods-detail',
    data: {
        attribute: '',
        attributeMethods: ['Text', 'Textarea', 'Checkbox', 'Select'],
        attributeForms: [],
        attributeValue: []
    },
    methods: {
        renderAttribute: function() {
            this.attributeForms = [];
            if (this.attribute == '') {
                return false;
            }

            var response = $.ajax({
                url: '/goods/attribute/value',
                data: {
                    id: this.attribute
                },
                async: false
            }).responseText;

            response = JSON.parse(response);

            for (var i in response) {
                var method = 'render' + this.attributeMethods[response[i].type];
                response[i].html = this[method].call(this, response[i]);
            }

            this.attributeForms = response;
        },

        renderText: function (data) {
            var value = this.attributeValue[data.id] || '';
            return '<input type="text" name="Goods[attributes][' + data.id + ']" class="form-control" value="' + value + '" />';
        },

        renderTextarea: function() {
            var value = this.attributeValue[data.id] || '';
            return '<textarea name="Goods[attributes][' + data.id + ']" class="form-control">' + value + '</textarea>';
        },

        renderSelect: function(data) {
            var items = JSON.parse(data.items);
            var selected = this.attributeValue[data.id] || [];
            var html =  '<select name="Goods[attributes][' + data.id + ']" class="form-control">';
            for (var i in items) {
                html += '<option ' + (items[i].value == selected ? 'selected' : '') + '>' + items[i].value + '</option>';
            }
            return html + '</select>';
        },

        renderCheckbox: function(data) {
            var items = JSON.parse(data.items);
            var checked = this.attributeValue[data.id] || [];
            var html = '';
            for (var i in items) {
                html += '<label class="checkbox-inline">' +
                            '<input name="Goods[attributes][' + data.id + '][]" type="checkbox" ' +
                                'value="' + items[i].value + '" '+ (checked.indexOf(items[i].value) >= 0 ? 'checked' : '') +'>' +
                                items[i].value +
                        '</label>';
            }
            return html;
        },

        skuForm: function(action) {
            $.get(action, function(response) {
                $('#js-spec-form').html(response).modal();
            });
        },

        skuSelector: function() {

        }
    }
});