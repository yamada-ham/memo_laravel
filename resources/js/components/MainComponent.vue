<template>
<main>
<div class="inMain">
  <header-component @show-menubar-event="showMenuBar()"></header-component>

  <div class="contentsBox">
  <nav id="menuBarBox" class="menuBarBox" :style="menuBarData.css">
    <div class="inMenuBarBox" :style="inMenuBarData.css">
      <ul>
        <li v-for="li in menuLi" @key="li.id"><div class="inMenuBarLi"><router-link :to="li.to" :style="routerLinkData.css">
          <div class="inMenuRouterLink">
            <p class="menuBarIcon"><i :class="li.iconClass"></i></p><p class="menuBarText" v-show="isLiTest">{{li.text}}</p>
          </div>
        </router-link></div></li>
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
        {id:0,text:'メモ',to:'/',iconClass:'fas fa-book memo'},
        {id:1,text:'アーカイブ',to:'/archive',iconClass:'fas fa-archive archive'},
        {id:2,text:'ゴミ箱',to:'/archive',iconClass:'fas fa-trash-alt'},
      ],
      isLiTest:false,
      menuBarData:{css:{width:'10%'}},
      inMenuBarData:{css:{width:'10%'}},
      routerLinkData:{css:{width:'0%'}}
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
        this.inMenuBarData.css.width = '200px'
        this.routerLinkData.css.width = '100%'
        this.isLiTest = true
      }else{
        this.menuBarData.css.width = '10%'
        this.inMenuBarData.css.width = '10%'
        this.routerLinkData.css.width = '0%'
        this.isLiTest = false
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
