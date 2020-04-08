import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    message:'storeだよ',
    isMask:false,
    colorPallete:[
      {'id':0,'name':'白','hex':'#ffffff'},
      {'id':1,'name':'赤','hex':'#ff7474'},
      {'id':2,'name':'青','hex':'#5e7dff'},
      {'id':3,'name':'黄','hex':'#f8fe94'},
      {'id':4,'name':'緑','hex':'#86ffba'},
      {'id':5,'name':'紫','hex':'#d394ff'},
      {'id':6,'name':'橙','hex':'#feb365'},
      {'id':7,'name':'灰','hex':'#d0d0d0'},
      {'id':8,'name':'桃','hex':'#fb92da'},
      {'id':9,'name':'茶','hex':'#833f3f'}]
  },
  getters: {
    getColorPallete(state,getters){
      console.log(state.colorPallete)
      return state.colorPallete
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
