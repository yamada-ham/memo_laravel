import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    message:'storeだよ',
    isMask:false
  },
  getters: {
    getIsmask(state,getters){
      return this.state.isMask;
    }
  },
  mutations: {
    mutIsMask(state, payload) {
      state.isMask = !state.isMask
    },
  },
  actions: {

  }
})
export default store
