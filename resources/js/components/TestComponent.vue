<template>
    <div>
        <h1 class="bg-success"> This is Test Components</h1>
        <p> this components used for testing purpose</p>
        <h5 v-for="item in saleProducts" :key="item">
            {{item.name}}
            {{item.price}}
        </h5>
        <button v-on:click="reducePrice">Reduce Price</button>
        <br><br>
        <h1> Fatch post data from rest api</h1>
        <p> {{ getProductData.title }}</p>
        
    </div>
</template>
<script>
export default {
    computed:{
        items(){
            return this.$store.state.items
        },
        saleProducts()
        {
           return this.$store.getters.saleProducts;
        },
        getProductData()
        {
            return this.$store.state.postData;
        }
    },
    methods: {

        reducePrice: function(){
            // this.$store.state.products.forEach(product => {
            //     product.price = 1;
            // });
            this.$store.dispatch('reducePrice');

        },
        callPostApi(){
            try{
                this.$store.dispatch('getPostApiCall');
            }
            catch (err) {
            this.forError(err.message, "Error");
          }
        }
    },
    created() {
        this.callPostApi();
    }
}

</script>