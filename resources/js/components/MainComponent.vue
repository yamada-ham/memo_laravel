<template>
<main>

  <!-- <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/Thank">商品情報</router-link>
  </nav>
  <router-view /> -->
  <!-- <create-memo-component></create-memo-component> -->
</main>
</template>

<script>
import CreateMemoComponent from './CreateMemoComponent'
export default {
  components:{CreateMemoComponent},
  data(){
    return{

    }
  },
  props:['memoParam'],
  created(){
    console.log(this.$store.state.message);
  },
  mounted(){

  },
  beforeUpdate(){
    console.log(this.memoParam);
  },
  methods:{
  },
  computed:{

  },
  watch:{
    memoParam:{
    handler:(newval,oldval)=>{
      console.log(newval);
    },
    deep: true,
    immediate: false
      }
    }
}
</script>
