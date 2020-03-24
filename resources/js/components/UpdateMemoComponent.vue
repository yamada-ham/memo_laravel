<template>
<div class="updateMemoBox">
  アップデート用{{memoData.id}}
<div class="inupdateMemoBox">
  <form class="updateMemoFormBox">
  <div class="inupdateMemoFormBox">
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
    <button @click="submit($event)" type="submit" @click.prevent>更新</button>
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
        // title:JSON.parse(this.memoData)['title'],
        // memo:JSON.parse(this.memoData)['memo']
        title:'',
        memo:''
    }
  },
  props:['memoData'],
  created(){
    console.log(this.memoData);
  },
  mounted(){
    // console.log(this.memoData);
  },
  methods:{
    keyup($event){
      console.log(this.title);
    },
    submit($event){
      console.log($event);
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
      });
    }
  },
  computed:{

  }
}
</script>
