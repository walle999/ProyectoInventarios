<?php include("template/encabezado.php"); ?>
<?php
include('../con_db.php');
$query = $connection->prepare("SELECT * FROM ordenes");
$query->execute();
$result=$query->fetchall(PDO::FETCH_ASSOC);

?>
<h1 class="display-3">Mis Ordenes</h1>

<div class="nav navbar-nav">
    <p class="lead">
    <a class="btn btn-primary btn-lg" href="ordenesacrear.php" role="button">Crear</a>
</div>

<hr class="my-2">

<table class="table table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th>Número</th>
            <th>Estado</th>
            <th>Tipo Orden</th>
            <th>Tipo de cliente</th>
            <th>Cliente</th>
            <th>Dirección</th>
            <th>Técnico</th>
            <th>Municipio</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $orden) {?>
            <tr>
                <td><?php echo $orden['id_orden']?></td>
                <td><?php echo $orden['estado']?></td>
                <td><?php echo $orden['tipo_orden']?></td>
                <td><?php echo $orden['tipo_cliente']?></td>
                <td><?php echo $orden['nombre_cliente']?></td>
                <td><?php echo $orden['direccion_cliente']?></td>
                <td><?php echo $orden['nombre_tecnico']?></td>
                <td><?php echo $orden['municipio']?></td>
            </tr>
            <?php } ?>
        </tbody>
</table>
    










<?php include ("template/piedepagina.php");?>