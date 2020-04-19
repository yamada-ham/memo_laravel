<template>
<div class="archiveCardWrap" v-if="isShow" @mouseenter="isShowOperation=true" @mouseleave="isShowOperation=false" :style="{'background':backgroundColor}">
<div :class="['archiveCardBox',{modalWindow:isModal}]"   @click="modalMemoCardBox($event)">
<div class="inArchiveCardBox">
  <form class="archiveCardFormBox">
  <div class="inArchiveCardFormBox">
    <div class="textareaTitleBox">
    <div class="inTextareaTitleBox">
      <textarea ref="titleTextarea" @input="autoResizeTextarea($event)" v-model="archiveData.title" rows="1" placeholder="タイトル" disabled></textarea>
    </div>
    </div>
    <div class="textareaMemoBox">
    <div class="inTextareaMemoBox">
      <textarea ref="memoTextarea" @input="autoResizeTextarea($event)" v-model="archiveData.memo" rows="1" placeholder="メモを入力..." disabled></textarea>
    </div>
    </div>
  </div>
  </form>
  <input type="hidden" v-model="archiveData.id"/>
</div>
</div>
<div class="operationBox" >
  <div class="inOperationBox">
    <transition name="operationBox">
    <ul v-show="isShowOperation" >
      <li><button @click="kickArchive()"><i class="fas fa-archive"></i></button><div class="opTooltip"><p>アーカイブ解除</p></div></li><!--アーカイブ戻す-->
      <li class="colorPalleteLi"><button ><i class="fas fa-palette"></i></button><div class="opTooltip"><p>背景色</p></div><div class="tooltip" >
        <span v-for="color in colorPallete" :key="color.id" :style="{'background':color.hex}" @click="backgroundColor = color.hex; update()"></span>
      </div></li><!--色変更-->
      <!-- <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li> --><!--更新-->
      <!--<li><button><i class="fas fa-tag"></i></button></li>--><!--タグを追加-->
      <li><button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button><div class="opTooltip"><p>削除</p></div></li><!--削除-->
      <!-- <li><button><i class="fas fa-user-lock"></i></button></li> --><!--プライベート-->
      <li><button><i class="fas fa-ellipsis-v"></i></button><div class="opTooltip"><p>その他</p></div></li><!--その他-->

    </ul>
  </transition>
  </div>
</div>

<div class="modalBox" v-show="isModal" :style="{'background':backgroundColor}">
<div class="inModalBox">
  <form class="modalFormBox">
  <div class="inModalFormBox">
    <div :class="['modalTitleBox',{scroll:isScrollModal}]" ref="modalTitleBox">
    <div class="inModalTitleBox">
      <textarea ref="modalTitleTextarea" @input="autoResizeTextarea($event)" v-model="archiveData.title" rows="1" placeholder="タイトル" class="modalTitleTextarea"></textarea>
    </div>
    </div>
    <div class="modalMemoBox" ref="modalMemoBox" @scroll.self="modalMemoScrollAndTitleShadow($event)">
    <div class="inModalMemoBox">
      <textarea ref="modalMemoTextarea" @input="autoResizeTextarea($event)" v-model="archiveData.memo" rows="1" placeholder="メモを入力..." class="modalMemoTextarea"></textarea>
    </div>
    </div>
    <!-- <button @click.prevent="update($event)" type="submit">更新</button>
    <button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button> -->
    <div class="modalOperationBox">
      <div class="inModalOperationBox">
        <ul>
          <li><button @click.prevent><i class="fas fa-archive"></i></button></li><!--アーカイブ-->
          <li class="colorPalleteLi"><button @click.prevent><i class="fas fa-palette"></i></button><div class="tooltip" >
            <span v-for="color in colorPallete" :key="color.id" :style="{'background':color.hex}" @click="backgroundColor = color.hex; update()"></span>
          </div></li><!--色変更-->
          <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li><!--更新-->
          <li><button><i class="fas fa-tag"></i></button></li><!--タグを追加-->
          <li><button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button></li><!--削除-->
          <li><button><i class="fas fa-undo-alt"></i></button></li>
          <li><button><i class="fas fa-redo-alt"></i>
          </button></li>
          <li><button><i class="fas fa-user-lock"></i></button></li><!--プライベート-->
          <li class="liClose"><button @click.prevent="closeModal($event)">閉じる</button></li>
        </ul>
      </div>
    </div>
  </div>
    <input type="hidden" v-model="archiveData.id"/>
  </form>

</div>
</div>

<div :class="{mask:isModal}" @click="closeModal($event)"></div>
</div>
</template>

<script>
import {mapState,mapGetters } from 'vuex';
import store from '../store/store.js';
export default {
  components:{},
  data(){
    return{
        isShow:true,
        isModal:false,
        isShowOperation:false,
        title:'',
        memo:'',
        paddingVal:'',
        isScrollModal:false,
        backgroundColor:'#ffffff'
    }
  },
  props:['archiveData'],
  created(){

  },
  mounted(){
    this.backgroundColor = this.archiveData.backgroundColor
    this.initResizeTextarea(this.$refs.titleTextarea)
    this.initResizeTextarea(this.$refs.memoTextarea)
  },
  updated(){
    if(this.isModal){
      this.initResizeTextarea(this.$refs.modalTitleTextarea)
      this.initResizeTextarea(this.$refs.modalMemoTextarea)
    }
  },
  methods:{
    modalMemoCardBox($event){
      this.isModal = true
    },
    closeModal($event){
      this.isModal = false
      this.update()
    },
    initResizeTextarea(el){
      var areaHeight = el.scrollHeight
      areaHeight = parseInt(areaHeight) - 54;
      if(areaHeight < 30){ areaHeight = 30; }
      el.style.height = areaHeight + "px";
      el.style.height = el.scrollHeight + 2 + 'px'
    },
    autoResizeTextarea($event){

      //モーダルのテキストエリアが入力されたら、対応するメモカード内のテキストエリア改行する。
      if($event.target.className === 'modalTitleTextarea' || $event.target.className === 'modalMemoTextarea'){
        this.newLineTextarea(this.$refs.titleTextarea)
        this.newLineTextarea(this.$refs.memoTextarea)
      }

      this.newLineTextarea($event.target)
    },
    newLineTextarea(textarea){
      var areaHeight = textarea.scrollHeight
      areaHeight = parseInt(areaHeight) - 54;
      if(areaHeight < 30){ areaHeight = 30; }
     textarea.style.height = areaHeight + "px";
     textarea.style.height = textarea.scrollHeight + 2 + 'px'
   },
    modalMemoScrollAndTitleShadow($event){
      if($event.target.scrollTop === 0){
        this.isScrollModal = false
      }else{
        this.isScrollModal = true
      }
    },
    update($event){
      axios.post('/', {
        mode: 'update',
        id:this.archiveData.id,
        title: this.archiveData.title,
        memo: this.archiveData.memo,
        backgroundColor: this.backgroundColor,
        isArchive :this.archiveData.isArchive
      })
      .then(function (res) {
        console.log(res['data']);
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    del($event){
      this.$emit('del-memo-event',this.archiveData.id)
      let that = this
      axios.post('/', {
        mode: 'delete',
        id:this.archiveData.id,
      })
      .then(function (res) {
        that.isShow = false;
        console.log(res['data']);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    kickArchive(){
      this.$emit('kick-arcive-event',this.archiveData.id)
      // console.log(this.archiveData.isArchive)
      this.archiveData.isArchive = false
      // console.log(this.archiveData.isArchive)
      this.update()
      console.log('アーカイブ追い出す')
    }
  },
  computed:{
    ...mapState(['colorPallete']),
  }
  // watch: {
  //   isModal: {
  //     handler: function(newVal, oldVal) {
  //       if(newVal === true){
  //         this.$refs.modalTitleTextarea.focus()
  //       }
  //     },
  //     deep: true,
  //     immediate: true
  //   },
  // }
}
</script>
