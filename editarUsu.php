﻿<?php
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
      $valores[0]  = $_SESSION['id'];
      $valores[1]  = htmlspecialchars($_REQUEST['sltClassificacao']);
      $valores[2]  = htmlspecialchars($_REQUEST['txtCpf']); 
      $valores[3]  = htmlspecialchars($_REQUEST['txtRm']);
      $valores[4]  = htmlspecialchars($_REQUEST['txtEmail']); 
      $valores[5]  = htmlspecialchars($_REQUEST['txtUltimoNome']); 
      $valores[6]  = htmlspecialchars($_REQUEST['txtPrimeiroNome']); 
      $valores[7]  = htmlspecialchars($_REQUEST['txtTelefone']);
      $valores[8]  = htmlspecialchars($_REQUEST['sltCurso']);      
      $valores[9]  = htmlspecialchars($_REQUEST['sltModulo']);      
      $valores[10]  = htmlspecialchars($_REQUEST['rdbPeriodo']);
      $valores[11] = htmlspecialchars($_REQUEST['txtLogin']);
      $valores[12] = htmlspecialchars($_REQUEST['txtSenha']);
      $valores[13] = htmlspecialchars($_REQUEST['txtConfirmacao']);            

      if($valores[12] == $valores[13]){

        $banco->editar("usu", $valores);  

      }else{

        echo "<script>
        alert('Senhas não coicidem!');
        window.location='editarUsu.php?id=".$valores[0]."&edit=1';
        </script>";

      }

    }

    if((!isset($_GET['edit']))||(!isset($_GET['id']))){
      $tipoPadrao     = "selected";
      $tipoAluno      = " ";
      $tipoProfessor  = " ";
      $tipoAdmin      = " ";

      $cpf            = "value='NAO ESPECIFICADO'";
      $rm             = "value='NAO ESPECIFICADO'";
      $email          = "value='NAO ESPECIFICADO'";
      $lastname       = "value='NAO ESPECIFICADO'";
      $firstname      = "value='NAO ESPECIFICADO'";
      $telefone       = "value='NAO ESPECIFICADO'";

      $cursoPadrao    = "selected";
      $curso1         = " ";
      $curso2         = " ";
      $curso3         = " ";
      $curso4         = " ";
      $curso5         = " ";

      $moduloPadrao    = "selected";
      $modulo1         = " ";
      $modulo2         = " ";
      $modulo3         = " ";
      $modulo4         = " ";

      $periodoIntegral   = " ";
      $periodoNoite      = " ";
      $periodoProf       = " ";

      $login             = "value='NAO ESPECIFICADO'";
      $senha             = "value='NAO ESPECIFICADO'";  
    }else{

      if(isset($_GET['edit'])){
        if($_GET['edit'] == "1"){
          $edit = " ";
          $senhaText = "type='text'";
        }else{
          $edit = "disabled";
          $senhaText = "type='password'";
        }
      }else{
        $edit = "disabled";
        $senhaText = "type='password'";
      }

      if(isset($_GET['exc'])){
        if($_GET['exc']){

          $banco->excluir("usu", $_GET['id']);
          
        }
      }

    }    

  $tipoPadrao     = "selected";
  $tipoAluno      = " ";
  $tipoProfessor  = " ";
  $tipoAdmin      = " ";

  $cpf            = "value=''";
  $rm             = "value=''";
  $email          = "value=''";
  $lastname       = "value=''";
  $firstname      = "value=''";
  $telefone       = "value=''";

  $cursoPadrao    = "selected";
  $curso1         = " ";
  $curso2         = " ";
  $curso3         = " ";
  $curso4         = " ";
  $curso5         = " ";

  $moduloPadrao    = "selected";
  $modulo1         = " ";
  $modulo2         = " ";
  $modulo3         = " ";
  $modulo4         = " ";

  $periodoIntegral   = " ";
  $periodoNoite      = " ";
  $periodoProf       = " ";

  $login             = "value=''";
  $senha             = "value=''";  

  if(isset($_GET['id'])){

    $_SESSION['id'] = $_GET['id'];    

    $usuario = explode("/", $banco->buscaUsuario($_SESSION['id']));    
    
    if($usuario[0] != "0"){
        switch ($usuario[0]) {
          case 'ALUNO':
            $tipoPadrao     = " ";
            $tipoAluno      = "selected";
            $tipoProfessor  = " ";
            $tipoAdmin      = " ";
            break;

          case 'PROFESSOR':
            $tipoPadrao     = " ";
            $tipoAluno      = " ";
            $tipoProfessor  = "selected";
            $tipoAdmin      = " ";
            break;

          case 'ADMIN':
            $tipoPadrao     = " ";
            $tipoAluno      = " ";
            $tipoProfessor  = " ";
            $tipoAdmin      = "selected";
            break;
          
          default:
            $tipoPadrao     = "selected";
            $tipoAluno      = " ";
            $tipoProfessor  = " ";
            $tipoAdmin      = " ";
            break;
        }

        $cpf            = "value='".$usuario[1]."'";
        $rm             = "value='".$usuario[2]."'";
        $email          = "value='".$usuario[3]."'";
        $lastname       = "value='".utf8_encode($usuario[4])."'";
        $firstname      = "value='".utf8_encode($usuario[5])."'";
        $telefone       = "value='".$usuario[6]."'";

        switch ($usuario[7]) {
          case 'CURSO 1':
            $cursoPadrao    = " ";
            $curso1         = "selected";
            $curso2         = " ";
            $curso3         = " ";
            $curso4         = " ";
            $curso5         = " ";
            break;

          case 'CURSO 2':
            $cursoPadrao    = " ";
            $curso1         = " ";
            $curso2         = "selected";
            $curso3         = " ";
            $curso4         = " ";
            $curso5         = " ";
            break;

          case 'CURSO 3':
            $cursoPadrao    = " ";
            $curso1         = " ";
            $curso2         = " ";
            $curso3         = "selected";
            $curso4         = " ";
            $curso5         = " ";
            break;

          case 'CURSO 4':
            $cursoPadrao    = " ";
            $curso1         = " ";
            $curso2         = " ";
            $curso3         = " ";
            $curso4         = "selected";
            $curso5         = " ";
            break;

          case 'CURSO 5':
            $cursoPadrao    = " ";
            $curso1         = " ";
            $curso2         = " ";
            $curso3         = " ";
            $curso4         = " ";
            $curso5         = "selected";
            break;
          
          default:
            $cursoPadrao    = "selected";
            $curso1         = " ";
            $curso2         = " ";
            $curso3         = " ";
            $curso4         = " ";
            $curso5         = " ";
            break;
        }

        switch ($usuario[8]) {
          case '1 MODULO':
            $moduloPadrao    = " ";
            $modulo1         = "selected";
            $modulo2         = " ";
            $modulo3         = " ";
            $modulo4         = " ";
            $modulo5         = " ";
            break;

          case '2 MODULO':
            $moduloPadrao    = " ";
            $modulo1         = " ";
            $modulo2         = "selected";
            $modulo3         = " ";
            $modulo4         = " ";
            $modulo5         = " ";
            break;

          case '3 MODULO':
            $moduloPadrao    = " ";
            $modulo1         = " ";
            $modulo2         = " ";
            $modulo3         = "selected";
            $modulo4         = " ";
            $modulo5         = " ";
            break;

          case '4 MODULO':
            $moduloPadrao    = " ";
            $modulo1         = " ";
            $modulo2         = " ";
            $modulo3         = " ";
            $modulo4         = "selected";
            $modulo5         = " ";
            break;

          case '0':
            $moduloPadrao    = " ";
            $modulo1         = " ";
            $modulo2         = " ";
            $modulo3         = " ";
            $modulo4         = " ";
            $modulo5         = "selected";
            break;
          
          default:
            $moduloPadrao    = "selected";
            $modulo1         = " ";
            $modulo2         = " ";
            $modulo3         = " ";
            $modulo4         = " ";
            $modulo5         = " ";
            break;
        }

        switch ($usuario[9]) {
          case 'INTEGRAL':
            $periodoIntegral   = "checked";
            $periodoNoite      = " ";
            $periodoProf       = " ";
            break;

          case 'NOITE':
            $periodoIntegral   = " ";
            $periodoNoite      = "checked";
            $periodoProf       = " ";
            break;

          case '0':
            $periodoIntegral   = " ";
            $periodoNoite      = " ";
            $periodoProf       = "checked";
            break;
          
          default:
            $periodoIntegral   = " ";
            $periodoNoite      = " ";
            $periodoProf       = " ";
            break;
        }

        $login = "value='".$usuario[10]."'";
        $senha = "value='".$usuario[11]."'";
      
      }

    }    

?>
<!DOCTYPE html>

<html>
<title>Editar Usuário</title>

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
       $("#usu").validate({
       // Define as regras
       rules:{
         txtPrimeiroNome:{
         // nome será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, maxlength: 40
         },
         txtUltimoNome:{
         // sobrenome será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, maxlength: 80
         },
         txtEmail:{
         // email será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, email: true
         },
         txtCpf:{
         // cpf será obrigatorio (required) 
              required: true
         },
         txtRm:{
         // rm será obrigatorio (required) e terá tamanho minimo (maxLength)
              required: true, maxlength: 5
         },
         txtLogin:{
         // login será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, minlength: 4
         },
         txtSenha:{
         // senha será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, minlength: 6
         },
         txtConfirmacao:{
         // senha será obrigatorio (required) e terá tamanho minimo (minLength)
              required: true, confimacao: true
         }

  },
  
    // Define as mensagens de erro para cada regra
    messages:{
       txtPrimeiroNome:{
          required: "Digite o seu nome",
          
       },
       txtUltimoNome:{
          required: "Digite o seu sobrenome",
          
       },
        txtEmail:{
          required: "Digite o seu e-mail para contato",
            email: "Digite um e-mail válido"
          
       },
       txtCpf:{
          required: "Digite o seu CPF",
          
       },
       txtRm:{
          required: "Digite o seu RM",
          
       },
       txtLogin:{
          required: "Digite o seu login",
          
       },
       txtSenha:{
          required: "Digite o seu senha",
        
       },
       txtConfirmacao:{
          required: "Digite sua senha novamente",
        
       },

       
    }
  });
});


</script>

<!-- /////////////////////////////////////  MASCARA   //////////////////////////////////////////////////////////////-->
<script type="text/javascript" src="js/mascara.js"></script>



<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<body>

<!-- /////////////////////////////////////    Side Bar   //////////////////////////////////////////////////////////////-->

<div class="w3-sidebar w3-light-gray w3-bar-block w3-card w3-animate-left w3-mobile" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button w3-small w3-theme-btcc" onclick="w3_close()">Fechar</button>
  
  <a href="index.php"><img src="images/logobtcc.png" class="w3-center" style="width:100%;"></a>

  <a href="admin.php" class="w3-bar-item w3-button"><b>Home</b></a>
  <a href="cadastrarTcc.php" class="w3-bar-item w3-button">Cadastrar TCC</a>
  <a href="cadastrarUsu.php" class="w3-bar-item w3-button w3-gray">Cadastrar Usuário</a>
  <a href="pesquisa.php" class="w3-bar-item w3-button">Pesquisa</a>  
  <a href="index.php" class="w3-bar-item w3-button">Voltar</a>
  <a href="index.php?des=true" class="w3-bar-item w3-button">Deslogar</a>

</div>

<div id="main">

<div class="w3-theme-d5 w3-card">
  <button id="openNav" class="w3-button w3-xlarge w3-theme-d5" onclick="w3_open()">&#9776;</button>
</div>

<div class="w3-container w3-center w3-light-gray">
   <br><h1 class="w3-animate-top">EDITAR USUARIO</h1><br>
</div>


<!-- /////////////////////////////////////    Formulario    //////////////////////////////////////////////////////////////-->

<div class="w3-responsive">
<div class="w3-container">


  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" id="usu" class="w3-container w3-animate-left">
<br />
<br />

<!-- /////////////////////////////////////    nome    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="w3-large fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtPrimeiroNome" name="txtPrimeiroNome" type="text" placeholder="Nome" <?php echo  $firstname; ?> <?php echo  $edit; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////    sobrenome    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="w3-large fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtUltimoNome" name="txtUltimoNome" type="text" placeholder="Sobrenome" <?php echo  $lastname; ?> <?php echo  $edit; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////   email   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="w3-large fa fa-envelope-o"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtEmail" name="txtEmail" type="text" placeholder="Email" <?php echo  $email; ?> <?php echo  $edit; ?> >
    </div>
</div>

<!-- /////////////////////////////////////    celular   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="w3-large fa fa-phone"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtTelefone" name="txtTelefone" type="text" placeholder="Celular" <?php echo  $telefone; ?> <?php echo  $edit; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////    cpf    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-credit-card"></span></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtCpf" name="txtCpf" type="text" placeholder="CPF" <?php echo  $cpf; ?> <?php echo  $edit; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////    rm    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-credit-card"></span></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtRm" name="txtRm" type="text" placeholder="RM" maxlength="5" onkeyup="somenteNumeros(this);" <?php echo  $rm; ?> <?php echo  $edit; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////    select Modulo   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-asterisk"></span></div>
    <div class="w3-rest">

       <select class="w3-select w3-border" name="sltModulo" id="sltModulo"  required <?php echo $edit; ?> />
       <option value="0" disabled <?php echo  $moduloPadrao; ?> >Selecione seu modúlo</option>
       <option value="1 MODULO" <?php echo  $modulo1; ?> >1 MODULO</option>
       <option value="2 MODULO" <?php echo  $modulo2; ?> >2 MODULO</option>
       <option value="3 MODULO" <?php echo  $modulo3; ?> >3 MODULO</option>
       <option value="4 MODULO" <?php echo  $modulo4; ?> >4 MODULO</option>
       <option value="0" <?php echo  $modulo5; ?> >NENHUM</option>
       </select>
</div>
</div>

<!-- /////////////////////////////////////    select Curso   //////////////////////////////////////////////////////////////-->


<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-education"></span></div>
    <div class="w3-rest">

     <select class="w3-select w3-border" name="sltCurso" id="sltCurso" <?php echo  $edit; ?> required />
       <option value="0" disabled selected>Selecione seu Curso</option>
        <?php             
          $banco->buscaSelect("3");
        ?>
       
       </select>
</div>
</div>

<!-- /////////////////////////////////////  select Classificação    //////////////////////////////////////////////////////////////-->


<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-ok"></span></div>
    <div class="w3-rest">

    <select class="w3-select w3-border" name="sltClassificacao" id="sltClassificacao" <?php echo  $edit; ?> required />
       <option value="0" disabled selected>Selecione sua Classificação</option>

      <?php             
        $banco->buscaSelect("2");
      ?>

    </select>

</div>
</div>

<!-- /////////////////////////////////////   radio buttom Periodo    //////////////////////////////////////////////////////////////-->


<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><span class="glyphicon glyphicon-time"></span></div>
    <div class="w3-rest">

    
    <input class="w3-radio" name="rdbPeriodo" type="radio"  id="rdbPeriodo" value="INTEGRAL" autocomplete="off" <?php echo  $periodoIntegral; ?> <?php echo  $edit; ?> /> Integral
    <input class="w3-radio" name="rdbPeriodo" type="radio"  id="rdbPeriodo" value="NOITE" autocomplete="off" <?php echo  $periodoNoite; ?> <?php echo  $edit; ?> /> Noite
    <input class="w3-radio" name="rdbPeriodo" type="radio"  id="rdbPeriodo" value="0" autocomplete="off" <?php echo  $periodoProf; ?> <?php echo  $edit; ?> /> Professor/Admin   

  </div>
</div>

<!-- /////////////////////////////////////    Login    //////////////////////////////////////////////////////////////-->


<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtLogin" name="txtLogin" type="text" placeholder="Login" <?php echo  $login; ?> <?php echo  $edit; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////    senha   //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-lock"></i></div>     
    <div class="w3-rest">
      <input class="w3-input w3-border" id="txtSenha" name="txtSenha" <?php echo  $senhaText; ?> placeholder="Senha" <?php echo  $senha; ?> <?php echo  $edit; ?> required />
    </div>
</div>

<!-- /////////////////////////////////////    Confirmação    //////////////////////////////////////////////////////////////-->

<div class="w3-row w3-section">
  <div class="w3-col" style="width:30px"><i class="glyphicon glyphicon-ok-sign"></i></div>      
    <div class="w3-rest">
      <input class="w3-input w3-border" name="txtConfirmacao" id="txtConfirmacao" <?php echo  $senhaText; ?> placeholder="Confirme sua senha" <?php echo  $edit; ?> required />
    </div>
</div>



<!-- /////////////////////////////////////    botoes    //////////////////////////////////////////////////////////////-->


       <br /> <p>

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
  echo "<p class='w3-center' ><a href='editarUsu.php?id=".$_SESSION['id']."&edit=1' ><button class='w3-button w3-center w3-red w3-round-xlarge w3-card' style='width:50%;'>Editar</button></a></p>
  <p class='w3-center' ><a href='pesquisa.php' ><button class='w3-button w3-center w3-black w3-round-xlarge w3-card' style='width:50%;'>Voltar</button></a></p>";
  }
}else{
  echo "<p class='w3-center' ><a href='pesquisa.php' ><button class='w3-button w3-center w3-black w3-round-xlarge w3-card' style='width:50%;'>Voltar</button></a></p>";
  
}


?>

<br><br><br>


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
    window.location = 'editarUsu.php?id='+id+'&edit=0&exc=1';
  }
}
</script>

</body>
</html>