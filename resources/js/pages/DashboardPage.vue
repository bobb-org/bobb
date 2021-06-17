<template>
	<div class="container mt-6">
		<h2 class="is-size-4 has-text-weight-bold">Twoje realizacje</h2>
		<div class="container realizations-table mt-4">
			<realization-list :realizations="realizations" />
		</div>
	</div>
</template>

<script>
import { mapState } from 'vuex';
import RealizationList from '@components/RealizationList.vue';
export default {
	name: 'dashboard',
	components: {
		RealizationList,
	},
	computed: {
		...mapState('dashboard', {
			realizations: 'realizations',
		})

	},
	mounted() {
		this.$store.dispatch('dashboard/getRealizations');
	}
}
</script>

<style scoped>
	.realizations-table {
		height: 75vh;
	}
</style>
