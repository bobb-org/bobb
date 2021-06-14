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
	const authenticated = store.state.user.isAuthenticated;
	const onlyForLoggedOut = to.matched.some(record => record.meta.onlyForLoggedOut)
	const isPublic = to.matched.some(record => record.meta.public);
	console.log('isPublic', isPublic);
	console.log('auth', authenticated);
	if(!isPublic && !authenticated) {
		return next({
			path: '/login',
			query: {redirect: to.fullPath}
		});
	}

	if(authenticated && onlyForLoggedOut) {
		return next('/');
	}

	next();
});

export default router;
