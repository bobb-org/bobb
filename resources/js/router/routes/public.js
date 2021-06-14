import Login from '@pages/Login.vue';
import ForgotPassword from '@pages/ForgotPassword.vue';


const routes = [
	{
		path: '/login',
		name: 'login',
		component: Login
	},
	{
		path: '/forgot-password',
		name: 'forgotPassword',
		component: ForgotPassword
	},
]


export default routes.map(route => {
	const meta = {
		public: true,
		onlyForLoggedOut: true,
	}

	return {...route, meta};
})
