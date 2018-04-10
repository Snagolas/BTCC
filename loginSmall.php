<!DOCTYPE html>
<?php
  session_start();
  include "bancoDados.class.php";

  $banco = new bancoDadosBTCC("root", "", "localhost", "bd_btcc");

  if(isset($_GET['des'])){
    if($_GET['des']){
      $_SESSION['logado'] = false;

      $_SESSION['nome'] = null;
      $_SESSION['senha'] = null;
      $_SESSION['codigoUsu'] = null;
      $_SESSION['tipoUsu'] = null;

      header("Location: index.php");  
    }
  }

  if(!isset($_SESSION['logado'])) $_SESSION['logado'] = false;  

?>
<html>
<!DOCTYPE html>
<html>

<head>

	<title>BTCC</title>

	<!-- METAS -->

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CHAMADAS DE CSS/JAVASCRIPT -->

	<link href="css/w3.css" rel="stylesheet">

</head>

<body>	

<div style="width: 100%">

  <header class="w3-container w3-center" style="background-color: #A90E10; color: white;"> 

    <span onclick="javascript:location.href='index.php'" 
    class="w3-button w3-display-topright">&#65513; Voltar</span>

    <h2>Entrar</h2>

  </header>

  <div class="w3-container">

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

    <br><br><label for="nome">Nome de usuário:</label><br|>

    <input class="w3-input w3-animate-input" style ="width: 50%;" type="text" id="login" name="login" placeholder="Usuario" <?php if(isset($_COOKIE["login"])) echo $_COOKIE['login'];?>><br>

    <label for="senha">Senha:</label><br>

    <input class="w3-input w3-animate-input" style ="width: 50%;" type="password" id="senha" name="senha" placeholder="Senha"><br><br>

    <div class="w3-center">

    	<button class="w3-button w3-round w3-card-4 w3-light-gray"  type="submit" class="btn btn-info btn-md">Login</button><br><br>

    	           

	</div>
                  
    </form>

  </div>

  <?php                                                                              

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // PEGA O VALOR DOS INPUTS
        $_SESSION["login"] = htmlspecialchars($_REQUEST['login']); 
        $_SESSION["senha"] = htmlspecialchars($_REQUEST['senha']);      

        if (isset($_REQUEST['saveLogin']))
          $_SESSION["saveLogin"] = true;            
        else
          $_SESSION["saveLogin"] = false;

        $usuario = $banco->realizarLogin($_SESSION["login"],$_SESSION["senha"]);    

        //VERIFICA O LOGIN E O REALIZA
        if($usuario == "0"){
          echo "<script>alert('ERRO! Login ou Senha errados.');</script>";
          $_SESSION['logado'] = false;
        }
        else{
          $usuario = explode("*", $usuario);

          $_SESSION['nome'] = $usuario[0];
          $_SESSION['senha'] = $usuario[1];
          $_SESSION['codigoUsu'] = $usuario[2];
          $_SESSION['tipoUsu'] = $usuario[3];

          $_SESSION['logado'] = true;
          
          echo "<script>alert('Login efetuado com sucesso! Redirecionando...');</script>";          

          header("Location: index.php");       
        }

      }                  
      ?>

  <footer class="w3-container w3-bottom" style="background-color: #A90E10; color: white; height: 100px;">&nbsp</footer>

</div>

</body>

</html>