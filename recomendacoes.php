<?php
session_start();
include("filme_random_teste.php");
$filme_random = $movieidAAA;
error_reporting(E_ALL ^ E_WARNING); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="barra.css">
    <title>Document</title>
</head> 
<body style="background-color: whitesmoke">
<div class="topnav">
  <a href="index.php">Pagina inicial</a>
  <a class="active" href="recomendacoes.php">Recomendaçoes</a>
  <a href="filmes/filmes2.php?filme=<?php echo $filme_random; ?>">Filme random</a>
  <!--<a href="login.php">--><?php if($_SESSION==null){echo "<a href='login.php'>login</a>";}else{echo "<a href='conta.php'>".$_SESSION['user_name']."</a>"; } ?>
  <?php if($_SESSION['admin']=="admin"){ echo "<a href='adm.php'>Conta admin</a>"; }?>
  <div class="search-container">
    <form action="filmes/procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<br><br>
<div style="width: 50%;background-color: lightgray;margin: auto;padding:2%;margin-bottom:2%;">
<?php 
include('recomendacoes_API.php');// FAZER A CENA DE METER ISTO NO INICIO E EM VEZ DO IF TODO QUE TENHO PRA VER O ID APENAS FAZER PUSH NO ARRAY ..[$i]

for($i = 0;$i<8;$i++){
    echo "<center><h3>filmes do genero ".$categories[$i]."</h3></center><br>";
    //echo "<table style='border: 1px solid black'><tr>";
    for($j=0;$j<3;$j++){
        echo "<a href='filmes/filmes2.php?filme=".$filmes_ids[$i][$j]."'><img src='".$filmes_imagens[$i][$j]."' width='225px' height='325' id='img1' class='imagens'></a>";
        if($j!=2){
          echo "&nbsp;&nbsp;";
        }
    }
    if($i !=7){
      echo "<br><br><br><br><br>";
    }
    //echo "</tr></table>";
}
?>
<div>
<!--
<footer style="background-color: black;width: 100%;color: white;padding: 0.5%;position: absolute;"><center><a href='https://ricadinho.eu/'><img src='eu real.jpg' width='2%' height="2%" style='float: left;'></a>Propriedade de RICADINHO&#8482;</center></footer>
-->
</body>
<html>