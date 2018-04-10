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
<title>Cadastro TCC</title>

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




<!-- /////////////////////////////////////   VALIDAÇÃO    //////////////////////////////////////////////////////////////-->
<script type="text/javascript">
   $(document).ready( function() {
       $("#tcc").validate({
       // Define as regras
       rules:{
         Titulo:{
         // titulo será obrigatorio (required) e terá tamanho maximo (maxLength)
              required: true, maxlength: 40
         },
         Codigo:{
         // codigo será obrigatorio (required) 
              required: true
         },
         PalavraC1:{
         // Palavra 1 será obrigatorio (required) e terá tamanho maximo (maxLength)
              required: true, maxlength: 40
         },
         PalavraC2:{
         // Palavra 1 será obrigatorio (required) e terá tamanho maximo (maxLength)
              required: true, maxlength: 40
         },
      
  },
  
    // Define as mensagens de erro para cada regra
    messages:{
       Titulo:{
          required: "Digite o titulo do TCC",
          
       },
       Codigo:{
          required: "Digite o codigo do TCC",
          
       },
       PalavraC1:{
          required: "Digite a palavra chave",
          
       },
       PalavraC2:{
          required: "Digite a palavra chave",
          
       },
 

       
    }
  });
});


</script>



<body>

<!-- /////////////////////////////////////    Side Bar   //////////////////////////////////////////////////////////////-->

<div class="w3-sidebar w3-light-gray w3-bar-block w3-card w3-animate-left w3-mobile" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button w3-small w3-theme-btcc" onclick="w3_close()">Fechar</button>
  
  <a href="index.php"><img src="images/logobtcc.png" class="w3-center" style="width:100%;"></a>

  <a href="admin.php" class="w3-bar-item w3-button"><b>Home</b></a>
  <a href="cadastrarTcc.php" class="w3-bar-item w3-button w3-gray">Cadastrar TCC</a>
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
   <br><h1 class="w3-animate-top">Cadastro de TCC</h1><br>
</div>



<!-- /////////////////////////////////////    Formulario    //////////////////////////////////////////////////////////////-->

<div class="w3-responsive">
<div class="w3-container">


  <form id="tcc" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="w3-container w3-animate-left">

<!-- /////////////////////////////////////   Titulo    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-pencil"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="txtTitulo" id="txtTitulo" type="text" placeholder="Titulo">
    </div>
</div>

<!-- /////////////////////////////////////    select Coleção   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-book"></span></div>
    <div class="w3-rest">

       <select class="w3-select w3-border" name="sltColecao" id="sltColecao" >
       <option value="0" disabled selected>Selecione a Coleção</option>
       
        <?php             
          $banco->buscaSelect("1");
        ?>

       </select>
</div>
</div>

<!-- /////////////////////////////////////    Codigo    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-asterisk"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="txtCodigo" id="txtCodigo" type="text" placeholder="Codigo">
    </div>
</div>


<!-- /////////////////////////////////////   palavra chave 1 e 2     //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section ">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-font"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="txtPChave1" id="txtPChave1" type="text" placeholder="Palavra Chave">
      <input class="w3-input w3-border" name="txtPChave2" id="txtPChave2" type="text" placeholder="Palavra Chave">
    </div>
</div>


<!-- /////////////////////////////////////    select autor   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-user"></span></div>
    <div class="w3-rest">

    <select class="w3-select w3-border" name="sltAutor" id="sltAutor"  >
       <option value="0" disabled selected>Selecione o Autor</option>

        <?php             
          $banco->buscaSelect("4");
        ?>

    </select>

  </div></div>

<!-- /////////////////////////////////////   select condição    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-user"></span></div>
    <div class="w3-rest">

    <select class="w3-select w3-border" name="sltCondicao" id="sltCondicao"  >
       <option value="0" disabled selected>Selecione a Condição</option>
          <option value="MB">MB</option>
          <option value="B">B</option>
          <option value="R">R</option>
          <option value="DANIFICADO">DANIFICADO</option>
    </select>

  </div></div>

<!-- /////////////////////////////////////    SINOPSE   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-pencil"></i></div>
    <div class="w3-rest">
      <textarea class="w3-input w3-border" name="txtSinopse" id="txtSinopse" type="text" placeholder="Sinopse" style="height: 100px;"></textarea>
    </div>
</div>


<!-- /////////////////////////////////////    Botoes    //////////////////////////////////////////////////////////////-->

<div class="w3-container w3-center">
<input type="submit" name="btnCadastrar" value= "Cadastrar" class="w3-theme-cinza w3-button w3-round-xlarge w3-card" style="width:50%;"></p>
<input type="reset" name="btnLimpar" value= "Limpar" class="w3-border w3-theme-btcc w3-button w3-round-xlarge w3-card" style="width:50%;">
</div>



<br/>

<br/>

<br/>



<?php                                                                              
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // PEGA O VALOR DOS INPUTS
      $valores[0] = htmlspecialchars($_REQUEST['sltAutor']);  
      $valores[1] = htmlspecialchars($_REQUEST['sltColecao']);       
      $valores[2] = htmlspecialchars($_REQUEST['txtCodigo']);             
      $valores[3] = htmlspecialchars($_REQUEST['txtPChave1']);     
      $valores[4] = htmlspecialchars($_REQUEST['txtPChave2']);     
      $valores[5] = htmlspecialchars($_REQUEST['sltCondicao']);
      $valores[6] = htmlspecialchars($_REQUEST['txtTitulo']);               
      $valores[7] = htmlspecialchars($_REQUEST['txtSinopse']);               

      $banco->cadastrar("tcc", $valores);

  }
?>



  </form>
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