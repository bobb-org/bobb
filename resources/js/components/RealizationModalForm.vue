<template>
	<div class="modal" :class="{'is-active': isActive}">
		<div class="modal-background" @click="closeModal"></div>
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Dodaj realizację</p>
				<button @click="closeModal" class="delete" aria-label="close"></button>
			</header>
			<section class="modal-card-body">
				<label class="label">Nazwa</label>
				<input v-model='name' class="input mb-2" type="text">
				<div class="level mb-2">
					<div class="level-left">
						<div class="level-item">
							<div class="field">
								<label class="label">Miasto</label>
								<div class="control"></div>
								<input v-model='city' class="input" type="text">
							</div>
						</div>
						<div class="level-item">
							<div class="field">
								<label class="label">Ulica</label>
								<div class="control"></div>
								<input v-model='street' class="input" type="text">
							</div>
						</div>
						<div class="level-item">
							<div class="field">
								<label class="label">Numer</label>
								<div class="control"></div>
								<input v-model='number' class="input input__street-number" type="number">
							</div>
						</div>
					</div>
				</div>
			</section>
			<footer class="modal-card-foot">
				<button @click="submit" class="button is-success button__save">Zapisz</button>
				<button @click="closeModal" class="button">Anuluj</button>
			</footer>
		</div>
	</div>
</template>

<script>
function intialState() {
	return {
		name: '',
		city: '',
		street: '',
		number: '',
	}
}
export default {
	name: 'realization-modal-form',
	data() {
		return intialState();
	},
	props: {
		isActive: {
			type: Boolean,
			default: true
		}
	},
	methods: {
		closeModal: function() {
			Object.assign(this.$data, intialState());
			this.$emit('close-modal')
		},
		submit: function() {
			this.$store.dispatch('realization/postRealization', this.$data);
		}
	}

}
</script>
<style>
	.input__street-number {
		width: 75px;
	}
	.button__save {
		margin-left: auto;
	}
</style>
