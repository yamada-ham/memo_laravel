<template>
<div class="createMemoBox">
<div class="inCreateMemoBox">
  <form class="createMemoFormBox">
  <div class="inCreateMemoFormBox">
    <div class="textareaTitleBox">
    <div class="inTextareaTitleBox">
      <textarea v-model="title" @keyup="keyup($event)" rows="1" placeholder="タイトル"></textarea>
    </div>
    </div>
    <div class="textareaMemoBox">
    <div class="inTextareaMemoBox">
      <textarea v-model="memo" rows="1" placeholder="メモを入力"></textarea>
    </div>
    </div>
    <button type="submit" @click.prevent>作成</button>
  </div>
  </form>
</div>
</div>
</template>

<script>
export default {
  components:{},
  data(){
    return{
        title:'',
        memo:''
    }
  },
  props:[],
  created(){
  },
  mounted(){

  },
  methods:{
    keyup($event){
      console.log(this.title);
    }
  },
  computed:{

  }
}
</script>
