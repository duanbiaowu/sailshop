(function() {
    var Goods = new Vue({
        el: '#js-goods-detail',
        data: {
            attribute: ''
        },
        methods: {
            renderAttribute: function() {
                if (isNaN(this.attribute)) {
                    return false;
                }
                $.get('/goods/attribute/value', {id : this.attribute}, function(response) {
                    for (var i in response) {
                        console.log(JSON.parse(response[i].items));
                    }
                }, 'json');
            }
        }
    });

}());