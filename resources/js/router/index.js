import Vue from 'vue';
import Router from 'vue-router';
import routes from './routes/index';
import store from '@/store/index';

Vue.use(Router);

const router = new Router({
	routes: [
		{
			path: '/',
			redirect: '/dashboard'
		}
	].concat(routes)
});


router.beforeEach((to, from, next) => {
	const authenticated = store.getters['user/isAuthenticated'];
	const onlyForLoggedOut = to.matched.some(record => record.meta.onlyForLoggedOut)
	const isPublic = to.matched.some(record => record.meta.public);
	if(!isPublic && !authenticated) {
		return next({
			path: '/login',
			query: {redirect: to.fullPath}
		});
	}
	console.log(authenticated)
	if(authenticated && onlyForLoggedOut) {
		return next('/');
	}

	next();
});

export default router;
