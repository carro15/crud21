<?php

require_once '../Model/clientes.php';

if (isset($_GET['consult'])) { //Mostrar Usuarios
	$ClientesModel = new Clientes();

?>
	<script>
		$(document).ready(function() {
			$('#example').DataTable({
				"order": [
					[0, "desc"]
				]
			});
		});
	</script>

	<table id="example" class="table table-striped table-hover table-bordered">
		<thead class="btn-primary">
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>direccion</th>
				<th width="8%">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($ClientesModel->Mostrarclientes() as $data) {

			?>

				<tr><input type="hidden" id="nombre_<?php echo $data['idclientes']; ?>" value="<?php echo $data['nombre']; ?>">
					<input type="hidden" id="direccion_<?php echo $data['idclientes']; ?>" value="<?php echo $data['direccion']; ?>">
					<td><?php echo $data['idclientes']; ?></td>
					<td><?php echo $data['nombre']; ?></td>
					<td><?php echo $data['direccion']; ?></td>
					<td>
						<div class="btn-group" role="group" aria-label="Basic mixed styles example">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModaledit" data-bs-whatever="@mdo" onclick="editar(<?php echo $data['idclientes']; ?>)"><span class="fas fa-edit"></span></button>
							<button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $data['idclientes']; ?>)"><span class="fas fa-trash"></span></button>

						</div>
					</td>
				</tr>


			<?php
			}

			?>
		</tbody>
	</table>


<?php
} else if (isset($_GET['action']) && $_GET['action'] == "save") {
	$ClientesModel = new Clientes();

	$ClientesModel->nombre = htmlentities($_POST['nombres']);
	$ClientesModel->direccion = htmlentities($_POST['direccion']);



	$client = $ClientesModel->Registrarclientes($ClientesModel);

	if ($client) {
		echo "exito";
		
	} else {
		echo "error";
	}

} else if (isset($_GET['action']) && $_GET['action'] == "eliminar") {
	$ClientesModel = new clientes();

	$ClientesModel->idclientes = htmlentities($_GET['id']);




	$client = $ClientesModel->eliminarclientes($ClientesModel);

	if ($client) {
		echo "exito";
	} else {
		echo "error";
	}
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {
	$ClientesModel = new Clientes();
	$ClientesModel->idclientes = htmlentities($_POST['idedit']);
	$ClientesModel->nombre = htmlentities($_POST['nombreedit']);
	$ClientesModel->direccion = htmlentities($_POST['direccionedit']);




	$Client = $ClientesModel->Editarclientes($ClientesModel);

	if ($Client) {
		echo "exito";
	} else {
		echo "error";
	}
}
?>