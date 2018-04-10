<?php
    session_start();

    if(isset($_SESSION['logado'])){
      if(!$_SESSION['logado']){
        header("Location: index.php"); 
      }else{
        if(!($_SESSION['tipoUsu'] == "3")) {
          header("Location: index.php");
          
        }
      } 
    }else{
      header("Location: index.php");
    }    

    include "bancoDados.class.php";    

    $banco = new bancoDadosBTCC("root", "", "localhost", "bd_btcc");    

?>
<!DOCTYPE html>

<html>
<head>
<title>Home</title>

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


</head>

<body>

<!-- /////////////////////////////////////    Side Bar   //////////////////////////////////////////////////////////////-->

<div class="w3-sidebar w3-light-gray w3-bar-block w3-card w3-animate-left w3-mobile" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button w3-small" style="background-color: #941611; color: white;" onclick="w3_close()"><b>Fechar</b></button>
  
  <a href="index.php"><img src="images/logobtcc.png" class="w3-center" style="width:100%;"></a>

  <a href="admin.php" class="w3-bar-item w3-button w3-gray"><b>Home</b></a>
  <a href="cadastrarTcc.php" class="w3-bar-item w3-button">Cadastrar TCC</a>
  <a href="cadastrarUsu.php" class="w3-bar-item w3-button">Cadastrar Usuário</a>
  <a href="pesquisa.php" class="w3-bar-item w3-button">Pesquisa</a>  
  <a href="index.php" class="w3-bar-item w3-button">Voltar</a>
  <a href="index.php?des=true" class="w3-bar-item w3-button">Deslogar</a>
  
</div>

<div id="main">

<div class="w3-theme-d5 w3-card">
  <button id="openNav" class="w3-button w3-xlarge w3-theme-d5" onclick="w3_open()">&#9776;</button>
</div>

<div class="w3-container w3-center w3-light-gray">
   <br><h1 class="w3-animate-top">Bem Vindo, <?php echo $_SESSION['nome']; ?></h1><br>
</div>




<br>

<!--//////////////////////////////////////////Reservas e Devoluções  ///////////////////////////////////////////////////////////-->

<div class="w3-responsive">
 <div class="w3-container">
    <div class="w3-row">

      <div class="w3-col m1 w3-center">&nbsp</div>

       <div class="w3-col m4 w3-center w3-card-4">
        <div class="w3-row">
          <label class="w3-col m5 w3-xlarge w3-theme-d15">Reservas:</label>
            <input class="w3-col m5 w3-input w3-border w3-hover-light-gray" type="text" placeholder="Pesquisar"> 
          <button class="w3-col m2 w3-btn w3-border w3-theme-d15" type="submit">OK</button>
        </div>

         <div class="w3-card-4" style="height: 500px;">
            <iframe src="iframes/reservas.php" height="500px" width="100%" MARGINWIDTH="0" style="border: none;"></iframe>
          </div>

       </div>

       <div class="w3-col m2 w3-center" style="height: 500px;">&nbsp</div>

      <div class="w3-col m4 w3- w3-center w3-card-4">
        <div class="w3-row w3-theme-d15">
          <label class="w3-col m5 w3-xlarge ">A devolver:</label>
          <label class="w3-col m5 w3-xlarge"><?php date_default_timezone_set('America/Sao_Paulo'); echo date("d/m/Y"); ?></label>          
        </div>          
           
          <div class="w3-card-4" style="height: 500px;">
            <iframe src="iframes/devolucoes.php" height="500px" width="100%" MARGINWIDTH="0" style="border: none;"></iframe>
          </div>

       </div>

       <div class="w3-col m1 w3-center">&nbsp</div>

    </div>
  </div>
</div>



</div>
</div>




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
</script>

</body>
</html>