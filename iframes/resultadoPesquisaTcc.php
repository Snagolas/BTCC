<!DOCTYPE html>
<?php
    session_start();

    if(isset($_SESSION['logado'])){
      if(!$_SESSION['logado']){
        header("Location: index.php");       
      } 
    }else{
      header("Location: index.php");
    }    

    include "../bancoDados.class.php";    

    $banco = new bancoDadosBTCC("root", "", "localhost", "bd_btcc");    

?>
<html>
<title>iframeReservas</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">


<!-- /////////////////////////////////////    W3.css    //////////////////////////////////////////////////////////////-->
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" href="../css/w3-theme-red.css">


<!-- /////////////////////////////////////    ICONS Google    //////////////////////////////////////////////////////////////-->
<link rel="stylesheet" href="../css/icon.css">

<!-- /////////////////////////////////////    Bootstrap   //////////////////////////////////////////////////////////////-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- /////////////////////////////////////    Js    //////////////////////////////////////////////////////////////-->

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script language="JavaScript" src="../js/jquery.js" type="text/javascript"></script>
  <script language="JavaScript" src="../js/jquery.validate.js" type="text/javascript"></script>

  
<link type="text/css" rel="stylesheet" href="../js/jquery-ui.css" />

<!-- /////////////////////////////////////    icons    //////////////////////////////////////////////////////////////-->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    


<body style="overflow-x: scroll;">	 


  <div class="w3-container" style="margin-top: 0px; padding: 0px;">        
    <?php                

      echo $banco->exibirTccs($_SESSION['tipo'], $_SESSION['campo']);

    ?>
    
  </div>

</body>
</html>