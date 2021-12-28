<template>
    <div>
        <h1 class="bg-success"> This is Test Components</h1>
        <p> this components used for testing purpose</p>
        <h5 v-for="item in saleProducts">
            {{item.name}}
            {{item.price}}
        </h5>
        
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
        }
    }
}

</script>