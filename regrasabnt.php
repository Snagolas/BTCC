<!DOCTYPE html>
<html>

<head>

	<title>BTCC</title>

	<!-- METAS -->

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CHAMADAS DE CSS/JAVASCRIPT -->

	<link href="css/w3.css" rel="stylesheet">
	<link href="css/w3-theme-red.css" rel="stylesheet">		
	<script src="js/w3.js"></script>

	<style>
		.mySlides {display:none}
		.w3-left, .w3-right, .w3-badge {cursor:pointer}
		.w3-badge {height:20px;width:20px;padding:0}
	</style>

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

</head>

<body>

<br>

	<!-- //////////////////////////////////////////////// COMEÇO NAVBAR ///////////////////////////////////////////////////// -->
	<div class="w3-container w3-hide-small" style="margin-top: 40px; margin-right: 100px; margin-left: 100px; position: relative; z-index: 200;">

		<div class="w3-bar w3-border w3-border-gray w3-card-4 w3-round-xlarge w3-center" style="background-color: #4a555c; font-family: 'Verdana',sans-serif; height: 50px;">

			<a href="index.php" class="w3-bar-item w3-button w3-round-xlarge" style="background-color: #f1f1f1; color: #000000; height: 50px; padding-top: 8px;"><img class="w3-round-large" src="images/logobtcc.png" 
				style="height: 50px; width: 120px; margin-top: -12px;" /></a>

			<?php				

				if(!$_SESSION['logado']){
					echo "<button onclick='document.getElementById(\"login\").style.display=\"block\"' class='w3-bar-item w3-button w3-button w3-right w3-hide-small' style='color: #fff; height: 47px; margin-right: 20px;'>Entrar</button>";
				}else{
					echo "
					<a href='index.php?des=true' class='w3-bar-item w3-button w3-right w3-hide-small' style='color: #fff; height: 50px; padding-top: 13px;'>Deslogar</a>

					<a href='pagUsu.php?id=".$_SESSION['codigoUsu']."' class='w3-bar-item w3-button w3-right w3-hide-small' style='color: #fff; height: 50px; padding-top: 13px;'>".$_SESSION['nome']."</a>";

					switch ($_SESSION['tipoUsu']) 
					{
						case '1':
							echo "
							<a href='sugestoesProf.php' class='w3-bar-item w3-button w3-right w3-hide-small' style='color: #fff; height: 50px; padding-top: 13px;'>Area do Professor</a>

							<a href='homeUsu.php' class='w3-bar-item w3-button w3-right w3-hide-small' style='color: #fff; height: 50px; padding-top: 13px;'>Pesquisar TCCs</a>";
							break;

						case '2':
							echo "
							<a href='homeUsu.php' class='w3-bar-item w3-button w3-right w3-hide-small' style='color: #fff; height: 50px; padding-top: 13px;'>Pesquisar TCCs</a>";
							break;

						case '3':
							echo "
							<a href='admin.php' class='w3-bar-item w3-button w3-right w3-hide-small' style='color: #fff; height: 50px; padding-top: 13px;'>Area do Administrador</a>
							
							<a href='homeUsu.php' class='w3-bar-item w3-button w3-right w3-hide-small' style='color: #fff; height: 50px; padding-top: 13px;'>Pesquisar TCCs</a>";
							break;
						
						default:
							header("Location: index.php?des=true");	
							break;
					}										
				}

			?>													

			<a href="sobre.php" class="w3-bar-item w3-button w3-right w3-hide-small" style="color: #fff; height: 50px; padding-top: 13px;">Sobre</a>	

			<a href="contato.php" class="w3-bar-item w3-button w3-right w3-hide-small" style="color: #fff; height: 50px; padding-top: 13px;">Contato</a>	

			<a href="index.php" class="w3-bar-item w3-button w3-right w3-hide-small" style="color: #fff; height: 50px; padding-top: 13px;  margin-left: 20px;">Inicio</a>

		</div>


		<!-- //////////////////////////////////////////////// COMEÇO MODAL LOGIN //////////////////////////////////////////////// -->
		<div id="login" class="w3-modal w3-animate-opacity">

		    <div class="w3-modal-content w3-card-4" style="width: 500px;">

		      <header class="w3-container w3-center" style="background-color: #A90E10; color: white;"> 

		        <span onclick="document.getElementById('login').style.display='none'" 
		        class="w3-button w3-display-topright">&times;</span>

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

                	<label><input class="w3-check" type="checkbox" name="saveLogin" id="saveLogin" <?php if(isset($_COOKIE["saveLogin"])) echo $_COOKIE['saveLogin'];?> >&nbsp;&nbsp;Lembrar meus dados</label> <br><br>            

            	</div>
                              
                </form>

		      </div>

		      <footer class="w3-container" style="background-color: #A90E10; color: white;">&nbsp</footer>

		    </div>

		  </div>

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
					echo "<script>alert('Login efetuado com sucesso! Redirecionando...');</script>";
					$usuario = explode("*", $usuario);

					$_SESSION['nome'] = $usuario[0];
					$_SESSION['senha'] = $usuario[1];
					$_SESSION['codigoUsu'] = $usuario[2];
					$_SESSION['tipoUsu'] = $usuario[3];

					$_SESSION['logado'] = true;

					header("Refresh: 0");				
				}

			}	       		       
	    ?>

	</div>
	<!-- //////////////////////////////////////////////// FIM MODAL LOGIN //////////////////////////////////////////////// -->

	<div class="w3-hide-large w3-hide-medium w3-bar" style="background-color: #262626; font-family: 'Verdana',sans-serif; height: 50px; position: relative; z-index: 100;">

		<a href="index.php" class="w3-bar-item w3-button" style="color: #7F7F7F; height: 50px; padding-top: 8px;"><img src="images/logobtcc.png" 
				style="height: 30px; width: 60px;" /></a>		

		<a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" style="height: 50px; padding-top: 13px; color: white;" onclick="myFunction()">&#9776;</a>

	</div>


	<div id="demo" class="w3-bar-block w3-hide w3-hide-large w3-hide-medium w3-animate-opacity" style="background-color: #262626; font-family: 'Verdana',sans-serif; height: 50px; position: relative; z-index: 100;">

		<a href="index.php" class="w3-bar-item w3-button" style="color: white; background-color: #000000;">Inicio</a>

		<a href="sobre.php" class="w3-bar-item w3-button" style="color: #7F7F7F;">Sobre</a>

		<a href="contato.php" class="w3-bar-item w3-button" style="color: #7F7F7F;">Contato</a>

		<a href="loginSmall.php" class="w3-bar-item w3-button" style="color: #7F7F7F;">Logar</a>

	</div>

	<script>
		function myFunction() {
		    var x = document.getElementById("demo");
		    if (x.className.indexOf("w3-show") == -1) {
		        x.className += " w3-show";
		    } else { 
		        x.className = x.className.replace(" w3-show", "");
		    }
		}
	</script>
	<!-- //////////////////////////////////////////////// FIM NAVBAR //////////////////////////////////////////////// -->

	<br />


	<!-- ////////// IFRAME REGRAS -->

<div class="w3-container w3-center w3-light-gray">
   <br><h1 class="w3-animate-top">ABNT</h1>
   <br />
   <a href="https://www.dropbox.com/s/ed6a4ix1lle23kd/Regras.pdf?dl=0" target="_blank" ><button class="w3-theme-btcc w3-button w3-round-xlarge w3-card" style="width:20%">Baixar</button></a><br /> 
<br /> 
   
</div>







</body>

</html>