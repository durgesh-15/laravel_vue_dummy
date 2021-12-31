import axios from "axios";

export default {
    actions: {
        async getPostApiCall({ commit }){
            const response = await axios.get('https://jsonplaceholder.typicode.com/todos/1');
            commit('updatePostData', response.data)
            
        },
        async getAllUser({ commit }){
            const response = await axios.get('api/user');
            commit('updateUserData', response.data.data)
        },
        reducePrice: context=> {
            setTimeout(function(){
                context.commit('reducePrice')

            },2000)
        }
    }
}