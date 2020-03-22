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
export default {
  components:{CreateMemoComponent},
  data(){
    return{

    }
  },
  props:[],
  created(){
    console.log(this.$store.state.message);
  },
  mounted(){

  },
  methods:{

  },
  computed:{

  }
}
</script>
