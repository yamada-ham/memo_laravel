<template>
<main @click="ok($event)">

  <!-- <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/Thank">商品情報</router-link>
  </nav>
  <router-view /> -->
  <curd-memo-component></curd-memo-component>

</main>
</template>

<script>
import CurdMemoComponent from './CurdMemoComponent'
export default {
  components:{CurdMemoComponent},
  data(){
    return{
    }
  },
  props:[],
  created(){
  },
  mounted(){
  },
  methods:{
    ok($event){
      let classes =[];
      $event.path.forEach((el)=>{
        classes.push(el.className);
      });
      console.log(classes.indexOf('createMemoBox'));
      if(classes.indexOf('createMemoBox')  < 0){
        console.log('実行');
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
