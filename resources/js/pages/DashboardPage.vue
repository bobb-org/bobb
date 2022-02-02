<template>
	<div class="container mt-6">
		<div class="is-flex is-justify-content-space-between">
			<h2 class="is-size-4 is-inline-block has-text-weight-bold">Twoje realizacje</h2>
			<button @click="setModalIsActive(true)" class="button is-primary">Dodaj nową realizację</button>
		</div>
		<div class="container realizations-table mt-4">
			<realization-list :realizations="realizations" />
		</div>
		<realization-modal-form
			@close-modal="setModalIsActive(false)"
			:is-active="realizationModalFormIsActive">
		</realization-modal-form>
	</div>
</template>

<script>
import { mapState } from 'vuex';
import RealizationList from '@components/RealizationList.vue';
import RealizationModalForm from '@components/RealizationModalForm.vue';
export default {
	name: 'dashboard',
	data() {
		return {
			realizationModalFormIsActive: false,
		}
	},
	components: {
		RealizationList,
		RealizationModalForm
	},
	computed: {
		...mapState('dashboard', {
			realizations: 'realizations',
		})

	},
	mounted() {
		this.$store.dispatch('dashboard/getRealizations');
	},
	methods: {
		closeModal() {
			this.realizationModalFormIsActive = false;
		},
		setModalIsActive(isActive) {
			this.realizationModalFormIsActive = isActive;
		}
	}
}
</script>

<style scoped>
	.realizations-table {
		height: 75vh;
	}
</style>
