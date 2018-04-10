<!DOCTYPE html>
<?php
  session_start();    
?>
<html>
<title>iframeReservas</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
  <div class="w3-container" style="margin-top: 0px; padding: 0px;">    
    <table class="w3-table-all">
    <thead>
      <tr style="background-color: #941611; color: white;">
        <th>Título</th>
        <th>Código</th>
        <th>RM</th>
      </tr>
    </thead>
    <?php
      include "../bancoDados.class.php";

      $b = new bancoDadosBTCC("root", "", "localhost", "bd_btcc");            

      echo $b->buscaDevolucao();
    ?>
  </table>
    
  </div>

</div>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>