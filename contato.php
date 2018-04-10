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

<head>

  <title>BTCC</title>

  <!-- METAS -->

  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- /////////////////////////////////////    W3.css    //////////////////////////////////////////////////////////////-->
<link rel="stylesheet" type="text/css" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme-red.css">

<!-- /////////////////////////////////////    ICONS Google    //////////////////////////////////////////////////////////////-->
<link rel="stylesheet" href="css/icon.css">

<!-- /////////////////////////////////////    Bootstrap   //////////////////////////////////////////////////////////////-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- /////////////////////////////////////    Js    //////////////////////////////////////////////////////////////-->

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script language="JavaScript" src="js/jquery.js" type="text/javascript"></script>
  <script language="JavaScript" src="js/jquery.validate.js" type="text/javascript"></script>
   <script language="JavaScript" src="js/mascara.js" type="text/javascript"></script>

  
<link type="text/css" rel="stylesheet" href="js/jquery-ui.css" />

<!-- /////////////////////////////////////    icons    //////////////////////////////////////////////////////////////-->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<!-- /////////////////////////////////////   VALIDAÇÃO    //////////////////////////////////////////////////////////////-->




<script type="text/javascript">
   $(document).ready( function() {
       $("#contato").validate({
       // Define as regras
       rules:{
         txtNome:{
         // nome será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, maxlength: 40
         },
         txtEmail:{
         // email será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, email: true
         }
  },
  
    // Define as mensagens de erro para cada regra
    messages:{
       txtNome:{
          required: "Digite o seu nome",
          
       },
        txtEmail:{
          required: "Digite o seu e-mail para contato",
            email: "Digite um e-mail válido"
          
       }

       
    }
  });
});


</script>





<!-- /////////////////////////////////////    Function so numero   //////////////////////////////////////////////////////////////-->
<script>
    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
          campo.value = "";
        }
    }

</script>



  <!-- CHAMADAS DE CSS/JAVASCRIPT -->

  
  <script src="js/w3.js"></script>

  <style>
    .mySlides {display:none}
    .w3-left, .w3-right, .w3-badge {cursor:pointer}
    .w3-badge {height:20px;width:20px;padding:0}
  </style>  

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
          $usuario = explode("*", $usuario);

          $_SESSION['nome'] = $usuario[0];
          $_SESSION['senha'] = $usuario[1];
          $_SESSION['codigoUsu'] = $usuario[2];
          $_SESSION['tipoUsu'] = $usuario[3];

          $_SESSION['logado'] = true;
          
          echo "<script>
          alert('Login efetuado com sucesso! Redirecionando...');
          window.location='index.php';
          </script>";      

                
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


  <br />
  <br />
  <!-- //////////////////////////////////////////////// FIM NAVBAR //////////////////////////////////////////////// -->



     <!--///////////////////////////Form contato/////////////////////////////////////////////////// -->

     <div class="w3-container w3-center w3-light-gray">
   <br><h1 class="w3-animate-top">Contato</h1><br>
</div>

<br />

<div class="w3-container ">

<form method="post" action="#" id="contato" class="w3-container w3-animate-left" enctype="multipart/form-data">

  <!-- /////////////////////////////////////    nome    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="w3-large fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtNome" name="txtNome" type="text" placeholder="Nome" required />
    </div>
</div>


<!-- /////////////////////////////////////   email   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="w3-large fa fa-envelope-o"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtEmail" name="txtEmail" type="text" placeholder="Email" required />
    </div>
</div>

<!-- /////////////////////////////////////    celular   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="w3-large fa fa-phone"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtTelefone" name="txtTelefone" type="text" placeholder="Celular" required />
    </div>
</div>


<!-- /////////////////////////////////////    SINOPSE   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-pencil"></i></div>
    <div class="w3-rest">
      <textarea class="w3-input w3-border" name="txtMensagem" id="txtMensagem" type="text" placeholder="Digite sua mensagem" style="height: 100px;"></textarea>
    </div>
</div>


<!-- /////////////////////////////////////    botoes    //////////////////////////////////////////////////////////////-->


<div class="w3-container w3-center">
<input type="submit" name="btnCadastrar" value= "Cadastrar" class="w3-theme-btcc w3-button w3-round-xlarge w3-card" style="width:50%;"></p>
</div>


<br />
<br />
<br />
<br />







</div>

</form>

<!--////////////////////////////////////////////rodape/////////////////////////////////////////////////////////////// -->

<div class="w3-container w3-center" style="background-color: #4a555c; color: white; margin-top: 70px";>     
          <p><font size="5">Etec Philadelpho Gouvêa Netto</font></p>
          <p><font size="3">São José do Rio Preto</font></p>
          <p><font size="2">Copyright &copy; W3.CSS and W3.JS from W3Schools 2017</font></p>
    </div>


</body>

</html>