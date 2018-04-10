

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
            $valores[0] = $_SESSION['id']; //OPERRAAD
            $valores[1] = htmlspecialchars($_REQUEST['sltAutor']);  
            $valores[2] = htmlspecialchars($_REQUEST['sltColecao']);       
            $valores[3] = htmlspecialchars($_REQUEST['txtCodigo']);             
            $valores[4] = htmlspecialchars($_REQUEST['txtPChave1']);     
            $valores[5] = htmlspecialchars($_REQUEST['txtPChave2']);     
            $valores[6] = htmlspecialchars($_REQUEST['sltCondicao']);
            $valores[7] = htmlspecialchars($_REQUEST['sltDisponibilidade']); 
            $valores[8] = htmlspecialchars($_REQUEST['txtTitulo']); 
            $valores[9] = htmlspecialchars($_REQUEST['txtSinopse']);                

            $banco->editar("tcc", $valores);            

        }

    if((!isset($_GET['edit']))||(!isset($_GET['id']))){
      $edit = "disabled";

      $titulo = "value='NAO ESPECIFICADO'";
      $codigo = "value='NAO ESPECIFICADO'";
      $palavraC1 = "value='NAO ESPECIFICADO'";
      $palavraC2 = "value='NAO ESPECIFICADO'";
      $condicao1 = "selected";
      $condicao2 = " ";
      $condicao3 = " ";
      $condicao4 = " ";
      $condicao5 = " ";
      $disponibilidade1 = "selected";
      $disponibilidade2 = " ";
      $disponibilidade3 = " ";
      $sinopse = "NAO ESPECIFICADO";
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

          $banco->excluir("tcc", $_SESSION['id']);
          
        }
      }        

          $titulo = "value=''";
          $codigo = "value=''";
          $palavraC1 = "value=''";
          $palavraC2 = "value=''";
          $condicao1 = "selected";
          $condicao2 = " ";
          $condicao3 = " ";
          $condicao4 = " ";
          $condicao5 = " ";
          $disponibilidade1 = "selected";
          $disponibilidade2 = " ";
          $disponibilidade3 = " ";
          $sinopse = " ";

        if(isset($_GET['id'])){

        $tcc = explode("/", $banco->buscaTcc($_SESSION['id']));

        $codigo = "value='".$tcc[0]."'";
        $palavraC1 = "value='".$tcc[1]."'";      
        $palavraC2 = "value='".$tcc[2]."'";

        switch ($tcc[3]) {
                case 'MB':
                  $condicao1 = " ";
                  $condicao2 = "selected";
                  $condicao3 = " ";
                  $condicao4 = " ";
                  $condicao5 = " ";
                  break;

                case 'B':
                  $condicao1 = " ";
                  $condicao2 = " ";
                  $condicao3 = "selected";
                  $condicao4 = " ";
                  $condicao5 = " ";
                  break;

                case 'R':
                  $condicao1 = " ";
                  $condicao2 = " ";
                $condicao3 = " ";
                  $condicao4 = "selected";
                  $condicao5 = " ";
                  break;

                 case 'DANIFICADO':
                  $condicao1 = " ";
                  $condicao2 = " ";
                  $condicao3 = " ";
                  $condicao4 = " ";
                  $condicao5 = "selected";
                  break;
                
                default:
                  $condicao1 = "selected";
                  $condicao2 = " ";
                  $condicao3 = " ";
                  $condicao4 = " ";
                  $condicao5 = " ";
                  break;
              }

              switch ($tcc[4]) {
                case '1':
                  $disponibilidade1 = " ";
                  $disponibilidade2 = "selected";
                  $disponibilidade3 = " ";
                  break;

                case '0':
                  $disponibilidade1 = " ";
                  $disponibilidade2 = " ";
                  $disponibilidade3 = "selected";
                  break;
                
                default:
                  $disponibilidade1 = "selected";
                  $disponibilidade2 = " ";
                  $disponibilidade3 = " ";
                  break;
              }

              $titulo = "value='".$tcc[5]."'";

              $sinopse = $tcc[6];              
      }

          

    }    

?>
<!DOCTYPE html>
<html>
<title>EDITAR TCC</title>

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
   <br><h1 class="w3-animate-top">EDITAR TCC</h1><br>
</div>



<!-- /////////////////////////////////////    Formulario    //////////////////////////////////////////////////////////////-->

<div class="w3-responsive">
<div class="w3-container">


  <form id="tcc" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="w3-container w3-animate-left">

<!-- /////////////////////////////////////   Titulo    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-pencil"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="txtTitulo" id="txtTitulo" type="text" placeholder="Titulo" <?php echo $edit; ?> <?php echo $titulo; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////    select Coleção   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-book"></span></div>
    <div class="w3-rest">

       <select class="w3-select w3-border" name="sltColecao" id="sltColecao" required <?php echo $edit; ?> />
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
      <input class="w3-input w3-border" name="txtCodigo" id="txtCodigo" type="text" placeholder="Codigo" required <?php echo $edit; ?> <?php echo $codigo; ?> required />
    </div>
</div>


<!-- /////////////////////////////////////   palavra chave 1 e 2     //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section ">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-font"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" name="txtPChave1" id="txtPChave1" type="text" placeholder="Palavra Chave" <?php echo $edit; ?> <?php echo $palavraC1; ?> required />
      <input class="w3-input w3-border" name="txtPChave2" id="txtPChave2" type="text" placeholder="Palavra Chave" <?php echo $edit; ?> <?php echo $palavraC2; ?> required />
    </div>
</div>


<!-- /////////////////////////////////////    select autor   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-user"></span></div>
    <div class="w3-rest">

    <select class="w3-select w3-border" name="sltAutor" id="sltAutor" required <?php echo $edit; ?> />
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

    <select class="w3-select w3-border" name="sltCondicao" id="sltCondicao" required <?php echo $edit; ?> />
       <option value="0" disabled  <?php echo $condicao1; ?> >Selecione a Condição</option>
          <option value="MB" <?php echo $condicao2; ?> >MB</option>
          <option value="B"  <?php echo $condicao3; ?> >B</option>
          <option value="R"  <?php echo $condicao4; ?> >R</option>
          <option value="DANIFICADO" <?php echo $condicao5; ?> >DANIFICADO</option>
    </select>

  </div></div>


<!-- /////////////////////////////////////   select disponibilidade    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-ok"></span></div>
    <div class="w3-rest">

    <select class="w3-select w3-border" name="sltDisponibilidade" id="sltDisponibilidade" required <?php echo $edit; ?> />
       <option value="0" disabled <?php echo $disponibilidade1; ?> >Selecione a Disponibilidade</option>
          <option value="1" <?php echo $disponibilidade2; ?> >Disponivel</option>
          <option value="0" <?php echo $disponibilidade3; ?> >Indisponivel</option>          
    </select>

  </div></div>

  <!-- /////////////////////////////////////    SINOPSE   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-pencil"></i></div>
    <div class="w3-rest">
      <textarea class="w3-input w3-border" name="txtSinopse" id="txtSinopse" type="text" placeholder="Sinopse" <?php echo $edit; ?>  style="height: 100px;" required ><?php echo $sinopse; ?></textarea>
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
  echo "<p class='w3-center' ><a href='editarTcc.php?id=".$_SESSION['id']."&edit=1' ><button class='w3-button w3-center w3-red w3-round-xlarge w3-card' style='width:50%;'>Editar</button></a></p>
  <p class='w3-center' ><a href='pesquisa.php' ><button class='w3-button w3-center w3-black w3-round-xlarge w3-card' style='width:50%;'>Voltar</button></a></p>";
  }
}else{
  echo "<p class='w3-center' ><a href='pesquisa.php' ><button class='w3-button w3-center w3-black w3-round-xlarge w3-card' style='width:50%;'>Voltar</button></a></p>";
  
}


?>

<br><br><br>



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

function excluir(id) {  
  if(confirm("Tem certeza que deseja excluir o registro?")){
    window.location = 'editarTcc.php?id='+id+'&edit=0&exc=1';
  }
}
</script>

</body>
</html>