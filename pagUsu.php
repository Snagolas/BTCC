<?php
    session_start();

    if(isset($_SESSION['logado'])){
      if(!$_SESSION['logado']){
        header("Location: index.php"); 
      }      
    }else{
      header("Location: index.php");
    }    

    include "bancoDados.class.php";    

    $banco = new bancoDadosBTCC("root", "", "localhost", "bd_btcc");

    $tipo           = " ";      
    $cpf            = " ";
    $rm             = " ";
    $email          = " ";
    $lastname       = " ";
    $firstname      = " ";
    $telefone       = " ";
    $curso          = " ";      
    $modulo         = " ";     
    $periodo        = " ";

    if(!isset($_GET['id'])){     
      $tipo           = "NÃO ESPECIFICADO";      
      $cpf            = "NÃO ESPECIFICADO";
      $rm             = "NÃO ESPECIFICADO";
      $email          = "NÃO ESPECIFICADO";
      $lastname       = "NÃO ESPECIFICADO";
      $firstname      = "NÃO ESPECIFICADO";
      $telefone       = "NÃO ESPECIFICADO";
      $curso          = "NÃO ESPECIFICADO";      
      $modulo         = "NÃO ESPECIFICADO";     
      $periodo        = "NÃO ESPECIFICADO";      

      header("Location: index.php");
    }else{

      if($_GET['id'] != $_SESSION['codigoUsu']){

        $tipo           = "NÃO ESPECIFICADO";      
        $cpf            = "NÃO ESPECIFICADO";
        $rm             = "NÃO ESPECIFICADO";
        $email          = "NÃO ESPECIFICADO";
        $lastname       = "NÃO ESPECIFICADO";
        $firstname      = "NÃO ESPECIFICADO";
        $telefone       = "NÃO ESPECIFICADO";
        $curso          = "NÃO ESPECIFICADO";      
        $modulo         = "NÃO ESPECIFICADO";     
        $periodo        = "NÃO ESPECIFICADO";

        header("Location: index.php");

      }else{

        $usuario = explode("/", $banco->buscaUsuario($_SESSION['codigoUsu']));

        $tipo           = $usuario[0];
        $cpf            = $usuario[1];
        $rm             = $usuario[2];
        $email          = $usuario[3];
        $lastname       = $usuario[4];
        $firstname      = $usuario[5];
        $telefone       = $usuario[6];
        $curso          = utf8_encode($usuario[7]);      
        $modulo         = $usuario[8];     
        $periodo        = $usuario[9]; 


      }      

    }    

?>
<!DOCTYPE html>
<html>
<title>Dados</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

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

  
<link type="text/css" rel="stylesheet" href="js/jquery-ui.css" />

<!-- /////////////////////////////////////    icons    //////////////////////////////////////////////////////////////-->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





<body>

<!-- /////////////////////////////////////    Side Bar   //////////////////////////////////////////////////////////////-->

<div class="w3-sidebar w3-light-gray w3-bar-block w3-card w3-animate-left w3-mobile" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button w3-small" style="background-color: #941611; color: white;" onclick="w3_close()"><b>Fechar</b></button>
  
  <a href="index.php"><img src="images/logoBTCC.png" class="w3-center" style="width:100%;"></a>
  <br />
  <br />
  <a href="index.php" class="w3-bar-item w3-button"><b>Inicio</b></a>
  <a href="homeUsu.php" class="w3-bar-item w3-button">Pesquisar</a>
  <a href="regrasabnt.php" class="w3-bar-item w3-button">Regras ABNT</a>
  <a href="sugestoes.php" class="w3-bar-item w3-button">Sugestões</a>
  <a href="temaspadrao.php" class="w3-bar-item w3-button">Padrões ETEC</a>
  <a href="index.php" class="w3-bar-item w3-button">Voltar</a>
  <a href="index.php?des=true" class="w3-bar-item w3-button">Deslogar</a>
 
  
</div>

<div id="main">

<div class="w3-theme-d5 w3-card">
  <button id="openNav" class="w3-button w3-xlarge w3-theme-d5" onclick="w3_open()">&#9776;</button>
</div>

<div class="w3-container w3-center w3-light-gray">
   <br><h1 class="w3-animate-top">Dados do Usuário</h1><br>
</div>
<br />
<br />
<br />

<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<table id="customers">
 
<div class="w3-container w3-center w3-theme-cinza">
   <br><h3 class="w3-animate-top"><b><?php echo utf8_encode($firstname); ?></b></h3><br>
</div>
    <td>Nome</td>
    <td><h5> <?php echo utf8_encode($firstname); ?> </h5></td> 
  </tr>
  <tr>
    <td>Sobrenome</td>
    <td><h5> <?php echo utf8_encode($lastname); ?> </h5></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><h5> <?php echo $email; ?> </h5></td>
  </tr>
  <tr>
    <td>Celular</td>
    <td><h5> <?php echo $telefone; ?> </h5></td>
  </tr>
  <tr>
    <td>CPF</td>
    <td><h5><?php echo $cpf; ?></h5></td>
  </tr>
  <tr>
    <td>RM</td>
    <td><h5><?php echo $rm; ?></h5></td>
  </tr>
  <tr>
    <td>Módulo</td>
    <td><h5><?php echo $modulo; ?></h5></td>
  </tr>
  <tr>
    <td>Curso</td>
    <td><h5><?php echo $curso; ?></h5></td>
  </tr>
  <tr>
    <td>Classificação</td>
    <td><h5><?php echo $tipo; ?></h5></td>
  </tr>
  <tr>
    <td>Período</td>
    <td><h5><?php echo $periodo; ?></h5></td>
  </tr>
</table>
  </div>

  <div class="w3-col m2">&nbsp;</div>

</div>

</div>

<br><br><br>


<!-- /////////////////////////////////////    Funçoes SideBar   //////////////////////////////////////////////////////////////-->

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "20%";
  document.getElementById("mySidebar").style.width = "20%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}

function reservar(id){
  if(confirm("Tem certeza que deseja reservar este TCC?")){
    window.location = 'pagTCC.php?id='+id+'&res=1';
  }
}
</script>

</body>
</html>