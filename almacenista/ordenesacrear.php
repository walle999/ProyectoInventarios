<?php include("template/encabezado.php"); ?>

<?php

$txtNombrecliente=(isset($_POST['txtNombrecliente']))?$_POST['txtNombrecliente']:"";
$txtContactocliente=(isset($_POST['txtContactocliente']))?$_POST['txtContactocliente']:"";
$txtDireccioncliente=(isset($_POST['txtDireccioncliente']))?$_POST['txtDireccioncliente']:"";
$txtNombretecnico=(isset($_POST['txtNombretecnico']))?$_POST['txtNombretecnico']:"";
$txtObservaciones=(isset($_POST['txtObservaciones']))?$_POST['txtObservaciones']:"";
$txtTipoorden=(isset($_POST['txtTipoorden']))?$_POST['txtTipoorden']:"";
$txtTipocliente=(isset($_POST['txtTipocliente']))?$_POST['txtTipocliente']:"";
$txtDpto=(isset($_POST['txtDpto']))?$_POST['txtDpto']:"";
$txtMunicipio=(isset($_POST['txtMunicipio']))?$_POST['txtMunicipio']:"";
$txtEstado="Activa";
$txtAccion=(isset($_POST['txtAccion']))?$_POST['txtAccion']:"";
/*
echo $txtNombrecliente."<br/>";
echo $txtContactocliente."<br/>";
echo $txtDireccioncliente."<br/>";
echo $txtEmailcliente."<br/>";
echo $txtNombretecnico."<br/>";
echo $txtContactotecnico."<br/>";
echo $txtObservaciones."<br/>";
echo $txtTipoorden."<br/>";
echo $txtTipocliente."<br/>";
echo $txtDpto."<br/>";
echo $txtMunicipio."<br/>";
echo $txtAccion."<br/>";
*/
include('../con_db.php');
if(isset($_POST['txtAccion'])){
    $query = $connection->prepare("INSERT INTO ordenes(tipo_orden,tipo_cliente,nombre_cliente,direccion_cliente,contacto_cliente,nombre_tecnico,observaciones,departamento,municipio,estado) VALUES (:txtTipoorden,:txtTipocliente,:txtNombrecliente,:txtDireccioncliente,:txtContactocliente,:txtNombretecnico,:txtObservaciones,:txtDpto,:txtMunicipio,:txtEstado)");
    $query->bindParam(":txtNombrecliente", $txtNombrecliente, PDO::PARAM_STR);
    $query->bindParam(":txtContactocliente", $txtContactocliente, PDO::PARAM_STR);
    $query->bindParam(":txtDireccioncliente", $txtDireccioncliente, PDO::PARAM_STR);
    $query->bindParam(":txtNombretecnico", $txtNombretecnico, PDO::PARAM_STR);
    $query->bindParam(":txtObservaciones", $txtObservaciones, PDO::PARAM_STR);
    $query->bindParam(":txtTipoorden", $txtTipoorden, PDO::PARAM_STR);
    $query->bindParam(":txtTipocliente", $txtTipocliente, PDO::PARAM_STR);
    $query->bindParam(":txtDpto", $txtDpto, PDO::PARAM_STR);
    $query->bindParam(":txtMunicipio", $txtMunicipio, PDO::PARAM_STR);
    $query->bindParam(":txtEstado", $txtEstado, PDO::PARAM_STR);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_ASSOC);
    header("Location: ./../almacenista/ordenes.php");
}
qw

?>


<h1 class="display-3">Crear Orden</h1>  
<hr class="my-2">
<div class="col-md-6">
    
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    
        <div class = "form-group">
            <label for=>Tipo de Orden</label>
            <label for="tipo_orden"></label>
            <select class="form-control" name="txtTipoorden" id="txtTipoorden" required>
            <option value="">Seleccione:</option>
            <option>Instalación</option>
            <option>Mantenimiento</option>
            </select>
        </div>

        <div class = "form-group">
            <label for="">Departamento</label>
            <select class="form-control" name="txtDpto" id="txtpto" required>
            <option value="">Seleccione:</option>
            <option>CASANARE</option>
            </select>
        </div>

        <div class="form-group">
        <label for="txtNombre">Nombre del cliente</label>
        <input type="text" class="form-control" name="txtNombrecliente" id="txtNombrecliente" placeholder="Nombre completo del cliente" required/>
        </div>

        <div class="form-group">
        <label for="txtNombre">Número de contacto</label>
        <input type="number" class="form-control" name="txtContactocliente" id="txtContactocliente" placeholder="Celular/Teléfono del cliente" required/>
        </div>

        
    </div>       
        
    <div class="col-md-6">
    
        <div class = "form-group">
            <label for="">Tipo de Cliente</label>
            <label for=""></label>
            <select class="form-control" name="txtTipocliente" id="txtTipocliente" required>
            <option value="">Seleccione:</option>
            <option>Residencial</option>
            <option>Negocios</option>
            </select>
        </div>

        <div class = "form-group">
            <label for="">Municipio</label>
            <label for=""></label>
            <select class="form-control" name="txtMunicipio" id="txtMunicipio" required>
            <option value="">Seleccione:</option>
            <option>AGUAZUL</option>
            <option>PAZ DE ARIPORO</option>
            <option>TAURAMENA</option>
            <option>VILLANUEVA</option>
            <option>YOPAL</option>
            </select>
        </div>
        <div class="form-group">
            <label for="txtNombre">Dirección</label>
            <input type="text" class="form-control" name="txtDireccioncliente" id="txtDireccioncliente" placeholder="Dirección del cliente" required/>
        </div>

        <div class = "form-group">
            <label for="">Nombre del técnico</label>
            <select class="form-control" name="txtNombretecnico" id="txtNombretecnico" required>
                <option value="">Seleccione:</option>
                <?php
                include('../con_db.php');
                $tipousuario=2;
                $query = $connection->prepare("SELECT * FROM usuarios WHERE idtipousuario=:tipousuario");
                $query->bindParam(":tipousuario", $tipousuario, PDO::PARAM_STR);
                $query->execute();
                $result1=$query->fetchall();

                foreach ($result1 as $opciones){
                    echo '<option value="'.$opciones["nombre"].'">'.$opciones["nombre"].'</option>';
                }
                ?>
                        
            </select>
        </div>
        
        </br>
    </div>
    
    <div class="form-group">
        <label for="txtNombre">Observaciones</label>
        <input type="text" class="form-control" name="txtObservaciones" id="txtObservaciones" placeholder="">
    </div>

    <div class="btn group" role="group" aria-label="">
        <button type="submit" name="txtAccion" value="txtAccion" class="btn btn-primary">Crear Orden</button>
    </div>
</form>    



<?php include ("template/piedepagina.php");?>







