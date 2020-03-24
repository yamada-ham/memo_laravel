<template>
<main>

  <!-- <nav>
    <router-link to="/">Home</router-link>
    <router-link to="/Thank">商品情報</router-link>
  </nav>
  <router-view /> -->
  <create-memo-component></create-memo-component>
    <update-memo-component v-for="memo in cptMemos" :key="memo['id']" :memo-data="memo"></update-memo-component>
</main>
</template>

<script>
import CreateMemoComponent from './CreateMemoComponent'
import UpdateMemoComponent from './UpdateMemoComponent'
export default {
  components:{CreateMemoComponent,UpdateMemoComponent},
  data(){
    return{
      id:'',
      title:'',
      memo:''
    }
  },
  props:['memoData'],
  created(){
    console.log(this.$store.state.message);
  },
  mounted(){
    console.log(this.memoData);
  },
  methods:{
  },
  computed:{
    cptMemos(){
      return JSON.parse(this.memoData);
    }
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
