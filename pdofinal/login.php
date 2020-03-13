<?php
    session_start();
    function generarToken(){
        return bin2hex(random_bytes(32/2));
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Televisores</title>
  </head>
  <body style="background-color: gray">
      
      <h3 class="text-center mt-3">Login</h3>
      <?php
      $_SESSION['token']=generarToken();
      
       if(isset($_SESSION['msg'])){
           echo "<p class='container text-danger'>";
                   echo $_SESSION['msg'];
           echo "</p>";
           unset($_SESSION['msg']);
       }
      ?>
      <div class="container mt-3" style="border: white 8px groove; padding: 6px">
            <form name='login' action='plogin.php' method='POST' > 
             <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" /> 
                
                <div class="form-group">
                    <label for="nom">Email</label>
                    <input type="txt" class="form-control" required id="ema" placeholder="Email" name='email' />
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" class="form-control" required id="pass" placeholder="Contraseña" name='pass' />
                </div>

                <button type="submit" class="btn btn-primary" name='btn'>Login</button>&nbsp;
                <input type='reset' value='Limpiar' class='btn btn-warning' />&nbsp;
                <!-- <a href="index.php" class="btn btn-success">Entrar Como Invitado</a> -->
               
            </form>
      </div>
  </body>
</html>