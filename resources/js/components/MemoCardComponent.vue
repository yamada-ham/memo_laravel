<template>
<div class="memoCardWrap" v-if="isShow" @mouseenter="isShowOperation=true" @mouseleave="isShowOperation=false">
<div :class="['memoCardBox',{modalWindow:isModal}]"   @click="modalMemoCardBox($event)">
  id:{{memoData.id}}
<div class="inMemoCardBox">
  <form class="memoCardFormBox">
  <div class="inMemoCardFormBox">
    <div class="textareaTitleBox">
    <div class="inTextareaTitleBox">
      <textarea ref="autoResizeTitle" @input="autoResizeTextarea($event)" v-model="memoData.title" rows="1" placeholder="タイトル"></textarea>
    </div>
    </div>
    <div class="textareaMemoBox">
    <div class="inTextareaMemoBox">
      <textarea ref="autoResizeMemo" @input="autoResizeTextarea($event)" v-model="memoData.memo" rows="1" placeholder="メモを入力..."></textarea>
    </div>
    </div>
  </div>
  </form>
  <input type="hidden" v-model="memoData.id"/>
</div>
</div>

<div class="modalBox" v-if="isModal">
<div class="inModalBox">
  <form class="modalFormBox">
  <div class="inModalFormBox">
    <div class="modalTitleBox">
    <div class="inModalTitleBox">
      <textarea ref="modalTitleTextarea" @input="autoResizeTextarea($event)" v-model="memoData.title" rows="1" placeholder="タイトル"></textarea>
    </div>
    </div>
    <div class="modalMemoBox">
    <div class="inModalMemoBox">
      <textarea ref="modalMemoTextarea" @input="autoResizeTextarea($event)" v-model="memoData.memo" rows="1" placeholder="メモを入力..."></textarea>
    </div>
    </div>
    <!-- <button @click.prevent="update($event)" type="submit">更新</button>
    <button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button> -->
    <div　class="modalOperationBox">
      <div class="inModalOperationBox">
        <transition name="operationBox">
        <ul v-show="isShowOperation" >
          <transition name="operationLi"><li><button type="submit"><i class="fas fa-archive"></i></button></li></transition><!--アーカイブ-->
          <li><button type="submit"><i class="fas fa-palette"></i></button></li><!--色変更-->
          <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li><!--更新-->
          <li><button><i class="fas fa-tag"></i></button></li><!--タグを追加-->
          <li><button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button></li><!--削除-->
        </ul>
      </transition>
      </div>
    </div>
  </div>
    <input type="hidden" v-model="memoData.id"/>
  </form>

</div>
</div>

<div :class="{mask:isModal}" @click="closeModal($event)"></div>
<div　class="operationBox">
  <div class="inOperationBox">
    <transition name="operationBox">
    <ul v-show="isShowOperation" >
      <transition name="operationLi"><li><button type="submit"><i class="fas fa-archive"></i></button></li></transition><!--アーカイブ-->
      <li><button type="submit"><i class="fas fa-palette"></i></button></li><!--色変更-->
      <li><button @click.prevent="update($event)" type="submit"><i class="far fa-edit"></i></button></li><!--更新-->
      <li><button><i class="fas fa-tag"></i></button></li><!--タグを追加-->
      <li><button @click.prevent="del($event)" type="submit"><i class="fas fa-trash-alt"></i></button></li><!--削除-->
    </ul>
  </transition>
  </div>
</div>
</div>
</template>

<script>
import store from '../store/store.js';
export default {
  components:{},
  data(){
    return{
        isShow:true,
        isModal:false,
        isShowOperation:false,
        title:'',
        memo:''
    }
  },
  props:['memoData'],
  created(){
  },
  mounted(){
    this.initResizeTextarea(this.$refs.autoResizeTitle)
    this.initResizeTextarea(this.$refs.autoResizeMemo)
    // console.log(this.$refs.autoResize.scrollHeight);
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
      console.log($event)
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
      var areaHeight = $event.target.scrollHeight
      areaHeight = parseInt(areaHeight) - 54;
      if(areaHeight < 30){ areaHeight = 30; }
      $event.target.style.height = areaHeight + "px";
      $event.target.style.height = $event.target.scrollHeight + 2 + 'px'
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

  },
  watch: {
    // isModal: {
    //   handler: function(newVal, oldVal) {
    //     if(newVal === true){
    //       // this.initResizeTextarea(this.$refs.modalTitleTextarea)
    //     }
    //   },
    //   deep: true,
    //   immediate: true
    // },
  }
}
</script>
