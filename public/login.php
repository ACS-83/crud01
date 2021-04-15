<?php
    session_start();
    require "../vendor/autoload.php";
    use Clases\Users;
    function mostrarError($texto){
        $_SESSION['error']=$texto;
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }

    if(isset($_POST['login'])){
        //procesar formulario
        $nombre=trim($_POST['nombre']);
        $pass=trim($_POST['pass']);
        if(strlen($nombre)==0 || strlen($pass)==0){
            mostrarError("Rellene los campos!!!!");
        }
        $passBuena=hash('sha256',$pass);
        $usuario=new Users();
        if($usuario->validarUsuario($nombre, $passBuena)){
            $usuario=null;
            die("<div style='text-align: center; margin-top: 20%; margin-bottom: 20%;'><h2>Bienvenido</h2></div>");
        }else{
            $usuario=null;
            mostrarError("Nombre o pass incorrectos");
        }

    }else{// << Lo cerramos abajo del todo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body style="background-color: lightgrey;">


<div>
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
        ?>
        
        <div style="text-align: center; margin-top: 20%; margin-bottom: 20%;">
        <h3>Login</h3>
        <div>
            <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="POST">
                <div>
                    <label for="nu">Usuario</label>
                    <input type="text" id="nu" placeholder="Introduce usuario" name="nombre" required>
                </divs>
            <p>
                <div>
                    <label for="np">Contraseña</label>
                    <input type="password" id="np" placeholder="Introduce password" name="pass" required>
                </divs>
            <p>
                <div>
                    <button type='submit' name='login'><i></i>Entrar</button>
                </div>
            </form>
        </div>
        <div>
    </div>
</div>
</body>
</html>
<?php
    } // << Cerramos else aquí
?>