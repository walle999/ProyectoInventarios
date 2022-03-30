<?php include("template/encabezado.php"); ?>


<?php
include('../con_db.php');
$orden = $_GET['orden'];
//echo $orden;
$query = $connection->prepare("SELECT * FROM ordenes WHERE id_orden=:orden");
$query->bindParam(":orden", $orden, PDO::PARAM_STR);
$query->execute();
$result=$query->fetch(PDO::FETCH_ASSOC);

$txtTipoorden = $result['tipo_orden'];
$txtEstado = $result['estado'];
$txtNombrecliente = $result['nombre_cliente'];
$txtContactocliente = $result['contacto_cliente'];
$txtDireccioncliente = $result['direccion_cliente'];
$txtNombretecnico = $result['nombre_tecnico'];
$txtObservaciones = $result['observaciones'];
$txtTipocliente = $result['tipo_cliente'];
$txtDpto = $result['departamento'];
$txtMunicipio = $result['municipio'];


if(isset($_POST['txtAccion'])){
    
    $Accion=(isset($_POST['txtAccion']))?$_POST['txtAccion']:"";
    
    if($Accion=="Agregar" && $txtEstado=="Activa"){
        $txtCodeMaterial=(isset($_POST['txtMaterial']))?$_POST['txtMaterial']:"";
        $txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
        $txtCodematerial1 = explode('|',$txtCodeMaterial);
        $txtCodigo_material=$txtCodematerial1[0];
        $txtMaterial=$txtCodematerial1[1];
        
        $query = $connection->prepare("SELECT password FROM usuarios WHERE id=:txtCodigo_material");
        $query->bindParam(":txtCodigo_material", $txtCodigo_material);
        $query->execute();
        $result2=$query->fetch();
        //echo $result2[0];

        if ($result2[0]>=$txtCantidad){
            $query = $connection->prepare("INSERT INTO consumos(codigo,descripcion,cantidad,orden) VALUES (:txtCodigo_material,:txtMaterial,:txtCantidad,:orden)");
            $query->bindParam(":txtCodigo_material", $txtCodigo_material, PDO::PARAM_STR);
            $query->bindParam(":txtMaterial", $txtMaterial, PDO::PARAM_STR);
            $query->bindParam(":txtCantidad", $txtCantidad, PDO::PARAM_STR);
            $query->bindParam(":orden", $orden, PDO::PARAM_STR);
            $query->execute();

            $total=$result2[0]-$txtCantidad;
            /*
            $query = $connection->prepare("UPDATE materiales SET cantidad=':total' WHERE id=:txtCodigo_material");
            $query->bindParam(":total", $total, PDO::PARAM_STR);
            $query->execute();
            */
        }else{
            echo '<div class="alert alert-danger" role="alert">
            Cantidad de material insuficiente
            </div>';
        }
        
    } else if($Accion=="Eliminar" && $txtEstado=="Activa"){
        $txt1Cantidad=(isset($_POST['txt1Cantidad']))?$_POST['txt1Cantidad']:"";
        $txt1Codigo_material=(isset($_POST['txt1Codigo']))?$_POST['txt1Codigo']:"";
        
        $query = $connection->prepare("DELETE FROM consumos WHERE codigo=:txt1Codigo AND cantidad=:txt1Cantidad AND orden=:orden");
        $query->bindParam(":txt1Codigo", $txt1Codigo_material, PDO::PARAM_STR);
        $query->bindParam(":txt1Cantidad", $txt1Cantidad, PDO::PARAM_STR);
        $query->bindParam(":orden", $orden, PDO::PARAM_STR);
        $query->execute();
    }else if($Accion=="Terminar"){
        $query = $connection->prepare("UPDATE ordenes SET estado='Terminada' WHERE id_orden=:orden");
        $query->bindParam(":orden", $orden, PDO::PARAM_STR);
        $query->execute();
        header("location:ordenes.php");
    }
}
?>

<h1 class="display-3">Orden <?php echo $_GET['orden'];?></h1>
<hr class="my-2">
<div class="col-md-6">
    <h6>Tipo de Orden:</h6>
    <h4><?php echo $txtTipoorden; ?></h4>
    <h6>Departamento:</h6>
    <h4><?php echo $txtDpto; ?></h4>
    <h6>Cliente:</h6>
    <h4><?php echo $txtNombrecliente; ?></h4>
    <h6>Teléfono:</h6>
    <h4><?php echo $txtContactocliente; ?></h4>
</div>
<div class="col-md-6">
    <h6>Tipo de Cliente:</h6>
    <h4><?php echo $txtTipocliente; ?></h4>
    <h6>Municipio:</h6>
    <h4><?php echo $txtMunicipio; ?></h4>
    <h6>Dirección:</h6>
    <h4><?php echo $txtDireccioncliente; ?></h4>
    <h6>Técnico:</h6>
    <h4><?php echo $txtNombretecnico; ?></h4>
</div>
<h6>Observaciones:</h6>
<h4><?php echo $txtObservaciones; ?></h4>

<h2 style="margin-top: 20px";>Materiales</h2>
<hr class="my-2">

<?php if($txtEstado=="Activa"){?>
<h4 style="margin-top: 20px";>Seleccione el material que desea agregar</h4>
<form method="POST">

    <table class="table table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th>Código/Descripción</th>
            <th>Cantidad</th>
            <th>Acción</th>
            
        </tr>
        </thead>
        <tbody>
            
            <tr>
                <td>
                <div class = "form-group">
                    
                    <select type="search" class="form-control" name="txtMaterial" id="txtMaterial" required>
                        <option value="">Código/Descripción</option>
                        <?php
                        include('../con_db.php');
                        $tipousuario=2;
                        $query = $connection->prepare("SELECT * FROM usuarios WHERE idtipousuario=:tipousuario");
                        $query->bindParam(":tipousuario", $tipousuario, PDO::PARAM_STR);
                        $query->execute();
                        $result1=$query->fetchall();

                        foreach ($result1 as $opciones){
                            echo '<option>'.$opciones["id"].'|'.$opciones["nombre"].'</option>';
                        }
                        ?>
                    
                    </select>
        </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="number" class="form-control" min="1"  name="txtCantidad" id="txtCantidad" placeholder="Cantidad" required/>
                    </div>
                </td>
                <td>
                    
                    <div class="form-group" role="group" aria-label="">
                        <button type="submit" name="txtAccion" value="Agregar" class="btn btn-success">Agregar</button>
                    </div>
                </td>
            </tr>
            
        </tbody>
    </table>

</form>
<?php } ?>
<?php

$query = $connection->prepare("SELECT * FROM consumos WHERE orden=:orden");
$query->bindParam(":orden", $orden, PDO::PARAM_STR);
$query->execute();
$result=$query->fetchall(PDO::FETCH_ASSOC);

?>
<h4 style="margin-top: 20px";>Materiales agregados a la orden</h4>

    <table class="table table-bordered">
    <thead class="thead-inverse">
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <?php if($txtEstado=="Activa"){?>
                <th>Acción</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $mate) {?>
            <tr>
                <td><?php echo $mate['codigo']?></td>
                <td><?php echo $mate['descripcion']?></td>
                <td><?php echo $mate['cantidad']?></td>

                <?php if($txtEstado=="Activa"){?>
                <td>
                    <form method="post">
                    <div class="form-group" role="group" aria-label="">
                    <input type="hidden" class="form-control" name="txt1Codigo" id="txt1Codigo" value="<?php echo $mate['codigo']?>"/>
                    <input type="hidden" class="form-control" name="txt1Cantidad" id="txt1Cantidad" value="<?php echo $mate['cantidad']?>"/>
                        <button type="submit" name="txtAccion" value="Eliminar" class="btn btn-danger">Eliminar</button>
                    </div>
                    </form>
                </td>
                <?php } ?>

            </tr>
        <?php } ?>
        </tbody>
</table>
</br>
</br>
<?php if($txtEstado=="Activa"){?>
<div class="btn group" role="group" aria-label="">
        <form method="post">
        <button style="margin-top: 20px" onclick="window.location='sitioweb/tecnico/ordenes.php'" type="submit" name="txtAccion" value="Terminar" class="btn btn-primary">Terminar Orden</button>
        </form>
    </div>
<?php } ?>

<?php include ("template/piedepagina.php");?>