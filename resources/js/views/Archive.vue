<template>
<div class="contentBox">
<div class="archiveCardComponentBox">
  <transition-group name="memoCard" tag="ul" class="inArchiveCardComponentBox">
    <li v-for="memo in memoData" :key="memo['id']" class="archiveCardLi">
      <archive-card-component  :memo-data="memo" @del-memo-event="parentsMethod"></archive-card-component>
    </li>
</transition-group>
</div>

</div>
</template>

<script>
import {mapState,mapGetters } from 'vuex';
import store from '../store/store.js';
import ArchiveCardComponent from '../components/ArchiveCardComponent'
// import MenuBarComponent from './MenuBarComponent'
export default {
  components:{ArchiveCardComponent},
  data(){
    return{
        title:'',
        memo:'',
        isMaking:false,
        memoData:false,
        backgroundColor:'#ffffff',
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
        memo: this.memo,
        backgroundColor:this.backgroundColor
      })
      .then(function (res) {
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
    }
  },
  computed:{
    ...mapState(['colorPallete']),
  }
}
</script>
