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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // PEGA O VALOR DOS INPUTS      
      $valores[0] = $_SESSION['id'];
      $valores[1] = htmlspecialchars($_REQUEST['sltSugestao']); 
      $valores[2] = $_REQUEST['txtSugestao']; 

      $banco->editar("sg", $valores);            

    }

if((!isset($_GET['edit']))||(!isset($_GET['id']))){
      $edit = "disabled";      

      $sugestao = "value='NÃO ESPECIFICADO'";
    }else{

      $_SESSION['id'] = $_GET['id'];

      if(isset($_GET['edit'])){
        if($_GET['edit'] == "1"){
          $edit = " ";          
        }else{
          $edit = "disabled";          
        }
      }else{
        $edit = "disabled";        
      }

      if(isset($_GET['exc'])){
        if($_GET['exc']){

          $banco->excluir("sg", $_SESSION['id']);
          
        }
      }                  
          
        $sugestao = "value=''";

        if(isset($_GET['id'])){

        $sugestoes = explode("/", $banco->buscaSg($_SESSION['id']));        

        $sugestao = utf8_encode("value='".$sugestoes[0]."'");

        }

          

    }    

?>

<!DOCTYPE html>
<html>
<title>Editar Sugestao</title>

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
   <br><h1 class="w3-animate-top">Editar Sugestão</h1><br>
</div>

<!--////////////////////////////////////  select Cursos ///////////////////////////////////////////////////// -->


<div class="w3-responsive">
<div class="w3-container">

    <div class="w3-row">      
      <div class="w3-col m12">
        <form class="w3-container w3-animate-left" align="justify"  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
          

  <div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-list-alt"></span></div>
    <div class="w3-rest">
          <label class="w3-left"><b>Cursos:</b></label>
          <select class="w3-select w3-border" name="sltSugestao" id="sltSugestao" <?php echo $edit; ?> required />
          <option value="0" disabled selected>Selecione o curso</option>
          <?php             
            $banco->buscaSelect("3");
          ?>
          </select><br><br>
</div>
</div>


  <div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-text-size"></span></div>
    <div class="w3-rest">
          <label class="w3-center"><b>Tema:</b></label> <input class="w3-input w3-border" type="text" name="txtSugestao" id="txtSugestao" placeholder="Digite a sugestão de tema" <?php echo $edit; ?> <?php echo $sugestao; ?> required />
          <br><br>
          

   </div>
   </div>   


   <!-- /////////////////////////////////////    Botoes    //////////////////////////////////////////////////////////////-->

<?php 

if(isset($_GET['edit'])){
    if($_GET['edit']){
    echo "<div class='w3-container w3-center'>
    <p><input type='submit' name='btnEditar' value= 'Editar' class='w3-green w3-button w3-round-xlarge w3-card' style='width:50%;'></p>
    </div>   
    ";
  }
}

?>


<br/>



</form>

<?php

if(isset($_GET['edit'])){
    if($_GET['edit']){
    echo "<p class='w3-center' ><button class='w3-button w3-center w3-theme-cinza w3-round-xlarge w3-card' onclick='excluir(".$_SESSION['id'].")' style='width:30%;'>Excluir</button></p>
    <p class='w3-center' ><a href='pesquisa.php' ><button class='w3-button w3-center w3-red w3-round-xlarge w3-card' style='width:30%;'>Voltar</button></a></p>";
  }
}

if(isset($_GET['edit'])){
  if(!$_GET['edit']){
  echo "<p class='w3-center' ><a href='editarSug.php?id=".$_SESSION['id']."&edit=1' ><button class='w3-button w3-center w3-red w3-round-xlarge w3-card' style='width:50%;'>Editar</button></a></p>
  <p class='w3-center' ><a href='pesquisa.php' ><button class='w3-button w3-center w3-black w3-round-xlarge w3-card' style='width:50%;'>Voltar</button></a></p>";
  }
}else{
  echo "<p class='w3-center' ><a href='pesquisa.php' ><button class='w3-button w3-center w3-black w3-round-xlarge w3-card' style='width:50%;'>Voltar</button></a></p>";
  
}


?>

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

function excluir(id) {  
  if(confirm("Tem certeza que deseja excluir o registro?")){
    window.location = 'editarSug.php?id='+id+'&edit=0&exc=1';
  }
}
</script>

</body>
</html>