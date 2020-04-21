<template>
<div class="contentBox">
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
  <div class="labelBox" v-show="isLabel">
    <div class="inLabelBox">
      <p><a>{{label}}</a><button @click="label=''; isLabel = false"><i class="fas fa-times"></i></button></p>
    </div>
  </div>
  <div class="operationBox">
    <div class="inOperationBox">
      <ul>
        <li><button type="submit"><i class="fas fa-archive"></i></button><div class="opTooltip"><p>アーカイブ</p></div></li><!--アーカイブ-->
        <li class="colorPalleteLi"><button ><i class="fas fa-palette"></i></button>
          <div class="opTooltip"><p>背景色</p></div>
          <div class="tooltip">
          <span v-for="color in colorPallete" :key="color.id" :style="{'background':color.hex}" @click="backgroundColor = color.hex"></span>
        </div></li><!--色変更-->
        <li><button type="submit"><i class="far fa-edit"></i></button><div class="opTooltip"><p>更新</p></div></li><!--更新-->
        <li class="labelLi">
          <button @click="isLabelForm = true" class="labelBtn"><i class="fas fa-tag"></i></button><div class="opTooltip"><p>ラベル追加</p></div>
          <div v-show="isLabelForm" class="labelFormBox">
            <form>
              <input type="text" v-model="placeholderLabel">
              <button @click.prevent="createLabel(); addLabel('text')">+作成</button>
              <select @change="addLabel('select')" v-model="selectLabel">
                <option></option>
                <option v-for='item in labels'>{{item.label}}</option>
              </select>
            </form>
          </div>
        </li><!--ラベルを追加-->
        <li><button><i class="fas fa-undo-alt"></i></button><div class="opTooltip"><p>戻す</p></div></li><!--戻る-->
        <li><button><i class="fas fa-redo-alt"></i>
        </button><div class="opTooltip"><p>進む</p></div></li><!--進む-->
        <li><button><i class="fas fa-user-lock"></i></button><div class="opTooltip"><p>プライベート</p></div></li><!--プライベート-->
        <li><button><i class="fas fa-ellipsis-v"></i></button><div class="opTooltip"><p>その他</p></div></li><!--その他-->
      </ul>
    </div>
  </div>
</div>
</div>
<div class="memoCardComponentBox">
  <transition-group name="memoCard" tag="ul" class="inMemoCardComponentBox">
    <li v-for="memo in memoData" :key="memo['id']" class="memoCardLi">
      <memo-card-component  :memo-data="memo" @del-memo-event="parentsMethod" @send-archive-event="parentsMethod"></memo-card-component>
    </li>
</transition-group>
</div>

</div>
</template>

<script>
import {mapState,mapGetters } from 'vuex';
import store from '../store/store.js';
import MemoCardComponent from './MemoCardComponent'
// import MenuBarComponent from './MenuBarComponent'
export default {
  components:{MemoCardComponent},
  data(){
    return{
        title:'',
        memo:'',
        label:'',
        labels:[],
        placeholderLabel:'',
        selectLabel:'',
        isLabel:false,
        optionLabel:'',
        isMaking:false,
        memoData:false,
        backgroundColor:'#ffffff',
        isLabelForm:false
    }
  },
  props:[],
  created(){
    this.selectMemos()
    this.windowClick()
  },
  mounted(){
    this.$refs.textareaTitle.focus()
    this.selectLabel()
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

        if(classes.indexOf('labelLi') < 0) {
          if(this.isLabelForm){
            this.isLabelForm = false
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
        memo: this.memo,
        backgroundColor:this.backgroundColor,
        label:this.label
      })
      .then(function (res) {
        console.log(that.memoData.label)
        that.memoData.unshift(res['data']);
        that.title = ''
        that.memo = ''
        that.backgroundColor = '#ffffff'
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
    },
    createLabel(){
      if(this.placeholderLabel==''){
        return;
      }
      this.selectLabel = ''
      this.isLabel = true
      let that = this
      axios.post('/', {
        mode: 'createLabel',
        label:this.placeholderLabel
      })
      .then(function (res) {
        console.log(res['data'])
        that.labels.push({'label':that.placeholderLabel})
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    selectLabel(){
      let that = this
      axios.post('/', {
        mode: 'selectLabel',
      })
      .then(function (res) {
        console.log(res['data'])
        that.labels = res['data']
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    addLabel(val){
      if(val === 'text'){
        this.label = this.placeholderLabel
        this.optionLabel = ''
      }else if(val === 'select'){
        this.label = this.selectLabel
        this.placeholderLabel = ''
      }
    }
  },
  computed:{
    ...mapState(['colorPallete']),
  }
}
</script>
