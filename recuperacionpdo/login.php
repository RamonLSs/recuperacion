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
     
      <div class="container">
      <form name='login' action='plogin.php' method='POST' >
      <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" /> 
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email"  placeholder="Email:" name="email">
  </div>
  <div class="form-group">
    <label for="contraseña">Contraseña</label>
    <input type="password" class="form-control" id="pass" placeholder="Contraseña:" name="pass">
  </div>
  <button type="submit" class="btn btn-primary" name='btn'>Login</button>
  <input type="reset" value="Limpiar" class="btn btn-warning">
</form>
</div>
      <div class="container mt-3" style="border: white 8px groove; padding: 6px">
          <p><b>Estos son los correos y sus respectivas contraseñas:</b></p>
          <p><b>Email:</b> admin@email.com <b>Contraseña:</b> admin</p>
          <p><b>Email:</b> usu1@email.com <b>Contraseña:</b> usu1</p>
          <p><b>Email:</b> usu2@email.com <b>Contraseña:</b> usu2</p>
          <p><b>Email:</b> usu3@email.com <b>Contraseña:</b> usu3</p>
      </div>
  </body>
</html>