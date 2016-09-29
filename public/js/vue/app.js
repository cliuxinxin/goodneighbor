var vm = new Vue({
    el: '#zouni',
    data: {
        message : ''
    },
    methods: {
        newThing: function (event) {
            alert(message);
        }
    }
})