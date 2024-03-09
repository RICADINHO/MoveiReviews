<?php session_start(); ?>
<?php 
error_reporting(E_ALL ^ E_WARNING); 
include("filme_random_teste.php");
$filme_random = $movieidAAA;
    $server_bd = "localhost";
    $user_bd = "root";
    $pass_bd = "sans1234";
    $nome_bd = "projeto";
    //$conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $review = array();
    $likes = array();
    $dislikes = array();
    $pontuacao = array();
    $idfilme = array();
    $titulos = array();
    $idreview = array();
    $resultados = array();
    $nome_filme = array();
    $url = "http://localhost/projeto/API_BD.php?id_user=".$_SESSION['id']."&review=";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($curl_response);
    //echo $data==null;
    //echo $data==null;
    if($data != null){
        foreach($data as $a){
            array_push($titulos,$a->titulo);
            array_push($review,$a->review);
            array_push($pontuacao,$a->pontuacao);
            array_push($likes,$a->likes);
            array_push($dislikes,$a->dislikes);
            array_push($idfilme,$a->id_filme);
            array_push($idreview,$a->id_review);
            array_push($nome_filme,$a->nome_filme);
        }
        array_push($resultados,$titulos);
        array_push($resultados,$review);
        array_push($resultados,$pontuacao);
        array_push($resultados,$likes);
        array_push($resultados,$dislikes);
        array_push($resultados,$idfilme);
        array_push($resultados,$idreview);
        array_push($resultados,$nome_filme);
    }else{
    }

    function mudar($iddd){
      $url = "http://localhost/projeto/API_BD.php?id_review=$iddd";
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $curl_response = curl_exec($curl);
      curl_close($curl);
      $data2 = json_decode($curl_response);
      //echo $data==null;
      //echo $data==null;
      foreach($data2 as $d2){
      return "branco();document.getElementById('titulo').value='".$d2->titulo."'; document.getElementById('review').value='".$d2->review."';document.getElementById('idd').value = '".$d2->id_review."';preto(".$d2->pontuacao."-1);";
      }
      /*$a = $ar[0][$oo];
      $aa = $ar[1][$oo];
      $aaa = $ar[2][$oo];
      $aaaa = $ar[6][$oo];
      $s ="branco();document.getElementById('titulo').value = '$a'; document.getElementById('review').value = '$aa';document.getElementById('idd').value = '$aaaa';preto($aaa-1);";
      return $s;*/
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="barra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>perfil admin</title>
</head>
<style>
   button{
    cursor: pointer;
  }
@media screen and (max-width: 860px) {
#trailer{
    height: 240px;
}
#poster{
    height: 240px;
    width: 170px;
}
h2{
    font-size: 90%;
}
h1{
    font-size: 140%;
}
}
#conteudo{
    margin: 10%;
}
/* Full-width input fields */
.modal-content input[type=text], .modal-content textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.modal span{
  cursor: pointer;
}

.modal-content textarea {
  resize: none;
}

/* Set a style for all buttons */
.modal-content button, #botao_criar_review {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

.modal-content button:hover, #botao_criar_review:hover {
  opacity: 0.8;
}



/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

.container {
  padding: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover, .close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
.estrela{
  display: inline-block;
  font-size: 30px;
  transition: color 0.2s;
  cursor: pointer;
}
</style>
<body>
<div class="topnav">
  <a href="index.php">Pagina inicial</a>
  <a href="recomendacoes.php">Recomendaçoes</a>
  <a href="filmes/filmes2.php?filme=<?php echo $filme_random; ?>">Filme random</a>
  <a href="conta.php"><?php echo $_SESSION['user_name']; ?></a>
  <?php if($_SESSION['admin']=="admin"){ echo "<a class='active' href='adm.php'>Conta admin</a>"; }?>
  <div class="search-container">
    <form action="filmes/procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
<br><br><br>
<div id="fundo_tudo" style="width: 80%;background-color: lightgray;margin: auto;padding: 1%;overflow: auto;margin-bottom: 2%"><br>
<center><span id="span_botao1"><button onclick="ver()" style="width: auto;background-color: crimson" id="botao_criar_review">Apagar review</button></span></center><br>
<div id="id01" class="modal">
  
      <form class="modal-content animate" action="" method="POST">
          <div id="sessao" style="display: none">
              <div class="imgcontainer">
                  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              </div>
              

              <div class="container">
                  <label for="uname"><b>Rating</b></label>
                  <table style="border: 1px solid black">
                    <tr style="border: 1px solid black">
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(0)" onmouseover="preto(0)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(1)" onmouseover="preto(1)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(2)" onmouseover="preto(2)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(3)" onmouseover="preto(3)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(4)" onmouseover="preto(4)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(5)" onmouseover="preto(5)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(6)" onmouseover="preto(6)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(7)" onmouseover="preto(7)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(8)" onmouseover="preto(8)" onmouseout="branco()">★</td>
                        <td style="border: 1px solid black" class="estrela" onclick="fogo(9)" onmouseover="preto(9)" onmouseout="branco()">★</td>
                      </tr>
                    </table><br>

                    <input type="number" style="display: none;" name="idd" id="idd" value="0">
                    <input type="number" style="display: none;" name="rating" id="rating" value="0">
                    <input type="number" style="display: none;" name="modo" id="modo" value="0">

                    <label for="titulo"><b>Titulo</b></label><br>
                    <input type="text" placeholder="titulo" name="titulo" required id="titulo"><br>  

                    <label for="review"><b id="review_titulo">Review (letras restantes: 3000)</b></label><br>
                    <textarea placeholder="fazer review aqui, maximo de 3000 letras" name="review" id="review" cols="60" rows="10" maxlength="3000" required></textarea><br>
                            
                    <button type="submit" name="submit2">Confirmar</button>
              </div>
          </div>

          <div id="sessao2" style="display: none;">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <h2>Qual review alterar?</h2>
                    <center><span style="color: crimson">&#9888;</span>Depois de alterar nao se pode voltar a traz!<span style="color: crimson">&#9888;</span></center><br><br><br>
                    <?php
                    for($ii=0;$ii<count($resultados[0]);$ii++){
                      echo "<span style='background-color: #04AA6D;color: white;' onclick='ver2($ii)'>Review ".$resultados[6][$ii]."</span><br>";
                    }
                    ?>   
              </div>
          </div>

          <div id="sessao3" style="display:none">
              <div class="imgcontainer">
                  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              </div>
              <div class="container">
                    <h2>Qual review apagar?</h2>
                    <center><span style="color: crimson">&#9888;</span>Depois de apagar nao se pode voltar a traz!<span style="color: crimson">&#9888;</span></center><br><br><br>
 
              </div>
          </div>

          <div id="sessao4" style="display:none">
              <div class="imgcontainer">
                  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              </div>
              <div class="container">
                    Escolha o id da review que quer apagar? <br><br><br><br><br>
                    <?php 
                    $url = "http://localhost/projeto/API_BD.php?ids_rev=";
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $curl_response = curl_exec($curl);
                    curl_close($curl);
                    $data = json_decode($curl_response);
                    //echo $data==null;
                    //echo $data==null;
                    if($data != null){
                      $ii = 0;
                        foreach($data as $a){
                          if(fmod($ii,6) == 0){
                            echo "<center>";
                          }
                          echo "<span style='background-color: crimson;color: white;padding: 1%;' onmouseover='this.style.opacity = 0.8' onmouseout='this.style.opacity = 1' onclick='ver2ap(".$a->id_review.")'>Id - ".$a->id_review."</span>&emsp;";
                          if(fmod($ii+1,6) == 0){
                            echo "<center><div style='line-height: 150%'><br></div>";
                          }
                            $ii++;
                        }
                        echo "<br><br>";
                      }
                    ?>
              </div>
          </div>

      </form>
  </div>
<?php 
  if(isset($_POST['submit2'])){
    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $idd = $_POST['idd'];
    $sql5 = "DELETE FROM review WHERE id_review=$idd;";
    $conn->query($sql5);
    $conn->close();
  }
?>

<?php //meter todas as reviews

$review = array();
$likes = array();
$dislikes = array();
$pontuacao = array();
$idfilme = array();
$titulos = array();
$idreview = array();
$resultados = array();
$nome_filme = array();
$url = "http://localhost/projeto/API_BD.php?ids_rev=";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
curl_close($curl);
$data = json_decode($curl_response);

if($data != null){
    foreach($data as $a){
        array_push($titulos,$a->titulo);
        array_push($review,$a->review);
        array_push($pontuacao,$a->pontuacao);
        array_push($likes,$a->likes);
        array_push($dislikes,$a->dislikes);
        array_push($idfilme,$a->id_filme);
        array_push($idreview,$a->id_review);
        array_push($nome_filme,$a->nome_filme);
    }
    array_push($resultados,$titulos);
    array_push($resultados,$review);
    array_push($resultados,$pontuacao);
    array_push($resultados,$likes);
    array_push($resultados,$dislikes);
    array_push($resultados,$idfilme);
    array_push($resultados,$idreview);
    array_push($resultados,$nome_filme);
    echo "<table style=''>";
    if(empty($resultados)){
      echo "n tens reviews";
    }else{
      for($i=0;$i<count($resultados[0]);$i++){
        echo "<tr>";
        echo "<td style='border-top: 2px solid black;max-height: 10000px;min-width: 1px;table-layout:auto;'><br><strong>Review com id ".$resultados[6][$i]."</strong>, feita no filme '".$resultados[7][$i]."' com ".$resultados[3][$i]." likes e ".$resultados[4][$i]." dislikes<br><br><br>".$resultados[0][$i]."<span style='float: right;'>".pontuacao($resultados[2][$i])."</span><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='padding: 0.8%'>".$resultados[1][$i]."</span><br><br></td>";
        echo "</tr>";
      }
    }
    echo "</table>"; 
}else{
  echo "nao existem reviews ainda";
}

function pontuacao($estrelas) {
  $r = "";
  for($i = 0;$i<10;$i++){
      if($i<$estrelas){
          $r =$r."★";
      }else{
          $r=$r."☆";
      }
  }
  return $r;
}
?>
</div>
</body>
<script>
  const estrelas = document.getElementsByClassName("estrela");
    function reset(){
      document.getElementById('id01').style.display='none';
      document.getElementById('sessao').style.display='none';
      document.getElementById('sessao2').style.display='none';
      document.getElementById('sessao3').style.display='none';
      document.getElementById('sessao4').style.display='none';
    }
    function ver(){
      reset();
      document.getElementById('id01').style.display='block';
      //document.getElementById('sessao').style.display='none';
      //document.getElementById('sessao2').style.display='none';
      //document.getElementById('sessao3').style.display='none';
      document.getElementById('sessao4').style.display='block';
      //document.getElementById("titulo").setAttribute =
    }
    function ver1(){
      reset();
      document.getElementById('id01').style.display='block';
      //document.getElementById('sessao4').style.display='none';
      document.getElementById('sessao2').style.display='block';
    }
    /*function ver2(num){
      reset();
      //document.getElementById('id01').style.display='none';
       // document.getElementById('sessao2').style.display='none';
        document.getElementById('id01').style.display='block';
        document.getElementById('sessao').style.display='block';
        <?php 
        /*//echo mudar($resultados,0); 
        for($j=0;$j<count($resultados[0]);$j++){
          echo "if(num == $j){ ".mudar($resultados,$j)." }";
        }
        for($i=0;$i<10;$i++){
          echo "estrelas[$i].onclick =function() {fogo($i)};estrelas[$i].onmouseover=function() {preto($i)};estrelas[$i].onmouseout=function() {branco()};";
        }*/
        ?>
        document.getElementById('titulo').removeAttribute("disabled"); 
        document.getElementById('review').removeAttribute("disabled"); 

    }*/
    function ver2ap(num){
      reset();
      document.getElementById('id01').style.display='block';
      //document.getElementById('sessao3').style.display='none';
      document.getElementById('sessao').style.display='block';
      document.getElementById('modo').value = '1';
      <?php  
        $url = "http://localhost/projeto/API_BD.php?ids_rev=";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($curl_response);
        foreach($data as $aa){
          echo "if(num == ".$aa->id_review."){ ".mudar($aa->id_review)." }";
        }
      ?>
      document.getElementById('titulo').setAttribute('disabled','true');
      document.getElementById('review').setAttribute('disabled','true');
      <?php 
      for($i=0;$i<10;$i++){
        echo "estrelas[$i].onclick = function() {};;estrelas[$i].onmouseover=function() {};;estrelas[$i].onmouseout=function() {};;";
      }
      ?>
    }
    function ver3(id){
      reset();
      document.getElementById('id01').style.display='block';
      //document.getElementById('modo').value = id;
      //document.getElementById('sessao4').style.display='none';
      document.getElementById('sessao3').style.display='block';
    }
  var f1 =document.getElementById("sessao");
  var f2 =document.getElementById("sessao2");
  var r =document.getElementById("rating");
  <?php 
  if(empty($_SESSION['user_name'])){
    echo "f1.style.display = 'none';";
    echo "f2.style.display = 'inline-block';";
  }
  ?>
  document.getElementById('review').onkeyup = function () {
  document.getElementById('review_titulo').innerHTML = "Review (letras restantes: " + (3000 - this.value.length)+")";
  };
var check = 0;

console.log(navigator.userAgentData.mobile);
  function preto(numero){
    check = 0;
      for (var i = 0; i <= numero; i++) {
        //estrelas[i].innerHTML = "★";
        estrelas[i].style.color = "gold";
      }
  }
  function branco(numero){
      if(check == 0){
        for (var i = 0; i < estrelas.length; i++) {
          //estrelas[i].innerHTML = "★";
          estrelas[i].style.color = "black";
        }
      }else{
        check = 1;
      }
  }
  function fogo(numero){
    for (var i = 0; i < estrelas.length; i++) {
          estrelas[i].style.color = "black";
        }
        for (var i = 0; i <= numero; i++) {
        estrelas[i].style.color = "gold";
        r.value = numero+1;
      }
      check = 1;
  }
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</html>