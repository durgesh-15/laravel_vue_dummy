export default {
    mutations: {
        reducePrice: state => {
            state.products.forEach(product => {
                product.price =1;
            });
        },
        updatePostData(state, payload){
            state.postData = payload;
        },
        updateUserData(state, payload){
            state.userData = payload;
        }
    }
}