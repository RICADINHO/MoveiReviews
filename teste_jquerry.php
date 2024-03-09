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
$currentDate = date("Y-m-d");

// Get the movies yet to be released in 2023
$moviesUrl = "https://api.themoviedb.org/3/discover/movie?api_key=$apiKey&primary_release_date.gte=$currentDate&primary_release_date.lte=2023-12-31";
$moviesResponse = requestAPI($moviesUrl);
$moviesData = json_decode($moviesResponse, true);

$movies = $moviesData['results'];
$fotos = array();
$ids = array();
// Display the movie details
//echo "Movies Yet to be Released in 2023:<br>";
foreach ($movies as $movie) {
    $movieid=$movie['id'];
    array_push($ids,$movieid);
    //echo "Movie Title: " . $movie['title'] . "<br>";
    //echo "Movie ID: " . $movie['id'] . "<br>";
   /// echo "Overview: " . $movie['overview'] . "<br>";
   // echo "release date: ".$movie['release_date']."<br>";
   // echo "-----------------------------<br>";

        $imagesUrl = "https://api.themoviedb.org/3/movie/$movieid/images?api_key=$apiKey";
        $imagesResponse = requestAPI($imagesUrl);
        $imagesData = json_decode($imagesResponse, true);
    
        if (!empty($imagesData['posters'])) {
            $posters = $imagesData['posters'];

            foreach($posters as $poster) {
                $posterUrl = 'https://image.tmdb.org/t/p/original' . $poster['file_path'];
                array_push($fotos,$posterUrl);
                //echo "<a href='filmes2.php?filme=$movieid'><img src='$posterUrl' alt='Movie Poster' style='width: 50px;heigth: 75px'></a><br><br>";
                break;
            }
        }else{
            array_push($fotos,"filmes/null.png");
            //echo "<a href='filmes2.php?filme=$movieid'><img src='null.png' alt='a sua mae' style='width: 50px;heigth: 75px'></a><br><br>";
        }
}
$fotos;
?>