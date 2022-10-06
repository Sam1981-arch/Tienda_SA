<template>
	<div class="modal fade" id="UserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">
						{{is_create ? 'Crear' : 'Editar'}} Usuario</h5>
					<button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#UserModal"></button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="storeUser" enctype="multipart/form-data">

						<!-- Avatar -->
						<div class="mb-3">
							<label for="avatar_file" class="form-label">Avatar</label>
							<input type="file" class="form-control" id="avatar_file" accept="image/*" @change="loadFile">
						</div>

						<div class="mb-3">
							<label for="number_id" class="form-label">Cedula</label>
							<input type="number" step="any" class="form-control" id="number_id" v-model="user_data.number_id">
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="name" v-model="user_data.name">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Correo electronico</label>
							<input type="email" class="form-control" id="email" v-model="user_data.email">
						</div>
						<div class="mb-4">
							<label for="role" class="form-label">
								Roles
							</label>
							<select name="role" id="role" class="form-control" v-model="user_data.role">
								<option value="user">user</option>
								<option value="admin">admin</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Contraseña</label>
							<input type="password" class="form-control" id="password" v-model="user_data.password">
						</div>
						<div class="mb-4">
							<label for="password_confirmation" class="form-label">
								Confirmar contraseña
							</label>
							<input type="password" class="form-control" id="password_confirmation" v-model="user_data.password_confirmation">
						</div>
						<hr>
						<div class="d-flex justify-content-end mt-4">
							<button type="button" class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#UserModal">Cancelar</button>
							<button type="submit" class="btn btn-primary">
								{{is_create ? 'Crear' : 'Editar'}} Usuario</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['user'],
		data() {
			return {
				is_create: true,
				user_data: {
					role: 'user'
				},
				file: null
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				this.validateUsage()
			},
			validateUsage() {
				if (this.user) {
					this.is_create = false 
					this.user_data = { ...this.user }
					this.user_data.role = this.user_data.roles[0].name
				} else this.is_create = true 
			},
			loadFile(event) {
				this.file = event.target.files[0]
			},
			loadForm() {
				const form_data = new FormData()
				if (this.file) form_data.append('avatar_file', this.file, this.file.name)
				form_data.append('number_id', this.user_data.number_id)
				form_data.append('name', this.user_data.name)
				form_data.append('email', this.user_data.email)
				form_data.append('password', this.user_data.password)
				form_data.append('password_confirmation', this.user_data.password_confirmation)
				form_data.append('role', this.user_data.role)
				return form_data
			},
			async storeUser() {
				try {
					const user = this.loadForm()
					if (this.is_create) {
						await axios.post('/api/Users/SaveUser', user)
					} else {
						await axios.post(`/api/Users/UpdateUser/${this.user_data.id}`, user)
					}
					this.$parent.getUsers()
					this.$parent.closeModal()
					alert('Usuario guardado')
				} catch (error) {
					console.error(error)
					alert('Se detecto un error!!')
				}
			}
		}
	}
</script>
