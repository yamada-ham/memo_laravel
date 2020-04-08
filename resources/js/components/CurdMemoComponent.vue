<template>
<div class="inMain">
<div class="createMemoBox" :class="{making:isMaking}" :style="{'background':backgroundColor}">
<div class="inCreateMemoBox">
  <form class="createMemoFormBox">
  <div class="inCreateMemoFormBox">
    <div class="textareaTitleBox" ref="textareaTitleBox">
    <div class="inTextareaTitleBox">
      <textarea ref="textareaTitle" v-model="title" @input="autoResizeTextarea($event)" @focus="isMaking = true" rows="1" placeholder="タイトル"></textarea>
    </div>
    </div>
    <div class="textareaMemoBox" ref="textareaMemoBox">
    <div class="inTextareaMemoBox">
      <textarea v-model="memo" ref="textareaMemo" @input="autoResizeTextarea($event)" @focus="isMaking = true" rows="1" placeholder="メモを入力..."></textarea>
    </div>
    </div>
    <button  class="hidden" @click="create($event) "type="submit" @click.prevent>作成</button>
  </div>
  </form>
  <div class="operationBox">
    <div class="inOperationBox">
      <ul>
        <li><button type="submit"><i class="fas fa-archive"></i></button></li><!--アーカイブ-->
        <li class="colorPalleteLi"><button ><i class="fas fa-palette"></i></button><div class="tooltip" >
          <span v-for="color in getColorPallete" :key="color.id" :style="{'background':color.hex}" @click="backgroundColor = color.hex"></span>
        </div></li><!--色変更-->
        <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li><!--更新-->
        <li><button><i class="fas fa-tag"></i></button></li><!--タグを追加-->
        <li><button><i class="fas fa-undo-alt"></i></button></li>
        <li><button><i class="fas fa-redo-alt"></i>
        </button></li>
      </ul>
    </div>
  </div>
</div>
</div>
<div class="memoCardComponentBox">
  <transition-group name="memoCard" tag="ul" class="inMemoCardComponentBox">
    <li v-for="memo in memoData" :key="memo['id']" class="memoCardLi">
      <memo-card-component  :memo-data="memo" @childs-event="parentsMethod"></memo-card-component>
    </li>
</transition-group>
</div>
</div>
</template>

<script>
import { mapGetters } from 'vuex';
import store from '../store/store.js';
import MemoCardComponent from './MemoCardComponent'
export default {
  components:{MemoCardComponent},
  data(){
    return{
        title:'',
        memo:'',
        isMaking:false,
        memoData:false,
        backgroundColor:'#ffffff',
        // colorPallete:[
        //   {'id':0,'name':'白','hex':'#ffffff'},
        //   {'id':1,'name':'赤','hex':'#ff7474'},
        //   {'id':2,'name':'青','hex':'#5e7dff'},
        //   {'id':3,'name':'黄','hex':'#f8fe94'},
        //   {'id':4,'name':'緑','hex':'#86ffba'},
        //   {'id':5,'name':'紫','hex':'#d394ff'},
        //   {'id':6,'name':'橙','hex':'#feb365'},
        //   {'id':7,'name':'灰','hex':'#d0d0d0'},
        //   {'id':8,'name':'桃','hex':'#fb92da'},
        //   {'id':9,'name':'茶','hex':'#833f3f'}]
    }
  },
  props:[],
  created(){
    this.selectMemos()
    this.windowClick()
  },
  mounted(){
    this.$refs.textareaTitle.focus()
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
          if(this.isMaking &
            (this.title.length > 0 || this.memo.length > 0)){
              console.log('実行')
              this.create()
          }
          this.isMaking = false
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
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    create($event){
      let that = this
      axios.post('/', {
        mode: 'create',
        title: this.title,
        memo: this.memo
      })
      .then(function (res) {
        that.memoData.unshift(res['data']);
        that.title = ''
        that.memo = ''
        that.$refs.textareaTitle.style.height = '32px'
        that.$refs.textareaMemo.style.height = '32px'
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    parentsMethod:function(id){
      for(let i = 0; i < this.memoData.length; i++){
        if(this.memoData[i]['id'] === id){
          this.memoData.splice(i,1)
          break;
        }
      }
    }
  },
  computed:{
    // getColorPallete(){
    //   return store.getters.getColorPallete
    // },
    ...mapGetters(['getColorPallete']),
  }
}
</script>
