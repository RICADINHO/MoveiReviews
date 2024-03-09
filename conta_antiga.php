<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="barra.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
<div class="topnav">
  <a href="index.php">Pagina inicial</a>
  <a href="filmes/procurar2.php">pesquiar?</a>
  <a href="filmes/topfilmes.php">top filmes</a>
  <a href="filmes/filme_random.php">filme random</a>
  <a href="contacto.php">Contactos</a>
  <a class="active" href="login.php">log out</a>
  <div class="search-container">
    <form action="filmes/procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
    user
    <?php echo $_SESSION['user_name']; echo " email: ".$_SESSION['email']; ?><br><br><br><br>
    <div>
      <h1>Reviews: </h1>
      <?php /*
        echo "<table>";
        if(empty($resultados)){
          echo "n tens reviews";
        }else{
          for($i=0;$i<count($resultados[0]);$i++){
            echo "<tr>";
            echo "<td style='border: 1px solid black;'>".$resultados[0][$i]."<span style='float: right;'>".$resultados[2][$i]."</span><br><br>".$resultados[1][$i]."<br><br><button>apagar</button><button>editar</button></td>";
            echo "</tr>";
          }
        }
        echo "</table>"; */
        $url = "http://localhost/projeto/API_BD.php?id_user=".$_SESSION['id']."&review=";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($curl_response);
        if($data == "N/A"){
            echo $data;
        }else{
            foreach($data as $a){
                echo "id filme: ".$a->id_filme."<br>";
                echo "Titulo: ".$a->titulo."<br>";
                echo "review: ".$a->review."<br>";
                echo "pontuacao: ".$a->pontuacao."<br><br>";
            }
        }
      ?>
    </div>
</body>
</html>