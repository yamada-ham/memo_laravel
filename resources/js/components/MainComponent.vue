<template>
<main>
<div class="inMain">
  <header-component @show-menubar-event="isMenuBar = !isMenuBar"></header-component>

  <nav id="menuBar" class="menuBar" v-show="isMenuBar">
    <div class="inMenuBar">
      <ul>
        <li v-for="li in menuLi" @key="li.id"><div class="inLi"><router-link :to="li.to">{{li.text}}</router-link></div></li>
      </ul>
    </div>
  </nav>
  <router-view />
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
      ]
    }
  },
  props:[],
  created(){
  },
  mounted(){
  },
  methods:{
    // ok($event){
    //   let classes =[];
    //   $event.path.forEach((el)=>{
    //     classes.push(el.className);
    //   });
    //   console.log(classes.indexOf('createMemoBox'));
    //   if(classes.indexOf('createMemoBox')  < 0){
    //     console.log('実行');
    //   }
    // }
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
