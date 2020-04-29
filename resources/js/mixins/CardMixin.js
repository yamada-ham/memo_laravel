export default {
  data () {
    return {

    }
  },
  mounted(){
    this.autoResizeTextarea(this.$refs.titleTextarea)
    this.autoResizeTextarea(this.$refs.memoTextarea)
  },
  updated(){
    if(this.isModal){
      this.autoResizeTextarea(this.$refs.modalTitleTextarea)
      this.autoResizeTextarea(this.$refs.modalMemoTextarea)
    }
  },
  methods:{
    //テキストエリアの高さを設定
    autoResizeTextarea(el){
      var areaHeight = el.scrollHeight
      areaHeight = parseInt(areaHeight) - 54;
      if(areaHeight < 30){ areaHeight = 30; }
      el.style.height = areaHeight + "px";
      el.style.height = el.scrollHeight + 2 + 'px'
    },

    //テキストエリアが入力されたときの処理
    inputResizeTextarea($event){

      //モーダルのテキストエリアが入力されたら、対応するメモカード内のテキストエリア改行する。
      // if($event.target.className === 'modalTitleTextarea' || $event.target.className === 'modalMemoTextarea'){
        this.autoResizeTextarea(this.$refs.titleTextarea)
        this.autoResizeTextarea(this.$refs.memoTextarea)
      // }
    },
    //モダールがスクロールされた時にタイトルに影をつくる
    modalMemoScrollAndTitleShadow($event){
      if($event.target.scrollTop === 0){
        this.isScrollModal = false
      }else{
        this.isScrollModal = true
      }
    },
    //モーダルが閉じる時の処理
    closeModal($event){
      this.isModal = false
      this.update()
    },
  }
}
