<template>
    <section class="content">
        <div class="container-fluid">
            <h1>Dashboard Home </h1>
        </div>
        <div>
            <ul>
                <li v-for="product in products">
                <span class="name">{{product.name}}</span>
                <span class="price">{{product.price}}</span> 
                </li>
            </ul>
        </div>
        <div>
            <ul>
                <li v-for="item in items">
                    <span class="item">{{item.name}}</span>
                    <span class="price">{{item.price}}</span>
                </li>
            </ul>
        </div>
        <div>
            <test-component></test-component>
        </div>
    </section>
</template>

<script>
import TestComponent from './TestComponent.vue';
export default {
  components: { TestComponent },
        mounted() {
            console.log('Component mounted.')
        },
        computed: {
            products(){
                return this.$store.state.products;
            },
            items(){
                return this.$store.state.items;
            }
        }
    }
</script>
