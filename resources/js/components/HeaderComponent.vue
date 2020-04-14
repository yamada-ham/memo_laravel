<template>
<header :class="['header',{shadow:isShadow}]">
<div class="inHeader">
  <!-- <div class="menuTitleBox"> -->
    <!-- <div class="inMenuTitleBox"> -->
    <div class="menuBtnBox">
      <div class="inMenuBtnBox">
        <button @click="showMenubar()"><i class="fas fa-bars"></i></button>
      </div>
    </div>
    <div class="titleBox">
      <div class="inTitleBox">
        <h1>
          <a><img src="img/memo.png"></a>
        </h1>
      </div>
    </div>
  <!-- </div> -->
  <!-- </div> -->
  <div class="searchFormBox">
    <div class="inSearchFormBox" :class="{focus:isFocus}">
      <form>
        <button class="searchBtn" @click.prevent><i class="fas fa-search"></i></button>
        <input type="text" @focus="isFocus = true" @blur="isFocus = false">
        <button class="searchTextDelBtn" @click.prevent><i class="fas fa-times"></i></button>
      </form>
    </div>
  </div>
  <div class="reloadBox">
    <div class="inReloadBox">
      <button @click.prevent><i class="fas fa-redo"></i></button>
    </div>
  </div>
  <div class="settingBtnBox">
    <div class="inSettingBtnBox">
      <button @click.prevent><i class="fas fa-cog"></i></button>
    </div>
  </div>
  <div class="accountBtnBox">
    <div class="inAccountBtnBox">
      <button @click.prevent><i class="fas fa-user-circle"></i></button>
    </div>
  </div>
</div>
</header>
</template>

<script>
// import store from '../store/store.js';
// import MemoCardComponent from './MemoCardComponent'
export default {
  components:{},
  data(){
    return{
      isShadow:false,
      isFocus:false
    }
  },
  props:[],
  created(){
    window.addEventListener('scroll',(e)=>{
      if(window.scrollY > 0){
        this.isShadow = true
      }else{
        this.isShadow = false
      }
    })
  },
  mounted(){
  },
  methods:{
    showMenubar(){
        this.$emit('show-menubar-event')
    }
  },
  computed:{

  }
}
</script>
