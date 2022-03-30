<?php
    session_start();
    require_once "../Database/Database.php";
    if ($_SESSION['username'] == null){
        echo "<script>alert('Favor ingresar con tus credenciales')</script>";
        header("Refresh:0 , url = ../index.html");
        exit();

    }
    $delete_num = $_GET['id']; 
    echo $delete_num;
    $sql_delete =  "DELETE FROM product WHERE id = '$delete_num'";
    $query_delete = mysqli_query($conn, $sql_delete);

      //$row = mysqli_fetch_array($query_delete, MYSQLI_ASSOC);
    if($query_delete){
        echo "<script>alert('Eliminación de Producto Exitosa')</script>";        
        header("Refresh: 0 , url = ../list.php");
        exit();

    }
    else{
        echo "<script>alert('No se pudo eliminar producto')</script>";
        header("Refresh: 0 , url = ../list.php");
        exit();

    }
    mysqli_close($conn);
?>