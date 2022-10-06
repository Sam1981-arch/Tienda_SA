<template>
	<div class="card">
		<div class="card-header d-flex justify-content-between">
			<h2>Usuarios</h2>
			<button class="btn btn-primary btn-sm" type="button" @click="createUser">Crear Prenda</button>
		</div>
		<div class="card-body" v-if="load_users">
			<section class="table-responsive">
				<table class="table" id="userTable" @click="getEvent">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>categoria</th>
							<th>Stock</th>
							<th>Precio</th>
							<th>Descripcion</th>
						</tr>
					</thead>
					<tbody>

							<td>
								<div class="d-flex justify-content-center">
									<button class="btn btn-warning me-2 btn-sm" @click="editUser(garment.id)" type="button">Editar</button>
									<button class="btn btn-danger btn-sm" type="button" @click="questionDelete(garment.id)">Eliminar</button>
									
								</div>
							</td>
					</tbody>
				</table>
			</section>

			

		</div>
		<div class="d-flex justify-content-center py-5" v-else>
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
</template>

<script>
	import ModalGarment from '@/components/Garment/ModalGarment.vue'
	import axios from 'axios'
	export default {
		components: { ModalGarment },
		data() {
			return {
				garments: [],
				user: null,
				load_garments: false,
				load_modal: false,
				modal: null
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				this.getGarments()
			},
			async getGarments() {
				this.load_garments = false
				const { data } = await axios.get('/api/Garments/GetAllGarments')
				this.garments = data.garments
				this.load_garments = true
				this.mountedTable()
			},
			mountedTable() {
				setTimeout(() => $('#GarmentTable').DataTable(), 200)
			},
			createGarment() {
				this.garments = null
				this.openModal()
			},
			async editGarment(garment_id) {
				const { data } = await axios.get(`/api/Garments/GetGarmentById/${garment_id}`)
				this.garment = data.garment
				this.openModal()
			},
			openModal() {
				this.load_modal = true //Montar modal
				setTimeout(() => {
					this.modal = new bootstrap.Modal(document.getElementById('GarmentModal'), {
						keyboard: false
					})
					this.modal.show()
					const modal = document.getElementById('GarmentModal')
					modal.addEventListener('hidden.bs.modal', () => {
						this.load_modal = false 
					})
				}, 100)
			},
			closeModal() {
				this.modal.hide()
			},
			questionDelete(garment_id) {
				if (!confirm('¿Deseas borrar el usuario?')) return
				this.deleteGarment(garment_id)
			},
			async deleteUser(garment_id) {
				try {
					await axios.delete(`/api/Users/DeleteUser/${user_id}`)
					alert('La prenda fue  eliminada con exito!')
					this.getGarments()
				} catch (error) {
					console.error(error)
					alert('Se Detecto un error!')
				}
			}
		}
	}
</script>
