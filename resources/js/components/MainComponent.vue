<template>
<main>

  <!-- <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/Thank">商品情報</router-link>
  </nav>
  <router-view /> -->
  <create-memo-component></create-memo-component>

</main>
</template>

<script>
import CreateMemoComponent from './CreateMemoComponent'
import UpdateMemoComponent from './UpdateMemoComponent'
export default {
  components:{CreateMemoComponent,UpdateMemoComponent},
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
