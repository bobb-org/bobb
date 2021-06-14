<template>
	<section class="hero is-info is-fullheight">
	  <div class="hero-body">
		<div class="container">
		  <div class="columns is-centered">
			<div class="column is-5-tablet is-4-desktop is-3-widescreen">
			  <form action="#" @submit.prevent="login" class="box">
				<div class="field">
				  <label for="" class="label">Email</label>
				  <div class="control">
					<input type="email" v-model="formData.email" class="input" required>
				  </div>
				</div>
				<div class="field">
				  <label for="" class="label">Hasło</label>
				  <div class="control">
					<input type="password" v-model="formData.password" class="input" required>
				  </div>
				</div>
				<div class="field">
				  <button class="button is-success">
					Zaloguj
				  </button>
				</div>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	</section>
</template>

<script>
export default {
	name: 'Login',
	data() {
		return {
			formData: {
				email: '',
				password: '',
			}
		}
	},
	methods: {
		login() {
			this.$store.dispatch('user/login', this.formData);
		}
	}

}
</script>
