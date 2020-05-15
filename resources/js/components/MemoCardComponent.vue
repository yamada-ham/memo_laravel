<template>
<div class="memoCardWrap" v-if="isShow" @mouseenter="isShowOperation=true" @mouseleave="isShowOperation=false" :style="{'background':backgroundColor}">
<div :class="['memoCardBox',{modalWindow:isModal}]"   @click="isModal = true;">
  <div class="inMemoCardBox">
    <form class="memoCardFormBox">
    <div class="inMemoCardFormBox">
      <div class="textareaTitleBox">
      <div class="inTextareaTitleBox">
        <textarea ref="titleTextarea" @input="inputResizeTextarea($event)" v-model="memoData.title" rows="1" placeholder="タイトル" disabled></textarea>
      </div>
      </div>
      <div class="textareaMemoBox">
      <div class="inTextareaMemoBox">
        <textarea ref="memoTextarea" @input="inputResizeTextarea($event)" v-model="memoData.memo" rows="1" placeholder="メモを入力..." disabled></textarea>
      </div>
      </div>
    </div>
    </form>
    <input type="hidden" v-model="memoData.id"/>
  </div>
</div>
<!-- <div class="labelBox">
  <div class="inLabelBox">
    <ul>
      <li><p><span>{{memoData.label}}</span><button><i class="fas fa-times"></i></button></p></li>
    </ul>
  </div>
</div> -->
<div class="operationBox" >
  <div class="inOperationBox">
    <transition name="operationBox">
    <ul v-show="isShowOperation" >
      <li><button @click="sendArchive()"><i class="fas fa-archive"></i></button><div class="opTooltip"><p>アーカイブ</p></div></li><!--アーカイブ-->
      <li><button @click="downloadMemo()"><i class="fas fa-file-download"></i></button><div class="opTooltip"><p>ダウンロード</p></div></li><!--テキストファイルをダウンロード-->
      <li class="colorPalleteLi"><button ><i class="fas fa-palette"></i></button><div class="opTooltip"><p>背景色</p></div><div class="tooltip" >
        <span v-for="color in colorPallete" :key="color.id" :style="{'background':color.hex}" @click="backgroundColor = color.hex; update()"></span>
      </div></li><!--色変更-->
      <!-- <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li> --><!--更新-->
      <li><button><i class="fas fa-tag"></i></button><div class="opTooltip"><p>ラベルを追加</p></div></li><!--ラベルを追加-->
      <li><button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button><div class="opTooltip"><p>削除</p></div></li><!--削除-->
      <li><button><i class="fas fa-ellipsis-v"></i></button><div class="opTooltip"><p>その他</p></div></li><!--その他-->
      <!--<li><button><i class="fas fa-user-lock"></i></button></li>--><!--プライベート-->
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
      <textarea ref="modalTitleTextarea" @input="inputResizeTextarea($event)" v-model="memoData.title" rows="1" placeholder="タイトル" class="modalTitleTextarea"></textarea>
    </div>
    </div>
    <div class="modalMemoBox" ref="modalMemoBox" @scroll.self="modalMemoScrollAndTitleShadow($event)">
    <div class="inModalMemoBox">
      <textarea ref="modalMemoTextarea" @input="inputResizeTextarea($event)" v-model="memoData.memo" rows="1" placeholder="メモを入力..." class="modalMemoTextarea"></textarea>
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
          <!-- <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li> --><!--更新-->
          <li><button><i class="fas fa-tag"></i></button></li><!--ラベルを追加-->
          <li><button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button></li><!--削除-->
          <li><button><i class="fas fa-undo-alt"></i></button></li>
          <li><button><i class="fas fa-redo-alt"></i>
          </button></li>
          <li><button><i class="fas fa-user-lock"></i></button></li><!--プライベート-->
          <li><button><i class="fas fa-ellipsis-v"></i></button></li><!--その他-->
          <li class="liClose"><button @click.prevent="closeModal($event)">閉じる</button></li>
        </ul>
      </div>
    </div>
  </div>
    <input type="hidden" v-model="memoData.id"/>
  </form>

</div>
</div>

<div :class="{mask:isModal}" @click="closeModal($event)"></div>
</div>
</template>

<script>
import {mapState,mapGetters } from 'vuex';
import store from '../store/store.js';
import CardMixin from '../mixins/CardMixin.js';
export default {
  components:{},
  data(){
    return{
        isShow:true,//メモカードの(非)表示の真偽
        isShowOperation:false,//メモカードのオペーレションの(非)表示の真偽
        isModal:false,//モーダルの(非)表示の真偽
        title:'',//メモカードのタイトル
        memo:'',//メモカードの文章
        backgroundColor:'#ffffff',//メモカードの背景色
        // label:'',
        isScrollModal:false,//モダールがスクロールされているか真偽
    }
  },
  props:[
    'memoData'//「CurdMemo」から送られてきたメモカードのデータ
  ],
  mixins: [CardMixin],
  created(){},
  mounted(){
    this.backgroundColor = this.memoData.backgroundColor
  },
  updated(){
    console.log(this.memoData);
  },
  methods:{
    //メモカードの編集
    update($event){
      //編集するときにメモカードのテキストエリアのサイズを変更
      this.autoResizeTextarea(this.$refs.titleTextarea)
      this.autoResizeTextarea(this.$refs.memoTextarea)

      axios.post('/', {
        mode: 'update',
        id:this.memoData.id,
        title: this.memoData.title,
        memo: this.memoData.memo,
        backgroundColor: this.backgroundColor,
        isArchive :this.memoData.isArchive,
        isFavorite:this.memoData.isFavorite
      })
      .then(function (res) {
        console.log(res['data']);
      })
      .catch(function (error) {
        console.log(error);
      })
    },

    //メモを削除
    del($event){
      this.$emit('del-memo-event',this.memoData.id)
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
    },

    //アーカイブにメモを移動する処理の発火
    sendArchive(){
      this.$emit('send-archive-event',this.memoData.id)
      this.memoData.isArchive = !this.memoData.isArchive
      this.update()
    },

    //メモをテキストファイルとしてダウンロード
    downloadMemo(){

      const text = `タイトル:${this.memoData.title}\r\nメモ:${this.memoData.memo}`
      const blob = new Blob([text], {type: 'text/plain'})
      const url = URL.createObjectURL(blob)//一時的なURLを作成
      const tmp_a = document.createElement("a")
      document.body.appendChild(tmp_a)

      let file_title = ''
      if(this.memoData.title === null || this.memoData.title === ''){
        file_title = 'タイトルなし'
      }else{
        file_title = this.memoData.title
      }
      tmp_a.download = file_title + '.txt';//ダウンロードするファイル名
      tmp_a.href = url;
      tmp_a.click();
      tmp_a.remove();
      URL.revokeObjectURL(url);//一時的なURL削除
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
