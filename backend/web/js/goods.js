var Goods = new Vue({
    el: '#js-goods-detail',
    data: {
        attribute: '',
        attributeMethods: ['Text', 'Textarea', 'Checkbox', 'Select'],
        attributeForms: [],
        attributeValue: [],

        skuItems: [],
        skuCombination: [],
        skuCombinationValue: [],

        skuBatchInfo: {
            status: 'none',
            items: {
                cost_price: '0.00',
                market_price: '0.00',
                sale_price: '0.00',
                stock: '0'
            }
        }
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

        renderSkuTable: function() {
            this.skuItems = this.skuSelector();
            this.skuCombination = [];
            if (this.skuItems.length) {
                this.descartes(0, {name: '', index: ''});
            }
        },

        skuSelector: function() {
            var result = [];
            $('.js-spec-item').each(function(index) {
                var checkedItems = $(this).find(':checkbox:checked');
                if (checkedItems.length > 0) {
                    result[result.length] = [];
                    checkedItems.each(function() {
                        result[result.length - 1].push({
                            name: $(this).data('title'),
                            value: $(this).val()
                        });
                    });
                }
            });
            return result;
        },

        descartes: function(index, result) {
            if (index >= this.skuItems.length) {
                result.name = result.name.substr(0, result.name.length - 2);
                result.index = result.index.substr(0, result.index.length - 1);

                if (this.skuCombinationValue[result.index] == undefined) {
                    this.skuCombinationValue[result.index] = this.skuDefaultValue();
                } else {
                    this.skuCombinationValue[result.index] = this.skuCombinationValue[result.index];
                }

                return this.skuCombination.push(result);
            }

            var item = this.skuItems[index];
            for (var i = 0; i < item.length; i++) {
                var theResult = {
                    name: result.name + item[i].name + ' | ',
                    index: result.index + item[i].value + '_'
                };

                this.descartes(index + 1, theResult);
            }
        },

        skuDefaultValue: function() {
            return {
                cost_price: '0.00',
                market_price: '0.00',
                sale_price: '0.00',
                stock: '0',
                weight: '0'
            };
        },

        format: function(event) {
            var params = event.target.name.split('[');
            var index = params[1].substr(0, params[1].length - 1);

            var special = ['stock', 'weight'];
            if (isNaN(event.target.value)) {
                event.target.value = special.indexOf(params[0]) >= 0 ? '0' : '0.00';
            } else if (special.indexOf(params[0]) >= 0) {
                event.target.value = parseInt(event.target.value);
            } else {
                event.target.value = parseFloat(event.target.value).toFixed(2);
            }

            this.skuCombinationValue[index][params[0]] = event.target.value;
        },

        skuBatchSetting: function() {
            if (this.skuBatchInfo.status == 'none') {
                return this.skuBatchInfo.status = 'block';
            }

            for (var i in this.skuBatchInfo.items) {
                this.skuBatchInfo.items[i] = this.skuValueFormat(i, this.skuBatchInfo.items[i]);
            }

            for (var index in this.skuCombination) {
                for (i in this.skuBatchInfo.items) {
                    this.skuCombinationValue[this.skuCombination[index].index][i] = this.skuBatchInfo.items[i];
                }
            }
        },

        skuValueFormat: function(type, value) {
            if (isNaN(value)) {
                return type == 'stock' ? '0' : '0.00';
            } else {
                return type == 'stock' ? parseInt(value) : parseFloat(value).toFixed(2);
            }
        }
    }
});