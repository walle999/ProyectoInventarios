<?php include("template/encabezado.php"); ?>
    <?php 
    require_once "../con_db.php";
    $sql_fetch_todos = "SELECT * FROM product ORDER BY id ASC";
    $query = mysqli_query($connection, $sql_fetch_todos);
    ?>
<div class="jumbotron">
    <h1 class="display-3">Materiales</h1>
    
    <hr class="my-2">
    
    <div class="container">
        <h1>Lista de Materiales</h1>
    </div>
    <div class="table-product">
        <table>
            <tr>
                <th scope="col">Orden</th>
                <th scope="col">ID:Material</th>
                <th scope="col">Nombre:material</th>
                <th scope="col">Cantidades</th>
                <th scope="col">Fecha:Registro</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
            <tbody>
                <?php
                $idpro = 1;
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td scope="row"><?php echo $idpro ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['proname'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                        <td class="timeregis"><?php echo $row['time'] ?></td>
                        <td class="modify"><a name="edit" id="" class="bfix" href="fix.php?id=<?php echo $row['id'] ?>&message=<?php echo $row['proname'] ?>&amount=<?php echo $row['amount']; ?> " role="button">
                                Editar
                            </a></td>
                        <td class="delete"><a name="id" id="" class="bdelete" href="main/delete.php?id=<?php echo $row['id'] ?>" role="button">
                                Eliminar
                            </a></td>
                    </tr>
                <?php
                    $idpro++;
                } ?>
            </tbody>
        </table>
        <br>
        <a name="" id="" class="Addlist" style="float:right" href="addlist.php" role="button">Agregar Material</a>
    </div>
    <?php
    mysqli_close($conn);
    ?>


<?php include ("template/piedepagina.php");?>