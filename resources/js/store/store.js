import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        products: [
            { name: "Banana Skin", price: 23},
            { name: "shiny star", price: 25},
            { name: "Green shells", price: 30},
            { name: "Red shells", price: 50},
        ],
        items: [
            { name: "Computer", price: 20000},
            { name: "Mobile", price: 10000},
            { name: "Tablet", price: 28000},
            { name: "Mac Book", price: 50000},
        ],
        postData: { }
    },
    getters: {
        saleProducts: state => {
            var saleProducts = state.products.map(product => {
                return {
                    name: '**' + product.name + '**',
                    price: product.price * 2 
                }
            });
            return saleProducts;
        }
    },
    mutations: {
        reducePrice: state => {
            state.products.forEach(product => {
                product.price =1;
            });
        },
        updatePostData(state, payload){
            state.postData = payload;
        }
    },
    actions: {
        async getPostApiCall({ commit}){
            const response = await axios.get('https://jsonplaceholder.typicode.com/todos/1');
            commit('updatePostData', response.data)
        },
        reducePrice: context=> {
            setTimeout(function(){
                context.commit('reducePrice')

            },2000)
        }
    }
})