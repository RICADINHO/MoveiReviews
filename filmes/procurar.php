<?php
session_start();
error_reporting(E_ALL ^ E_WARNING); 
include("filme_random_teste.php");
$filme_random = $movieidAAA;
if($_GET['pag']==null){
  $_GET['pag'] = 1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<style>
    * {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: whitesmoke;
}
button{
  cursor: pointer;
}
.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 985px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
<body>

<div class="topnav">
  <a href="/projeto/index.php">Pagina inicial</a>
  <a href="/projeto/recomendacoes.php">Recomendaçoes</a>
  <a href="filmes2.php?filme=<?php echo $filme_random; ?>">Filme random</a>
  <?php if($_SESSION==null){echo "<a href='/projeto/login.php'>login</a>";}else{echo "<a href='/projeto/conta.php'>".$_SESSION['user_name']."</a>"; } ?>
  <?php if($_SESSION['admin']=="admin"){ echo "<a href='/projeto/adm.php'>Conta admin</a>"; }?>
  <div class="search-container">
    <form action="procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<br><br>
<div style="width: 70%;margin: auto;background-color: rgba(233,233,233,255)">
<h1 style="padding: 2% 25%">Filmes com "<?php $movieTitle = $_GET["filme"]; echo $movieTitle; ?>" no titulo</h1>
<br><br>
<?php
$apiKey = "976f9dd7e5b7a6ad8f7632a2d65fc8e9";
// Function to make an API request
function requestAPI($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
$titulo = array();
$imagem = array();
$descricao = array();
$ids = array();
// Search for the movie
$searchUrl = "https://api.themoviedb.org/3/search/movie?api_key=$apiKey&page=".$_GET['pag']."&query=" . urlencode($movieTitle);
$searchResponse = requestAPI($searchUrl);
$movies = json_decode($searchResponse, true);
//echo $searchUrl;


if (!empty($movies['results'])) {
    foreach($movies['results'] as $movie){
    
        
        $movieidd = $movie['id'];
        $movietitle = $movie['title'];
        array_push($ids,$movieidd);
        array_push($titulo, $movie['title']);
        $imagesUrl = "https://api.themoviedb.org/3/movie/$movieidd/images?api_key=$apiKey";
        $imagesResponse = requestAPI($imagesUrl);
        $imagesData = json_decode($imagesResponse, true);
    
        if (!empty($imagesData['posters'])) {
            $posters = $imagesData['posters'];

            foreach($posters as $poster) {
                $posterUrl = 'https://image.tmdb.org/t/p/original' . $poster['file_path'];
                array_push($imagem,$posterUrl);
                //echo "<a style='float: left' href='filmes2.php?filme=$movieidd'><img src='$posterUrl' alt='Movie Poster' style='width: 100px;heigth: 150px'></a><br>";
                break;
            }
        }else{
          array_push($imagem,"null.png");
        }
        array_push($descricao, $movie['overview']);
        //echo "<br><br><br>";
    }
} else {
    echo "<center>Não foram encontrados filmes com '$movieTitle' no titulo</center><br>";
}
?>
<table style="margin: 1%;border-spacing: 15px;">
  <tbody>
  <?php 
  for($i =0;$i<count($titulo);$i++){
    echo "<tr style='border-top: 2px solid black;border-color: gray'>";
      echo "<td>";
        echo "<center><a href='filmes2.php?filme=".$ids[$i]."'><img src='".$imagem[$i]."' alt='Movie Poster' style='width: 100px;heigth: 150px'></a></center>";
      echo "</td>";
      echo "<td style='border-top: 2px solid black;border-color: gray'>";
          echo $titulo[$i].":<br>";
          echo $descricao[$i];
          
      echo "</td>"; 
    echo "</tr>";
  }
  ?>
  </tbody>
</table>
<hr style='width: 95%;height: 3px;background-color: gray;border-width:0'>
<?php
if(count($movies['results'])<20 && $_GET['pag']==1){

}else if($_GET['pag']-1 <= 0){
    $contapagina = $_GET['pag']+1;
    echo "<a href='?filme=$movieTitle&pag=$contapagina'><button style='float:right;padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-right: 2.5%'>Seguinte</button></a>";
}else if(15 > count($movies['results'])){
  $contapagina = $_GET['pag']-1;
  echo "<a href='?filme=$movieTitle&pag=$contapagina'><button style=';padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-left: 2.5%'>Anterior</button></a>";
}else{
    $contapagina = $_GET['pag']+1;
    echo "<a href='?filme=$movieTitle&pag=$contapagina'><button style='float:right;padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-right: 2.5%'>Seguinte</button></a>";
    $contapagina = $_GET['pag']-1;
    echo "<a href='?filme=$movieTitle&pag=$contapagina'><button style='padding: 0.8%;background-color:gray;border-width:0;color: whitesmoke;margin-left: 2.5%'>Anterior</button></a>";
}
?>
<br><br><br><br>
</div><br><br>
<!--
<footer style='background-color: black;width: 100%;color: white;padding: 0.5%;position: absolute;'><center><a href='https://ricadinho.eu/'><img src='eu real.jpg' width='2%' height='2%' style='float: left;'></a>Propriedade de RICADINHO&#8482;</center></footer>
-->
</body>
</html>