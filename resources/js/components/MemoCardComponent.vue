<template>
<div  :class="['memoCardBox',{modalWindow:isModal}]" @click="modalMemoCardBox($event)" v-if="isShow">
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
    <button @click.prevent="update($event)" type="submit">更新</button>
    <button @click.prevent="del($event)" type="submit">削除</button>
  </div>
    <input type="hidden" v-model="memoData.id"/>
  </form>
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
    <button @click.prevent="update($event)" type="submit">更新</button>
    <button @click.prevent="del($event)" type="submit">削除</button>
  </div>
    <input type="hidden" v-model="memoData.id"/>
  </form>
</div>
</div>
</div>
</template>

<script>
export default {
  components:{},
  data(){
    return{
        isShow:true,
        isModal:false,
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
      console.log($event)
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
