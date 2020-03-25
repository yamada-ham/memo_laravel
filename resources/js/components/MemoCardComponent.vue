<template>
<div class="memoCardBox" v-if="isShow">
  id:{{memoData.id}}
<div class="inMemoCardBox">
  <form class="memoCardFormBox">
  <div class="inMemoCardFormBox">
    <div class="textareaTitleBox">
    <div class="inTextareaTitleBox">
      <textarea v-model="memoData.title" @keyup="keyup($event)" rows="1" placeholder="タイトル"></textarea>
    </div>
    </div>
    <div class="textareaMemoBox">
    <div class="inTextareaMemoBox">
      <textarea v-model="memoData.memo" rows="1" placeholder="メモを入力"></textarea>
    </div>
    </div>
    <button @click.prevent="update($event)" type="submit">更新</button>
    <button @click.prevent="del($event)" type="submit">削除</button>
  </div>
    <input type="hidden" v-model="memoData.id"/>
  </form>
</div>
</div>
</template>

<script>
export default {
  components:{},
  data(){
    return{
        isShow:'true',
        title:'',
        memo:''
    }
  },
  props:['memoData'],
  created(){
  },
  mounted(){
  },
  methods:{
    keyup($event){
      console.log(this.title);
    },
    update($event){
      axios.post('/', {
        mode: 'update',
        id:this.memoData.id,
        title: this.memoData.title,
        memo: this.memoData.memo
      })
      .then(function (res) {
        console.log(res['data']);
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    del($event){
      let that = this
      axios.post('/', {
        mode: 'delete',
        id:this.memoData.id,
      })
      .then(function (res) {
        that.isShow = false;
        console.log(res['data']);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  },
  computed:{

  }
}
</script>
