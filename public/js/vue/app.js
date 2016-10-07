var vm = new Vue({
    el:'#app',

    data:{
        things:[]
    },

    created:function(){
        this.getThings();
    },

    methods:{
        getThings:function(){
        this.$http.get('api/things').then((response) => {
            vm.things = response.body;
            }, (response) => {
            // error callback
         });
        }
    }


})
