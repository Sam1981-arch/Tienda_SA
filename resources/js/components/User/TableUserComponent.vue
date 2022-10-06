<template>
	<div class="card">
		<div class="card-header d-flex justify-content-between">
			<h2>Usuarios</h2>
			<button class="btn btn-primary btn-sm" type="button" @click="createUser">Crear Usuario</button>
		</div>
		<div class="card-body" v-if="load_users">
			<section class="table-responsive">
				<table class="table" id="userTable" @click="getEvent">
					<thead>
						<tr>
							<th>Avatar</th>
							<th>CC</th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Role</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(user, index) in users" :key="index">
							<td>
								<img :src="`/storage/images/${user.avatar}`" alt="avatar" width="30">
							</td>
							<td>{{user.number_id}}</td>
							<td>{{user.name}}</td>
							<td>{{user.email}}</td>
							
							<td>{{user.roles[0].name}}</td>
							<td>
								<div class="d-flex justify-content-center">
									<button class="btn btn-warning me-2 btn-sm" @click="editUser(user.id)" type="button">Editar</button>
									<button class="btn btn-danger btn-sm" type="button" @click="questionDelete(user.id)">Eliminar</button>
									
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</section>

			<!-- Cards -->
			<section class="d-flex justify-content-evenly  flex-wrap">
				<div class="card mx-4 my-4" style="width: 14rem; height:24rem" v-for="(user, index) in users" :key="index">
					<img :src="`/storage/images/${user.avatar}`" class="card-img-top" alt="avatar">
					<div class="card-body">
						<h5 class="card-title">{{user.name}}</h5>
						<p class="card-text">{{user.email}}</p>
						<div class="d-flex justify-content-between">
							<button class="btn btn-warning btn-sm" @click="editUser(user.id)" type="button">Editar</button>
							<button class="btn btn-danger btn-sm" type="button" @click="questionDelete(user.id)">Eliminar</button>
						</div>
					</div>
				</div>
			</section>

		</div>
		<div class="d-flex justify-content-center py-5" v-else>
			<div class="spinner-border" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>

		<div v-if="load_modal">
			<modal-user :user="user" />
		</div>
	</div>
</template>

<script>
	import ModalUser from '@/components/User/ModalUser.vue'
	import axios from 'axios'
	export default {
		components: { ModalUser },
		data() {
			return {
				users: [],
				user: null,
				load_users: false,
				load_modal: false,
				modal: null
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				this.getUsers()
			},
			async getUsers() {
				this.load_users = false
				const { data } = await axios.get('/api/Users/GetAllUsers')
				this.users = data.users
				this.load_users = true
				this.mountedTable()
			},
			mountedTable() {
				setTimeout(() => $('#userTable').DataTable(), 200)
			},
			createUser() {
				this.user = null
				this.openModal()
			},
			async editUser(user_id) {
				const { data } = await axios.get(`/api/Users/GetUserById/${user_id}`)
				this.user = data.user
				this.openModal()
			},
			openModal() {
				this.load_modal = true //Montar modal
				setTimeout(() => {
					this.modal = new bootstrap.Modal(document.getElementById('UserModal'), {
						keyboard: false
					})
					this.modal.show()
					const modal = document.getElementById('UserModal')
					modal.addEventListener('hidden.bs.modal', () => {
						this.load_modal = false 
					})
				}, 100)
			},
			closeModal() {
				this.modal.hide()
			},
			questionDelete(user_id) {
				if (!confirm('¿Deseas borrar el usuario?')) return
				this.deleteUser(user_id)
			},
			async deleteUser(user_id) {
				try {
					await axios.delete(`/api/Users/DeleteUser/${user_id}`)
					alert('El Usuario fue  eliminado con exito!')
					this.getUsers()
				} catch (error) {
					console.error(error)
					alert('Se Detecto un error!')
				}
			}
		}
	}
</script>
