<template>
<div>
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
    <button @click="create($event) "type="submit" @click.prevent>作成</button>
  </div>
  </form>
</div>
</div>
<update-memo-component v-for="memo in memoData" :key="memo['id']" :memo-data="memo"></update-memo-component>
</div>
</template>

<script>
export default {
  components:{},
  data(){
    return{
        title:'',
        memo:'',
        memoData:''
    }
  },
  props:[],
  created(){
    this.selectMemos()
  },
  mounted(){
  },
  methods:{
    keyup($event){
      console.log(this.title);
    },
    selectMemos(){
      let that = this
      axios.post('/', {
        mode: 'select',
      })
      .then(function (res) {
        that.memoData = res['data']
        console.log(that.memoData);
      })
      .catch(function (error) {
        console.log(error);
      })
      console.log(this.memoData)
    },
    create($event){
      console.log($event);
      let that = this
      axios.post('/', {
        mode: 'create',
        title: this.title,
        memo: this.memo
      })
      .then(function (res) {
        console.log(res['data']);
        that.memoData.push(res['data']);
        console.log(that.memoData);
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
