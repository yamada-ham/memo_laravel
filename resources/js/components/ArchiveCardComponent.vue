<template>
<div class="archiveCardWrap" v-if="isShow" @mouseenter="isShowOperation=true" @mouseleave="isShowOperation=false" :style="{'background':backgroundColor}">
<div :class="['archiveCardBox',{modalWindow:isModal}]"   @click="isModal=true">
<div class="inArchiveCardBox">
  <form class="archiveCardFormBox">
  <div class="inArchiveCardFormBox">
    <div class="textareaTitleBox">
    <div class="inTextareaTitleBox">
      <textarea ref="titleTextarea" @input="inputResizeTextarea($event)" v-model="archiveData.title" rows="1" placeholder="タイトル" disabled></textarea>
    </div>
    </div>
    <div class="textareaMemoBox">
    <div class="inTextareaMemoBox">
      <textarea ref="memoTextarea" @input="inputResizeTextarea($event)" v-model="archiveData.memo" rows="1" placeholder="メモを入力..." disabled></textarea>
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
      <li><button><i class="fas fa-file-download"></i></button><div class="opTooltip"><p>ダウンロード</p></div></li><!--テキストファイルをダウンロード-->
      <li class="colorPalleteLi"><button ><i class="fas fa-palette"></i></button><div class="opTooltip"><p>背景色</p></div><div class="tooltip" >
        <span v-for="color in colorPallete" :key="color.id" :style="{'background':color.hex}" @click="backgroundColor = color.hex; update()"></span>
      </div></li><!--色変更-->
      <li><button><i class="fas fa-tag"></i></button><div class="opTooltip"><p>ラベルを追加</p></div></li><!--ラベルを追加-->
      <!-- <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li> --><!--更新-->
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
      <textarea ref="modalTitleTextarea" @input="inputResizeTextarea($event)" v-model="archiveData.title" rows="1" placeholder="タイトル" class="modalTitleTextarea"></textarea>
    </div>
    </div>
    <div class="modalMemoBox" ref="modalMemoBox" @scroll.self="modalMemoScrollAndTitleShadow($event)">
    <div class="inModalMemoBox">
      <textarea ref="modalMemoTextarea" @input="inputResizeTextarea($event)" v-model="archiveData.memo" rows="1" placeholder="メモを入力..." class="modalMemoTextarea"></textarea>
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
import CardMixin from '../mixins/CardMixin.js';
export default {
  components:{},
  data(){
    return{
        isShow:true,//アーカイブカードの(非)表示
        isModal:false,//モダールの(非)表示
        isShowOperation:false,//オペレーションの(非)表示
        backgroundColor:'#ffffff',//背景色
        isScrollModal:false,//モダールがスクロールされているか真偽
    }
  },
  props:['archiveData'],//Archive.vueから送られるアーカイブのデータ
  mixins: [CardMixin],
  created(){

  },
  mounted(){
    this.backgroundColor = this.archiveData.backgroundColor
  },
  updated(){

  },
  methods:{
    //アーカイブカードの編集
    update($event){
      //編集するときにメモカードのテキストエリアのサイズを変更
      this.autoResizeTextarea(this.$refs.titleTextarea)
      this.autoResizeTextarea(this.$refs.memoTextarea)

      axios.post('/', {
        mode: 'update',
        id:this.archiveData.id,
        title: this.archiveData.title,
        memo: this.archiveData.memo,
        backgroundColor: this.backgroundColor,
        isArchive :this.archiveData.isArchive,
        isFavorite:this.archiveData.isFavorite
      })
      .then(function (res) {
        console.log(res['data']);
      })
      .catch(function (error) {
        console.log(error);
      })
    },

    //アーカイブカードの削除
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

    //アーカイブからメモカードへ追い出す処理
    kickArchive(){
      this.$emit('kick-arcive-event',this.archiveData.id)//Archive.vueへ発火
      this.archiveData.isArchive = false
      this.update()
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
