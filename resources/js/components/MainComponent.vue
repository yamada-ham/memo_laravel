<template>
<main>
  <header-component @show-menubar-event="isMenuBar = !isMenuBar"></header-component>
  <!-- <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/Thank">商品情報</router-link>
  </nav>
  <router-view /> -->
  <nav id="menuBar" class="menuBar" v-show="isMenuBar">
    <div class="inMenuBar">
      <ul>
        <li><p><router-link to="/">メモ</router-link></p></li>
        <li><p><router-link to="/archive">アーカイブ</router-link></p></li>
      </ul>
    </div>
  </nav>
  <router-view />
  <!-- <menu-bar-component></menu-bar-component> -->
  <!-- <curd-memo-component></curd-memo-component> -->

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
      isMenuBar:false
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
