var Freight = new Vue({
    el: '#freight-template-form',
    data: {
        areas: [],
        regions: [],
        currentIndex: 0,

        attributes: []
    },
    methods: {
        append: function() {
            this.areas.push(this.defaultValue().areas);
            this.attributes.push(this.defaultValue().attribute);
        },

        remove: function(index) {
            this.areas.splice(index, 1);
        },

        setArea: function(index) {
            this.currentIndex = index;
            this.districts();
            $('#js-area-form').modal();
        },

        checkAll: function(index, regionId, event) {
            for (var i in this.regions[index].areas[regionId].cities) {
                if (!this.regions[index].areas[regionId].cities[i].disabled) {
                    this.regions[index].areas[regionId].cities[i].checked = event.target.checked;
                }
            }
        },

        checkSingle: function(index, regionId, event) {
            this.regions[index].areas[regionId].cities[event.target.value].checked = event.target.checked;

            var checked = event.target.checked;
            for (var i in this.regions[index].areas[regionId].cities) {
                if (!this.regions[index].areas[regionId].cities[i].checked) {
                    checked = false;
                    break;
                }
            }
            this.regions[index].areas[regionId].checked = checked;
        },

        create: function() {
            this.areas[this.currentIndex].cities = [];

            for (var i in this.regions) {
                for (var j in this.regions[i].areas) {
                    for (var k in this.regions[i].areas[j].cities) {
                        if (this.regions[i].areas[j].cities[k].checked) {
                            this.areas[this.currentIndex].cities.push(this.regions[i].areas[j].cities[k]);
                        }
                    }
                }
            }
        },

        districts: function() {
            var cityIndices = [];
            var otherIndices = [];
            var currentIndex = this.currentIndex;

            this.areas.map(function(value, index) {
                if (index == currentIndex) {
                    value.cities.map(function(city) {
                        cityIndices[city.id] = city.name;
                    });
                } else {
                    value.cities.map(function(city) {
                        otherIndices[city.id] = city.name;
                    });
                }
            });

            this.regions.forEach(function(region) {
                for (var i in region.areas) {
                    var regionChecked = true;
                    var regionDisabled = 'disabled';

                    for (var j in region.areas[i].cities) {
                        if (cityIndices[j]) {
                            region.areas[i].cities[j].checked = true;
                        } else {
                            region.areas[i].cities[j].checked = false;
                            regionChecked = false;
                        }

                        if (otherIndices[j]) {
                            region.areas[i].cities[j].disabled = 'disabled';
                        } else {
                            region.areas[i].cities[j].disabled = '';
                            regionDisabled = '';
                        }
                    }

                    region.areas[i].checked = regionChecked;
                    region.areas[i].disabled = regionDisabled;
                }
            });
        },

        defaultValue: function() {
            return {
                areas: {
                    cities: [],
                    weight: 1000,
                    cost: 10,
                    append_weight: 1000,
                    append_cost: 10
                },
                attribute: {
                    weight: 1000,
                    cost: 10,
                    append_weight: 1000,
                    append_cost: 10
                }
            };
        }
    }
});
