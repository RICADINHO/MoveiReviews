<?php
$apiKey = "976f9dd7e5b7a6ad8f7632a2d65fc8e9";
$movieTitle = $_GET["filme"];// = 'avengers endgame'; // Change the movie title as desired

// Function to make an API request
function requestAPI($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// Search for the movie
$searchUrl = "https://api.themoviedb.org/3/search/movie?api_key=$apiKey&query=" . urlencode($movieTitle);
$searchResponse = requestAPI($searchUrl);
$movies = json_decode($searchResponse, true)['results'];

if (empty($movies)) {
    echo "No movies found with the title: $movieTitle";
} else {
    // Get the first movie from the search results
    $movie = $movies[0];
    $movieId = $movie['id'];

    echo "Movie ID: ". $movieId . "<br>";
    echo "Movie Title: " . $movie['title'] . "<br>";
    echo "Release Date: " . $movie['release_date'] . "<br>";
    echo "Overview: " . $movie['overview'] . "<br>";

    // Get the trailer for the movie
    $trailerUrl = "https://api.themoviedb.org/3/movie/$movieId/videos?api_key=$apiKey";
    $trailerResponse = requestAPI($trailerUrl);
    $trailers = json_decode($trailerResponse, true);

    if (isset($trailers['results'])) {
        $trailerof= array("N/A");

        foreach ($trailers['results'] as $trailer) {
            if($trailer['type']=="Trailer"&&$trailer['official']==true){
                array_push($trailerof,$trailer['key']);
                array_push($trailerof," - ");
            }
        }

        array_pop($trailerof);
        echo "Trailers oficiais: ";
        for($i=1;$i<sizeof($trailerof);$i++){
            echo $trailerof[$i];
        }
        echo "<br>";
    } else {
        echo "Tailers oficiais: N/A<br>";
    }

    $genresUrl = "https://api.themoviedb.org/3/movie/$movieId?api_key=$apiKey&append_to_response=genres%20status%20runtime";
    $genresResponse = requestAPI($genresUrl);
    $movieDetails = json_decode($genresResponse, true);

    if (isset($movieDetails['genres'])) {
        $genres = $movieDetails['genres'];

        echo "Genres: ";
        foreach ($genres as $genre) {
            echo $genre['name'] . " ";
        }
        echo "<br>";
    } else {
        echo "Genres: N/A<br>";
    }
    echo "Runtime: ".$movieDetails['runtime']."<br>";
    echo "Status: ".$movieDetails['status']."<br>";
    echo "Average score: meter cenas na bd para isso<br>";

    /*$imagesUrl = "https://api.themoviedb.org/3/movie/$movieId/images?api_key=$apiKey";
    $imagesResponse = requestAPI($imagesUrl);
    $imagesData = json_decode($imagesResponse, true);

    if (isset($imagesData['posters'])) {
        $posters = $imagesData['posters'];

        echo "Movie Posters:<br>";
        foreach ($posters as $poster) {
            echo $poster['file_path'] . "<br>";
            $posterUrl = 'https://image.tmdb.org/t/p/original' . $poster['file_path'];
            echo "<img src='$posterUrl' alt='Movie Poster'><br>";
        }
    } else {
        echo "No movie posters found.<br>";
    }*/

    $castUrl = "https://api.themoviedb.org/3/movie/$movieId/credits?api_key=$apiKey";
    $castResponce = requestAPI($castUrl);
    $castData = json_decode($castResponce, true);

    if(isset($castData['crew'])){
        $diretores= array("N/A");
        $escritores = array("N/A");

        foreach($castData['crew'] as $crew){
            if($crew['job']=="Director"){
                array_push($diretores,$crew['name']);
                array_push($diretores," - ");
            }
            if($crew['department']=="Writing"){
                array_push($escritores,$crew['name']);
                array_push($escritores," - ");
            }
        }

        if(sizeof($diretores)==1){
            echo "Diretor: ".$diretores[0]."<br>";
        }else if(sizeof($diretores)==3){
            echo "Diretor: ".$diretores[1]."<br>";
        }else{
            array_pop($diretores);
            echo "Diretores: ";
            for($i=1;$i<sizeof($diretores);$i++){
                echo $diretores[$i]." ";
            }
            echo "<br>";
        }
        if(sizeof($escritores)==1){
            echo "Escritor: ".$escritores[0]."<br>";
        }else if(sizeof($escritores)==3){
            echo "Escritor: ".$escritores[1]."<br>";
        }else{
            array_pop($escritores);
            echo "Escritores: ";
            for($i=1;$i<sizeof($escritores);$i++){
                echo $escritores[$i]." ";
            }
            echo "<br>";
        }
    }else{
        echo "no cast found<br>";
    }
    if(isset($castData['cast'])){
        $destaque = array("N/A");

        foreach($castData['cast'] as $cast){
            if($cast['order']<5){
                array_push($destaque,$cast['name']);
                array_push($destaque," - ");
            }else{
                break;
            }
        }
        if(sizeof($destaque)==1){
            echo "Atores destaque: ".$destaque[0]."<br>";
        }else if(sizeof($destaque)==2){
            echo "Ator destaque: ".$destaque[1]."<br>";
        }else{
            echo "Atores destaque: ";
            array_pop($destaque);
            for($i=1;$i<sizeof($destaque);$i++){
                echo $destaque[$i];
            }
            echo "<br>";
        }
    }else{
        echo "no cast found<br>";
    }
}
?>