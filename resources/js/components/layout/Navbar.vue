<template>
<nav class="navbar" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item">
			<img src="/img/logo.png">
		</a>
	</div>
	<div id="navbarBasicExample" class="navbar-menu">
		<div class="navbar-start">
		</div>
		<div class="navbar-end">
			<div class="navbar-item">
				<div class="buttons">
					<div class="mr-4">
						<strong >{{user.email}}</strong>
					</div>
					<a @click="logout" class="button is-danger is-rounded">
						<span class="icon is-small">
							<i class="fas fa-sign-out-alt"></i>
						</span>
						<span>Wyloguj</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
	name: 'navbar',
	computed: {
		...mapGetters({
			user: 'user/currentUser',
		})
	},
	methods: {
		...mapActions({
			logout: 'user/logout',
		})
	}

}
</script>
