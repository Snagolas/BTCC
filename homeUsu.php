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

    $_SESSION['tipo'] = "0";
    $_SESSION['campo'] = " ";

?>
<!DOCTYPE html>
<html>
<title>Pesquisar</title>

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
  <a href="pesquisarUsuario.php" class="w3-bar-item w3-button">Pesquisar</a>
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
   <br><h1 class="w3-animate-top">Pesquisar</h1><br>
</div>

<!--////////////////////////////////////  select pesquisar ///////////////////////////////////////////////////// -->


<div class="w3-responsive">
<div class="w3-container">

    <div class="w3-row">      
      <div class="w3-col m12">
        <form class="w3-container w3-animate-left" align="justify" id="pesquisaTcc" name="pesquisaTcc" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
          

  <div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-list-alt"></span></div>
    <div class="w3-rest">
          <label class="w3-left"><b>Tipo de pesquisa:</b></label>
          <select class="w3-select w3-border" name="sltTipo" id="sltTipo" >
          <option value="0" disabled selected>Selecione o tipo da pesquisa</option>          
          <option value="1">Por Código TCC</option>
          <option value="2">Por Titulo TCC</option>
          <option value="3">Por Coleção TCC</option>          
          <option value="4">Todos os TCCs</option>
          </select><br><br>
</div>
</div>


  <div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-search"></span></div>
    <div class="w3-rest">
          <label class="w3-center"><b>Pesquisa:</b></label> <input class="w3-input w3-border" type="text" name="txtPesquisa" id="txtPesquisa" placeholder="Digite o que deseja pesquisar"/>
          <br><br>
          

   </div>
   </div>   


   <div class="w3-container w3-center">
<input type="submit" name="btnPesquisar" value= "Pesquisar" class="w3-theme-cinza w3-button w3-round-xlarge w3-card" style="width:50%;"></p>

</div>    
<br/>
<br/>

<?php                                                                              
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // PEGA O VALOR DOS INPUTS
      if(isset($_REQUEST['sltTipo'])){
        $_SESSION['tipo'] = htmlspecialchars($_REQUEST['sltTipo']); 
      }else{
        $_SESSION['tipo'] = "0";            
      }
      $_SESSION['campo'] = htmlspecialchars($_REQUEST['txtPesquisa']);                      
  }
?>

<div class="w3-container w3-center">
          
          <h3 class="w3-center  w3-gray"><em>RESULTADOS</em></h3><br>
</div>

          <iframe src="iframes/resultadoPesquisaTcc.php" height="500px" width="100%" MARGINWIDTH="0" style="border: none;"></iframe>

          <br><br><br><br>
        </form>        
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