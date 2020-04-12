<template>
<main>
<div class="inMain">
  <header-component @show-menubar-event="showMenuBar()"></header-component>

  <div class="contentsBox">
  <nav id="menuBarBox" class="menuBarBox" :style="menuBarData.css">
    <div class="inMenuBar">
      <ul>
        <li v-for="li in menuLi" @key="li.id"><div class="inLi"><router-link :to="li.to">{{li.text}}</router-link></div></li>
      </ul>
    </div>
  </nav>
  <router-view />
  </div>
  <!-- <menu-bar-component></menu-bar-component> -->
  <!-- <curd-memo-component></curd-memo-component> -->
</div>
</main>
</template>

<script>
// import CurdMemoComponent from './CurdMemoComponent'
import HeaderComponent from './HeaderComponent'
// import MenuBarComponent from './MenuBarComponent'
export default {
  components:{HeaderComponent},
  data(){
    return{
      isMenuBar:false,
      menuLi:[
        {id:0,text:'メモ',to:'/'},
        {id:1,text:'アーカイブ',to:'/archive'},
      ],
      menuBarData:{css:{width:'10%'}},
    }
  },
  props:[],
  created(){
  },
  mounted(){
  },
  methods:{
    showMenuBar(){
      this.isMenuBar = !this.isMenuBar
      if(this.isMenuBar){
        this.menuBarData.css.width = '20%'
      }else{
        this.menuBarData.css.width = '10%'
      }
    }
  },
  computed:{
  },
  watch:{
    // memoParam:{
    // handler:(newval,oldval)=>{
    //   console.log(newval);
    // },
    // deep: true,
    // immediate: false
    //   }
    }
}
</script>
