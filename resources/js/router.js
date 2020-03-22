import Router from 'vue-router';
import Home from './views/Home';
import Thank from './views/Thank';

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Home
    },
    {
      path: '/Thank',
      component: Thank
    },
  ]
});
