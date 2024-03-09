<?php
$apiKeyAAA = '976f9dd7e5b7a6ad8f7632a2d65fc8e9'; // Replace with your TMDB API key

// Function to make an API request
function requestAPIAAA($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

$randomPageAAA = rand(1,500);

$randomMovieUrlAAA = "https://api.themoviedb.org/3/discover/movie?api_key=$apiKeyAAA&page=$randomPageAAA";
$randomMovieResponseAAA = requestAPIAAA($randomMovieUrlAAA);
$randomMovieDataAAA = json_decode($randomMovieResponseAAA, true);

$moviesAAA = $randomMovieDataAAA['results'];

// Choose a random movie from the list
$randomIndexAAA = array_rand($moviesAAA);
$randomMovieAAA = $moviesAAA[$randomIndexAAA];
$movieidAAA = $randomMovieAAA['id']; 
?>