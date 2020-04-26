import Router from 'vue-router';
import Archive from './views/Archive';
import EditLabel from './views/EditLabel';
// import MemoCardComponent from './views/MemoCardComponent';
import CurdMemo from './views/CurdMemo';

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: CurdMemo
    },
    {
      path: '/archive',
      component: Archive
    },
    {
      path: '/edit_label',
      component: EditLabel
    },
  ]
});
