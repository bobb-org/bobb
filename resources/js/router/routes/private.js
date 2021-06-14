import Dashboard from '@pages/Dashboard.vue';


const routes = [
	{
		path: '/dashboard',
		name: 'dashboard',
		component: Dashboard
	}
]

export default routes.map(route => {
	return {...route, meta: {public: false}};
});
