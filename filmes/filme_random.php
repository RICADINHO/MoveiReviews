<?php
session_start();
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
}

h1,h2{
  margin: 10px;
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

@media screen and (max-width: 860px) {
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
  <a href="procurar2.php">pesquiar?</a>
  <a href="topfilmes.php">top filmes</a>
  <a class="active" href="">filme random</a>
  <a href="contacto.php">Contactos</a>
  <?php if($_SESSION==null){echo "<a href='/projeto/login.php'>login</a>";}else{echo "<a href='/projeto/conta.php'>".$_SESSION['user_name']."</a>"; } ?>
  <div class="search-container">
    <form action="procurar.php" method="GET">
      <input type="text" placeholder="Pesquisar..." name="filme" id="pesquisar">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<?php
$apiKey = '976f9dd7e5b7a6ad8f7632a2d65fc8e9'; // Replace with your TMDB API key

// Function to make an API request
function requestAPI($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

$randomPage = rand(1,500);

$randomMovieUrl = "https://api.themoviedb.org/3/discover/movie?api_key=$apiKey&page=$randomPage";
$randomMovieResponse = requestAPI($randomMovieUrl);
$randomMovieData = json_decode($randomMovieResponse, true);

$movies = $randomMovieData['results'];

// Choose a random movie from the list
$randomIndex = array_rand($movies);
$randomMovie = $movies[$randomIndex];
$movieid = $randomMovie['id']; 


// Display the movie details
echo "Movie Title: " . $randomMovie['title'] . "<br>";
echo "Movie ID: " . $randomMovie['id'] . "<br>";
echo "Overview: " . $randomMovie['overview'] . "<br>";
        $imagesUrl = "https://api.themoviedb.org/3/movie/$movieid/images?api_key=$apiKey";
        $imagesResponse = requestAPI($imagesUrl);
        $imagesData = json_decode($imagesResponse, true);
    
        if (!empty($imagesData['posters'])) {
            $posters = $imagesData['posters'];

            foreach($posters as $poster) {
                $posterUrl = 'https://image.tmdb.org/t/p/original' . $poster['file_path'];
                echo "<a href='filmes2.php?filme=$movieid'><img src='$posterUrl' alt='Movie Poster' style='width: 50px;heigth: 75px'></a><br><br>";
                break;
            }
        }else{
            echo "<a href='filmes2.php?filme=$movieid'><img src='null.png' alt='a sua mae' style='width: 50px;heigth: 75px'></a><br><br>";
        }
?>
</body>
</html>