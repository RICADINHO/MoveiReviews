<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$userid = $_SESSION['id'];
$server_bd = "localhost";
$user_bd = "root";
$pass_bd = "sans1234";
$nome_bd = "projeto";

error_reporting(E_ALL ^ E_WARNING); 
if($_GET['pag']==null){
    $_GET['pag']=0;
}
$movieId = $_GET["filme"];
include("filme_random_teste.php");
include("filmes2_API.php");
$filme_random = $movieidAAA;
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
<style>
    body{
        background-color: whitesmoke;
    }
    button{
        cursor: pointer;
    }
@media screen and (max-width: 1160px) {
#trailer{
    height: 307px;
    width: 360;
}
#poster{
    height: 307px;
    width: 217px;
}
h2{
    font-size: 90%;
}
h1{
    font-size: 140%;
}
}
@media screen and (max-width: 940px) {
#trailer{
    height: 205px;
    width: 307px;
}
#poster{
    height: 205px;
    width: 145px;
}
h2{
    font-size: 70%;
}
h1{
    font-size: 130%;
}
}
@media screen and (max-width: 720px) {
#trailer{
    height: 102px;
    width: 180px;
}
#poster{
    height: 102px;
    width: 72px;
}
button{
    size: 10%;
}
table{
    font-size: 100%;
}
body{
    font-size: 70%;
}
/*h2{
    font-size: 50%;
}
h1{
    font-size: 100%;
}*/
}
#conteudo{
    margin: 5% 10%;
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

.close:hover,
.close:focus {
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
<body style="margin: 0">
<div class="topnav">
  <a href="/projeto/index.php">Pagina inicial</a>
  <a href="/projeto/recomendacoes.php">Recomendaçoes</a>
  <a href="filmes2.php?filme=<?php echo $filme_random; ?>">Filme random</a>
  <?php if($_SESSION==null){echo "<a href='/projeto/login.php'>login</a>";}else{echo "<a href='/projeto/conta.php'>".$_SESSION['user_name']."</a>"; } ?>
  <?php if($_SESSION['admin']=="admin"){ echo "<a href='/projeto/adm.php'>Conta admin</a>"; }?>
  <div class="search-container">
    <form action="procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit" id="teste??"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<div id="conteudo" style="background-color: lightgray;">

        <center><h1 style="padding: 3% 1%"><?php echo $filmes['title']; ?></h1></center>
        <h2 style="font-size:130%;padding: 1%"><?php echo $filmes['overview']; ?></h2><br><!--width='225' height='318'-->
        <div id="cenas_centro" style="width: 80%;margin: auto;"><center>
        <img src='<?php if(empty($imagens)){ echo "null.png"; }else{ echo $imagens[0];} ?>' alt='Movie Poster' id="poster" width='290px' height='410px'>
        <iframe id="trailer" controls src="https://youtube.com/embed/<?php if(empty($trailers_array)){ echo "x8QylSXfwYc"; }else{ echo $trailers_array[0]; }?>" width="60%" height="410px" frameborder ="0"></iframe>
        </center></div><br><br><br><br>
        <div id="detalhes" style="width: 80%;margin: auto;">
            <center><table style="border-collapse:collapse;width: 100%">
                <tr >
                    <td style="border-right: 2px dotted gray;"><b>Diretores</b></td>
                    <td><center><?php foreach($diretores as $d){ echo $d; } ?></center></td>
                </tr>
                <tr >
                    <td style="border-right: 2px dotted gray;border-top: 2px solid gray"><strong>Escritores</strong></td>
                    <td style="border-top: 2px solid gray;"><center><?php foreach($escritores as $d){ echo $d; } ?></center></td>
                </tr>
                <tr >
                    <td style="border-right: 2px dotted gray;border-top: 2px solid gray"><b>Atores de destaque<b></td>
                    <td style="border-top: 2px solid gray;"><center><?php foreach($destaque as $d){ echo $d; } ?></center></td>
                </tr>
                <tr >
                    <td style="border-right: 2px dotted gray;border-top: 2px solid gray"><b>Generos</b></td>
                    <td style="border-top: 2px solid gray;"><center><?php foreach($generos as $d){ echo $d; } ?></center></td>
                </tr>
                <tr >
                    <td style="border-right: 2px dotted gray;border-top: 2px solid gray"><b>Data de lançamento</b></td>
                    <td style="border-top: 2px solid gray;"><center><?php echo $filmes['release_date']; ?></center></td>
                </tr>
                <tr>
                    <td style="border-right: 2px dotted gray;border-top: 2px solid gray"><b>Score</b></td>
                    <td style="border-top: 2px solid gray;"><center><?php echo verscore($movieId); ?></center></td>
                </tr>
                <tr >
                    <td style="border-right: 2px dotted gray;border-top: 2px solid gray"><b>Duração</b></td>
                    <td style="border-top: 2px solid gray;"><center><?php echo (floor($movieDetails['runtime'] / 60).":".($movieDetails['runtime'] - floor($movieDetails['runtime']/60) * 60))."h"; ?></center></td>
                </tr>
                <tr>
                <td style="border-right: 2px dotted gray;border-top: 2px solid gray"><b>Estado</b></td>
                <td style="border-top: 2px solid gray;"><center><?php echo $movieDetails['status']; ?></center></td>
                </tr>
            </table></center>
        </div><br><br><br>





























<?php 
$conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);

if(isset($_POST['submit2'])){
  $titulo = $_POST['titulo'];
  $pontuacao_review = $_POST['rating'];
  $review = $_POST['review'];
  $email = $_SESSION['email'];

  $url = "http://localhost/projeto/API_BD.php?email=$email";
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $curl_response = curl_exec($curl);
  curl_close($curl);
  $data = json_decode($curl_response);

  foreach($data as $a){
    $id2 = $a->id;
  }


    $sql4 = "INSERT INTO review(id_filme,review,titulo,id_user,pontuacao,likes,dislikes,nome_filme) VALUE('$movieId','$review','$titulo','$id2','$pontuacao_review','0','0','".$filmes['title']."');";
    if ($conn->query($sql4) === TRUE) {
        echo "ta criado :)";
    }else{
        echo "Error: ";
    }
    $conn->close();
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
<!--                                                    REVIEWS                                                                                    -->
    <div id="reviews" style="border-top: 3px solid gray;margin: 5%;">
        <h2>Reviews:<span style="float: right"><button onclick="document.getElementById('id01').style.display='block'" style="width: auto;" id="botao_criar_review">Criar review</button></span></h2><br><br>
            <div id="id01" class="modal">
    
                <form class="modal-content animate" action="" method="POST">
                    <div id="sessao">
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

                        <input type="number" style="display: none;" name="rating" id="rating" value="0">

                        <label for="titulo"><b>Titulo</b></label><br>
                        <input type="text" placeholder="titulo" name="titulo" required><br>  

                        <label for="review"><b id="review_titulo">Review (letras restantes: 3000)</b></label><br>
                        <textarea placeholder="fazer review aqui, maximo de 3000 letras" name="review" id="review" cols="60" rows="10" maxlength="3000" required></textarea><br>
                        
                        <button type="submit" name="submit2">Fazer review</button>
                    </div>
                    </div>
                    <div id="sessao2" style="display: none">
                        <div class="imgcontainer">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                        </div><br><br><br>
                        <div class="container">
                                <a href="/projeto/login.php">Para fazer reviews tem de criar conta</a>
                        </div>
                    </div>
                </form>
            </div>
            
            <?php
            $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);

            $sql = "SELECT * FROM review WHERE id_filme=$movieId;";
            $result = $conn->query($sql);
            $reviews = array();
            $likes = array();
            $dislikes = array();
            $pontuacao = array();
            $nome = array();
            $resultados = array();
            $titulos = array();
            $idreviewss = array();
            $id_user_review = array();
            $cc = 0;//check para ver se tem reviews

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    array_push($reviews,$row['review']);
                    array_push($likes,$row['likes']);
                    array_push($dislikes,$row['dislikes']);
                    array_push($pontuacao,$row['pontuacao']);
                    array_push($titulos,$row['titulo']);
                    array_push($idreviewss,$row['id_review']);
                    $id = $row['id_user'];
                    $sql2 = "SELECT nome FROM user WHERE id=$id;";
                    $result2 = $conn->query($sql2);
                    $nome_user = $result2->fetch_assoc();
                    array_push($nome,$nome_user['nome']);
                    array_push($id_user_review,$id);
                }
                $reviews = array_reverse($reviews);
                $likes = array_reverse($likes);
                $dislikes = array_reverse($dislikes);
                $pontuacao = array_reverse($pontuacao);
                $nome = array_reverse($nome);
                $titulos = array_reverse($titulos);
                $idreviewss = array_reverse($idreviewss);
                $id_user_review = array_reverse($id_user_review);
                array_push($resultados,$nome);
                array_push($resultados,$titulos);
                array_push($resultados,$reviews);
                array_push($resultados,$likes);
                array_push($resultados,$dislikes);
                array_push($resultados,$pontuacao);
                array_push($resultados,$idreviewss);
                array_push($resultados,$id_user_review);
            }else{
                echo "<center>Não existem reviews para este filme, se o primeiro a criar</center><br><br>";
                $cc = 1;
            }
            $conn->close();
            //print_r($resultados);
            //echo "<br>".count($resultados[0]);
            //echo count($resultados[0]);
            if($cc == 0){
                for($i=$_GET['pag'];$i<5+$_GET['pag'];$i++){
                    //echo "--".(count($resultados[$i])==1)."--";
                    //echo $i;
                    if($i>=count($resultados[0])){
                        $i=$i+5;
                        //echo "parou";
                    }else{
                        $url = "http://localhost/projeto/API_BD.php?id_user=".$_SESSION['id']."&id_review=".$resultados[6][$i]."&estado=";
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $curl_response = curl_exec($curl);
                        curl_close($curl);
                        $data = json_decode($curl_response);
                        echo $resultados[6][$i];

                        $num_likes = $resultados[3][$i];
                        $num_dislikes = $resultados[4][$i];
                        $id_rev = $resultados[6][$i];
                        echo "<p style='padding: 0 5%'>";
                        echo "<strong>".$resultados[0][$i]."</strong>";
                        if($_SESSION['admin']=="admin"){ echo "&nbsp;&nbsp;--Id utilizador: ".$resultados[7][$i]." / Id review: ".$resultados[6][$i];}
                        echo "<span style='float: right;'>".pontuacao($resultados[5][$i])."</span><br><br><br>";
                        echo $resultados[1][$i]."<br><br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$resultados[2][$i]."";
                        echo "<table width='8%' style='border-collapse: collapse;'><tr style='border-collapse: collapse;'>";
                        if($data == null){//nenhum
                            echo "<td><form target='frame' method='POST'><button style='padding: 15%;background-color:gray;border-width:0;color: whitesmoke' id='butao_likes$i' value='$id_rev' onclick=meter_pont('like','cor_1$i','cor_2$i','num_likes$i','num_dislikes$i','butao_likes$i','butao_dislikes$i') type='submit' name='novo_like'><i id='cor_1$i' class='fa fa-thumbs-up' style='color: white;font-size: 130%'></i> <span id='num_likes$i'>$num_likes</span></button></form></td>";
                            echo "<td><form target='frame' method='POST'><button style='padding: 15%;background-color:gray;border-width:0;color: whitesmoke' id='butao_dislikes$i' value='$id_rev' onclick=meter_pont('dislike','cor_1$i','cor_2$i','num_likes$i','num_dislikes$i','butao_likes$i','butao_dislikes$i') type='submit' name='novo_dislike'><i id='cor_2$i' class='fa fa-thumbs-down' style='color: white;font-size: 130%'></i> <span id='num_dislikes$i'>$num_dislikes</span></button></form></td><br><br>";
                        }else if($data[0]->estado == "like"){//like
                            echo "<td><form target='frame' method='POST'><button style='padding: 15%;background-color:gray;border-width:0;color: whitesmoke' id='butao_likes$i' value='$id_rev' onclick=tira_pont('like','cor_1$i','cor_2$i','num_likes$i','num_dislikes$i','butao_likes$i','butao_dislikes$i') type='submit' name='tira_like'><i id='cor_1$i' class='fa fa-thumbs-up' style='color: blue;font-size: 130%'></i><span id='num_likes$i'>$num_likes</span></button></form></td>";
                            echo "<td><form target='frame' method='POST'><button style='padding: 15%;background-color:gray;border-width:0;color: whitesmoke' id='butao_dislikes$i' value='$id_rev' onclick=troca_pont('dislike','cor_1$i','cor_2$i','num_likes$i','num_dislikes$i','butao_likes$i','butao_dislikes$i') type='submit' name='troca_para_dislike'><i id='cor_2$i' class='fa fa-thumbs-down' style='color: white;font-size: 130%'></i><span id='num_dislikes$i'>$num_dislikes</span></button></form></td><br><br>";
                        }else{//dislike
                            echo "<td><form target='frame' method='POST'><button style='padding: 15%;background-color:gray;border-width:0;color: whitesmoke' id='butao_likes$i' value='$id_rev' onclick=troca_pont('like','cor_1$i','cor_2$i','num_likes$i','num_dislikes$i','butao_likes$i','butao_dislikes$i') type='submit' name='troca_para_like'><i id='cor_1$i' class='fa fa-thumbs-up' style='color: white;font-size: 130%'></i> <span id='num_likes$i'>$num_likes</span></button></form></td>";
                            echo "<td><form target='frame' method='POST'><button style='padding: 15%;background-color:gray;border-width:0;color: whitesmoke' id='butao_dislikes$i' value='$id_rev' onclick=tira_pont('dislike','cor_1$i','cor_2$i','num_likes$i','num_dislikes$i','butao_likes$i','butao_dislikes$i') type='submit' name='tira_dislike'><i id='cor_2$i' class='fa fa-thumbs-down' style='color: blue;font-size: 130%'></i> <span id='num_dislikes$i'>$num_dislikes</span></button></form></td><br><br>";
                        }
                        echo "</tr></table></p><br>";
                        echo "<hr style='width: 90%;height: 2px;background-color: gray;border-width:0'><br><br>";
                    }
                }
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
            if($cc != 1){
                if(count($resultados[0]) <=5){

                }else if($_GET['pag']-5 < 0){
                    $contapagina = $_GET['pag']+5;
                    echo "<a href='?filme=$movieId&pag=$contapagina'><button id='seguintee' style='float:right;padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-right: 5%'>Seguinte</button></a><br><br><br><br>";
                }else if($_GET['pag']+5 >= count($resultados[0])){
                    $contapagina = $_GET['pag']-5;
                    echo "<a href='?filme=$movieId&pag=$contapagina'><button id='anteriorr' style='padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-left: 5%'>Anterior</button></a><br><br><br>";
                }else{
                    $contapagina = $_GET['pag']+5;
                    echo "<a href='?filme=$movieId&pag=$contapagina'><button id='seguintee' style='float:right;padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-right: 5%'>Seguinte</button></a>";
                    $contapagina = $_GET['pag']-5;
                    echo "<a href='?filme=$movieId&pag=$contapagina'><button id='anteriorr' style='padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-left: 5%'>Anterior</button></a><br><br><br>";
                }
            }
            ?>
            
    </div>
<div>

<iframe name="frame" style="display: none"></iframe>
<?php

?>

<?php 
if(isset($_POST['novo_like'])){// 0 0 -> 1 0
    /*$id_review = $_POST['novo_like'];
    
    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "INSERT INTO relacao(iduser,idreview,estado) VALUES(".$_SESSION['id'].",$id_review,'like');";
    $conn->query($sql);
    $sql2 = "UPDATE review SET likes=likes+1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();*/
    echo "<script>console.log('entrei no novo_like php');</script>";
    $id_review = $_POST['novo_like'];
    
    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "DELETE FROM relacao WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
    $conn->query($sql);
    $sql2 = "UPDATE review SET likes=likes-1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();
}else if(isset($_POST['novo_dislike'])){// 0 0 -> 0 1
    /*$id_review = $_POST['novo_dislike'];

    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "INSERT INTO relacao(iduser,idreview,estado) VALUES(".$_SESSION['id'].",$id_review,'dislike');";
    $conn->query($sql);
    $sql2 = "UPDATE review SET dislikes=dislikes+1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();*/
    $id_review = $_POST['novo_dislike'];

    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "DELETE FROM relacao WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
    $conn->query($sql);
    $sql2 = "UPDATE review SET dislikes=dislikes-1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();
    echo "<script>console.log('entrei no novo_dislike php');</script>";
}else if(isset($_POST['tira_like'])){// 1 0 -> 0 0
    /*$id_review = $_POST['tira_like'];

    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "DELETE FROM relacao WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
    $conn->query($sql);
    $sql2 = "UPDATE review SET likes=likes-1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();*/
    $id_review = $_POST['tira_like'];

    $url = "http://localhost/projeto/API_BD.php?id_user=".$_SESSION['id']."&id_review=$id_review&estado=";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($curl_response);
    if($data==null){
    echo "<script>console.log('entrei no tira_LIKE php');</script>";
    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "INSERT INTO relacao(iduser,idreview,estado) VALUES(".$_SESSION['id'].",$id_review,'like');";
    $conn->query($sql);
    $sql2 = "UPDATE review SET likes=likes+1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();
    }else{
        echo "<script>console.log('entrei no tira_like troca_par_like php');</script>";
        $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
        $sql = "UPDATE relacao SET estado='like' WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
        $conn->query($sql);
        $sql2 = "UPDATE review SET likes=likes+1,dislikes=dislikes-1 WHERE id_review=$id_review";
        $conn->query($sql2);
        $conn->close();
    }
}else if(isset($_POST['tira_dislike'])){// 0 1 -> 0 0
    /*$id_review = $_POST['tira_dislike'];

    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "DELETE FROM relacao WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
    $conn->query($sql);
    $sql2 = "UPDATE review SET dislikes=dislikes-1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();*///checar meu API ver se ja tem relaçao, se ja tiver fazer o troca_para_dislike
    $id_review = $_POST['tira_dislike'];

    $url = "http://localhost/projeto/API_BD.php?id_user=".$_SESSION['id']."&id_review=$id_review&estado=";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($curl_response);
    if($data==null){
    echo "<script>console.log('entrei no tira_dislike php');</script>";
    
    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "INSERT INTO relacao(iduser,idreview,estado) VALUES(".$_SESSION['id'].",$id_review,'dislike');";
    $conn->query($sql);
    $sql2 = "UPDATE review SET dislikes=dislikes+1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();
    }else{
        echo "<script>console.log('entrei no tira_dislike troca_para_dislike php');</script>";
        $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
        $sql = "UPDATE relacao SET estado='dislike' WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
        $conn->query($sql);
        $sql2 = "UPDATE review SET dislikes=dislikes+1,likes=likes-1 WHERE id_review=$id_review";
        $conn->query($sql2);
        $conn->close();
    }
}else if(isset($_POST['troca_para_like'])){// 1 0 -> 0 1
    /*$id_review = $_POST['troca_para_like'];

    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "UPDATE relacao SET estado='like' WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
    $conn->query($sql);
    $sql2 = "UPDATE review SET likes=likes+1,dislikes=dislikes-1 WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();*/
    echo "<script>console.log('entrei no troca_para_like php');</script>";
    $id_review = $_POST['troca_para_like'];

    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "UPDATE relacao SET estado='like' WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
    $conn->query($sql);
    $sql2 = "UPDATE review SET likes=likes+1,dislikes=dislikes-1, WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();
}else if(isset($_POST['troca_para_dislike'])){// 0 1 -> 1 0
    echo "<script>console.log('entrei no troca_para_dislike php');</script>";
    $id_review = $_POST['troca_para_dislike'];
    
    $conn = new mysqli($server_bd,$user_bd,$pass_bd,$nome_bd);
    $sql = "UPDATE relacao SET estado='dislike' WHERE iduser=".$_SESSION['id']." AND idreview=$id_review";
    $conn->query($sql);
    $sql2 = "UPDATE review SET dislikes=(dislikes+1),likes=(likes-1), WHERE id_review=$id_review";
    $conn->query($sql2);
    $conn->close();
}
?>

























































<!--
<div>
<<footer style="background-color: black;width: 100%;color: white;padding: 0.5%;position: absolute;"><center><a href='https://ricadinho.eu/'><img src='eu real.jpg' width='2%' height="2%" style='float: left;'></a>Propriedade de RICADINHO&#8482;</center></footer>
</div>-->


</body>
<script>
    <?php 
    if($_SESSION['id']==null){
        echo "const buttons = document.getElementsByTagName('button');
for (const button of buttons) {
    if(button.id != 'teste??' && button.id != 'seguintee' && button.id != 'anteriorr'){
  button.disabled = true;
    }
}";
    }
    ?>
    function meter_pont(tipo,id1,id2,nl,nd,idbt1,idbt2){
        console.log("entrei meter_pont "+tipo);
        var num_l = document.getElementById(nl).textContent.toString();
        var num_d = document.getElementById(nd).textContent.toString();
        var b1 = document.getElementById(idbt1);
        var b2 = document.getElementById(idbt2);
        if(tipo == "like"){
            document.getElementById(id1).style.color = "blue";
            document.getElementById(nl).textContent = parseInt(num_l) + 1;
            b1.name = "tira_like";
            b2.name = "troca_para_dislike";
            b1.onclick = function() {tira_pont("like",id1,id2,nl,nd,idbt1,idbt2)};
            b2.onclick = function() {troca_pont("dislike",id1,id2,nl,nd,idbt1,idbt2)};
        }else{
            document.getElementById(id2).style.color = "blue";
            document.getElementById(nd).textContent = parseInt(num_d) + 1;
            b2.name = "tira_dislike";
            b1.name = "troca_para_like";
            b2.onclick = function() {tira_pont("dislike",id1,id2,nl,nd,idbt1,idbt2)};
            b1.onclick = function() {troca_pont("like",id1,id2,nl,nd,idbt1,idbt2)};
        }
    }
    function tira_pont(tipo,id1,id2,nl,nd,idbt1,idbt2){
        console.log("entrei tira_pont "+tipo);
        var num_l = document.getElementById(nl).textContent.toString();
        var num_d = document.getElementById(nd).textContent.toString();
        var b1 = document.getElementById(idbt1);
        var b2 = document.getElementById(idbt2);
        if(tipo == "like"){
            document.getElementById(id1).style.color = "white";
            document.getElementById(nl).textContent = parseInt(num_l) - 1;
            b1.name = "novo_like";
            b2.name = "novo_dislike";
            b1.onclick = function() {meter_pont("like",id1,id2,nl,nd,idbt1,idbt2)};
            b2.onclick = function() {meter_pont("dislike",id1,id2,nl,nd,idbt1,idbt2)};
        }else{
            document.getElementById(id2).style.color = "white";
            document.getElementById(nd).textContent = parseInt(num_d) - 1;
            b1.name = "novo_like";
            b2.name = "novo_dislike";
            b1.onclick = function() {meter_pont("like",id1,id2,nl,nd,idbt1,idbt2)};
            b2.onclick = function() {meter_pont("dislike",id1,id2,nl,nd,idbt1,idbt2)};
        }
    }
    function troca_pont(tipo,id1,id2,nl,nd,idbt1,idbt2){//troca para tipo
        console.log("entrei troca_pont "+tipo);
        var num_l = document.getElementById(nl).textContent.toString();
        var num_d = document.getElementById(nd).textContent.toString();
        var b1 = document.getElementById(idbt1);
        var b2 = document.getElementById(idbt2);
        if(tipo == "like"){//troca para like
            document.getElementById(id1).style.color = "blue";
            document.getElementById(id2).style.color = "white";
            document.getElementById(nl).textContent = parseInt(num_l) + 1;
            document.getElementById(nd).textContent = parseInt(num_d) - 1;
            b1.name = "tira_like";
            b2.name = "troca_para_dislike";
            b1.onclick = function() {tira_pont("like",id1,id2,nl,nd,idbt1,idbt2)};
            b2.onclick = function() {troca_pont("dislike",id1,id2,nl,nd,idbt1,idbt2)};

        }else{//para dislike
            /*document.getElementById(id1).style.color = "white";
            document.getElementById(id2).style.color = "blue";
            document.getElementById(nl).textContent = parseInt(num_l) - 1;
            document.getElementById(nd).textContent = parseInt(num_d) + 1;
            b1.name = "troca_para_like";
            b2.name = "tira_dislike";
            b1.onclick = function() {troca_pont("like",id1,id2,nl,nd,idbt1,idbt2)};
            b2.onclick = function() {tira_pont("dislike",id1,id2,nl,nd,idbt1,idbt2)};*/
            document.getElementById(id1).style.color = "white";
            document.getElementById(id2).style.color = "blue";
            document.getElementById(nl).textContent = parseInt(num_l) - 1;
            document.getElementById(nd).textContent = parseInt(num_d) + 1;
            b1.name = "troca_para_like";
            b2.name = "tira_dislike";
            b1.onclick = function() {troca_pont("like",id1,id2,nl,nd,idbt1,idbt2)};
            b2.onclick = function() {tira_pont("dislike",id1,id2,nl,nd,idbt1,idbt2)};
        }
    }
  const estrelas = document.getElementsByClassName("estrela");
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
//console.log(navigator.userAgentData.mobile);
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