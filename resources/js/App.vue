<template>
	<div class="app">
		<Navbar v-if="isAuthenticated"></Navbar>
		<router-view></router-view>
	</div>
</template>

<script>
import { mapGetters } from 'vuex';
import Navbar from '@components/layout/Navbar.vue';

export default {
	name: 'app',
	components: {
		Navbar
	},
	computed: {
		...mapGetters({
			isAuthenticated: 'user/isAuthenticated',
		})
	},
}
</script>
