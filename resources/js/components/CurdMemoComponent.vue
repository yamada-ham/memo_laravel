<template>
<div class="inMain">
<div class="createMemoBox" :class="{making:isMaking}" @click="isMaking = true">
<div class="inCreateMemoBox">
  <form class="createMemoFormBox">
  <div class="inCreateMemoFormBox">
    <div class="textareaTitleBox">
    <div class="inTextareaTitleBox">
      <textarea v-model="title" @input="autoResizeTextarea($event)" rows="1" placeholder="タイトル"></textarea>
    </div>
    </div>
    <div class="textareaMemoBox">
    <div class="inTextareaMemoBox">
      <textarea v-model="memo" @input="autoResizeTextarea($event)" rows="1" placeholder="メモを入力"></textarea>
    </div>
    </div>
    <button  class="hidden" @click="create($event) "type="submit" @click.prevent>作成</button>
  </div>
  </form>
</div>
</div>
<div class="memoCardComponentBox">
  <div class="inMemoCardComponentBox">
  <memo-card-component v-for="memo in memoData" :key="memo['id']" :memo-data="memo"></memo-card-component>
  </div>
</div>
</div>
</template>

<script>
import MemoCardComponent from './MemoCardComponent'
export default {
  components:{MemoCardComponent},
  data(){
    return{
        title:'',
        memo:'',
        isMaking:false,
        memoData:''
    }
  },
  props:[],
  created(){
    this.selectMemos()
    this.windowClick()
  },
  mounted(){

  },
  methods:{
    autoResizeTextarea($event){
      var areaHeight = $event.target.scrollHeight
      areaHeight = parseInt(areaHeight) - 54;
      if(areaHeight < 30){ areaHeight = 30; }
      $event.target.style.height = areaHeight + "px";
      $event.target.style.height = $event.target.scrollHeight + 2 + 'px'
    },
    windowClick(){
      //div.createMemoBox外がクリックすされたら実行
      window.addEventListener('click',(e)=>{
        let classes =[]
        e.path.forEach((el)=>{
          if(el.classList){//classListプロパティが存在すればtrue
            el.classList.forEach((val)=>{
              classes.push(val)
            });
          }
        });
        if(classes.indexOf('createMemoBox')  < 0){
          this.isMaking = false
          if(this.isMaking === true &
            (this.title.length > 0 || this.memo.length > 0)){
              console.log('実行')
              this.create()
          }
        }
      });
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
      let that = this
      axios.post('/', {
        mode: 'create',
        title: this.title,
        memo: this.memo
      })
      .then(function (res) {
        that.memoData.push(res['data']);
        that.title = ''
        that.memo = ''
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
