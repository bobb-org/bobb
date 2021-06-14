import LoginPage from '@pages/LoginPage.vue';
import ForgotPassword from '@pages/ForgotPassword.vue';


const routes = [
	{
		path: '/login',
		name: 'login',
		component: LoginPage
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
