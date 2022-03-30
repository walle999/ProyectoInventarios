<?php
session_start();
include('con_db.php');


if(isset($_POST['login'] )){
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    $query = $connection->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
    $query->bindParam(":usuario", $usuario, PDO::PARAM_STR);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_ASSOC);
    
    
    if ($password== $result['password']){
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_name'] = $result['usuario'];
        $query = $connection->prepare("UPDATE usuarios SET logged =1 WHERE usuario=:usuario");
        $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
        $query->execute();
        if($result['idtipousuario']==1){
            header('Location: administrador/inicio.php');
            die();
        }
        if($result['idtipousuario']==2){
            header('Location: tecnico/inicio.php');
            die();
        }
        if($result['idtipousuario']==3){
            header('Location: almacenista/inicio.php');
            die();
        }
    
    }else{
        echo '<div class="alert alert-danger" role="alert">
            Usuario y/o contraseña no coinciden
            </div>';
        
    }
}
   

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Conector</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <br/><br/><br/><br/>
    <div class="container">
    
        <div class="row">
        
        <div class="col-md-3">
            
        </div>
        
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Iniciar Sesión
                    </div>
                    <div class="card-body">
                        

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class = "form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" [placeholder="Usuario"] required/>
                            
                            </div>
                            <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" [placeholder="Contraseña"] required/>
                            </div>
                            
                            <button class="btn btn-primary mt-2" type="submit" name="login" value="login">Iniciar sesión</button>
                            
                        </form>
                                                
                    </div>
                    
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>


  </body>
</html>


