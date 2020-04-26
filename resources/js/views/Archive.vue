<template>
<div class="contentBox">
<div class="archiveCardComponentBox">
  <transition-group name="memoCard" tag="ul" class="inArchiveCardComponentBox">
    <li v-for="memo in archiveData" :key="memo['id']" class="archiveCardLi">
      <archive-card-component  :archive-data="memo" @del-memo-event="memoDataSplice" @kick-arcive-event="memoDataSplice"></archive-card-component>
    </li>
</transition-group>
</div>

</div>
</template>

<script>
import {mapState,mapGetters } from 'vuex';
import store from '../store/store.js';
import ArchiveCardComponent from '../components/ArchiveCardComponent'
export default {
  components:{ArchiveCardComponent},
  data(){
    return{
        archiveData:{},//アーカイブデータの一覧
        backgroundColor:'#ffffff',//背景色
    }
  },
  props:[],
  created(){
    this.selectArchiveMemos()
  },
  mounted(){
  },
  methods:{

    //アーカイブのデータ一覧を取得
    selectArchiveMemos(){
      let that = this
      axios.post('/archive', {
        mode: 'select',
      })
      .then(function (res) {
        that.archiveData = res['data']
      })
      .catch(function (error) {
        console.log(error);
      })
    },
    //メモデータの配列から要素を取り除く。メモの削除、アーカイブ移動のときに使う。
    memoDataSplice:function(id){
      for(let i = 0; i < this.archiveData.length; i++){
        if(this.archiveData[i]['id'] === id){
          this.archiveData.splice(i,1)
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
