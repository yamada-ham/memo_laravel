import Router from 'vue-router';
import Home from './views/Home';
import Thank from './views/Thank';
import Archive from './views/Archive';
// import MemoCardComponent from './views/MemoCardComponent';
import CurdMemoComponent from './views/CurdMemoComponent';

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: CurdMemoComponent
    },
    {
      path: '/Home',
      component: Home
    },
    {
      path: '/Thank',
      component: Thank
    },
    {
      path: '/archive',
      component: Archive
    },
  ]
});
