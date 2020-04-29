export default {
  data () {
    return {

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
  }
}
