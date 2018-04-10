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

    if (isset($_GET['res'])) {

      if($_GET['res']){

        // PEGA O VALOR DOS INPUTS    
        $valores[0] = $_SESSION['codigoUsu'];       
        $valores[1] = $_SESSION['id'];

        $banco->cadastrar("res", $valores);  

      }            

    }


    if(!isset($_GET['id'])){     
      $codigo = "NÃO ESPECIFICADO";
      $palavraC1 = "NÃO ESPECIFICADO";
      $palavraC2 = "NÃO ESPECIFICADO";
      $condicao = "NÃO ESPECIFICADO";          
      $disponibilidade = "NÃO ESPECIFICADO";
      $titulo = "NÃO ESPECIFICADO";
      $sinopse = "NÃO ESPECIFICADO";
    }else{

      $_SESSION['id'] = $_GET['id'];
      
        $codigo = " ";
        $palavraC1 = " ";
        $palavraC2 = " ";
        $condicao = " ";          
        $disponibilidade = " ";
        $titulo = " ";
        $sinopse = " ";

        if(isset($_GET['id'])){

        $tcc = explode("/", $banco->buscaTcc($_SESSION['id']));

        $codigo =           $tcc[0];
        $palavraC1 =        $tcc[1];      
        $palavraC2 =        $tcc[2];
        $condicao =         $tcc[3];
        $disponibilidade =  $tcc[4];                            
        $titulo =           $tcc[5];
        $sinopse =          $tcc[6];              
      }

          

    }    

?>
<!DOCTYPE html>
<html>
<title>Reserva TCC</title>

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
   <br><h1 class="w3-animate-top">Pagina do TCC</h1><br>
</div>

<div class="w3-row">

  <div class="w3-col m2">&nbsp;</div>

  <div class="w3-col m8 w3-round-xlarge w3-card" style="margin-top: 25px; margin-bottom: 25px;">

    <!-- //////////////////////////// TITULO ////////////////////////////// -->

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m8 w3-light-gray w3-round-large w3-card w3-center w3-theme-cinza" style="margin-top: 35px; margin-bottom: 35px;">

        <h3><?php echo $titulo; ?></h3>

      </div>

      <div class="w3-col m2">&nbsp;</div>

    </div>

    <!-- //////////////////////////// PALAVRA CHAVE 1 ////////////////////////////// -->

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5>Código:</h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5><?php echo $codigo; ?></h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

    </div>

    <!-- //////////////////////////// PALAVRA CHAVE 1 ////////////////////////////// -->

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5>Palavra chave 1:</h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5><?php echo $palavraC1; ?></h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

    </div>

    <!-- //////////////////////////// PALAVRA CHAVE 2 ////////////////////////////// -->

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5>Palavra chave 2:</h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5><?php echo $palavraC2; ?></h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

    </div>

    <!-- //////////////////////////// CONDICAO ////////////////////////////// -->

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5>Condição:</h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5><?php echo $condicao; ?></h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

    </div>

    <!-- //////////////////////////// DISPONIBILIDADE ////////////////////////////// -->

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5>Disponibilidade:</h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m3 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px;">

        <h5><?php if($disponibilidade == "1") echo "DISPONÍVEL"; else echo "INDISPONÍVEL (!)"; ?></h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>

    </div>

    <!-- //////////////////////////// SINOPSE ////////////////////////////// -->

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m8 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 10px;">

        <h5>Sinopse:</h5>

      </div>

      <div class="w3-col m2">&nbsp;</div>      

    </div>

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m8 w3-light-gray w3-round-xlarge w3-card w3-center w3-theme-cinza" style="margin-bottom: 25px; padding: 10px;">

         <?php echo $sinopse; ?>

      </div>

      <div class="w3-col m2">&nbsp;</div>      

    </div>

    <!-- ///////////////////////////////// TERMINO ///////////////////////////// -->

    <!-- ///////////////////////////////// BOTAO   ///////////////////////////// -->    

    <div class="w3-row">

      <div class="w3-col m2">&nbsp;</div>

      <div class="w3-col m8 w3-center" style="margin-bottom: 25px;"">

        <?php

          if($disponibilidade == "1"){
            echo "<button style='width: 100%;' onclick='reservar(".$_SESSION['id'].")' type='submit' class='w3-button w3-round-xlarge w3-card w3-theme-btcc'>Reservar</button>";
          }else{
            echo "<div style='width:100%; padding:10px;' class='w3-hoverable w3-round-xlarge w3-card w3-theme-btcc'>INDISPONÍVEL</div>";
          }

        ?>

      </div>

      <div class="w3-col m2">&nbsp;</div>

    </div>


  </div>

  <div class="w3-col m2">&nbsp;</div>

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

function reservar(id){
  if(confirm("Tem certeza que deseja reservar este TCC?")){
    window.location = 'pagTCC.php?id='+id+'&res=1';
  }
}
</script>

</body>
</html>