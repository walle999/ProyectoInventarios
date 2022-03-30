<?php include("template/encabezado.php"); ?>

<?php
session_start();
include('../con_db.php');
$usser=$_SESSION['user_name'];
$query = $connection->prepare("SELECT nombre FROM usuarios WHERE usuario=:usser");
$query->bindParam(":usser", $usser, PDO::PARAM_STR);
$query->execute();
$result1=$query->fetch();
$nombre=$result1['nombre'];
$query = $connection->prepare("SELECT * FROM ordenes WHERE nombre_tecnico=:nombre");
$query->bindParam(":nombre", $nombre, PDO::PARAM_STR);
$query->execute();
$result=$query->fetchall(PDO::FETCH_ASSOC);

?>

<h1 class="display-3">Mis Ordenes</h1>

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
                <td><?php $orden1=$orden['id_orden']?><a href="orden.php?orden=<?php echo $orden['id_orden'];?>"><?php echo $orden['id_orden'];?></a></td>
                <td <?php if($orden['estado']=="Activa"){?>style="color:#09B708"<?php } ?>><?php echo $orden['estado']?></td>
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