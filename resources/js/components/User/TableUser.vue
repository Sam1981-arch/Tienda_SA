<template>
	<section class="card">
		<div class="card-header">
			<h2>Usuarios Registrados</h2>
		</div>
		<div class="card-body">
			<section class="table-responsive">
				<table id="UserTable" class="table" @click="getEvent">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Email</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</section>
		</div>
	</section>

</template>

<script>

	export default {
		data() {
			return {
				users: [],
				load_user: false
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				this.getUsersDT()
			},
			getUsersDT() {
				$('#UserTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/Users/GetAllUsersWithDT'
					},
					columns: [
						{ data: 'name', name: 'name' },
						{ data: 'email', name: 'email' },
						{ data: 'action', name: 'action' }
					]
				})
			},
			getEvent(event) {
				const button = event.target
				if (button.getAttribute('role') === 'delete') {
					console.log('eliminar' + button.getAttribute('data-id'))
				}
				if (button.getAttribute('role') === 'edit') {
					console.log('editar' + button.getAttribute('data-id'))
				}
			}
		}
	}
</script>
