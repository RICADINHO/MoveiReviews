<?php 

$apiKey = '976f9dd7e5b7a6ad8f7632a2d65fc8e9';

/*function requestAPI($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}*/
$currentYear = date("Y");

$moviesUrl = "https://api.themoviedb.org/3/discover/movie?api_key=$apiKey&primary_release_year=$currentYear&sort_by=popularity.desc";
$moviesResponse = requestAPI($moviesUrl);
$moviesData = json_decode($moviesResponse, true);

if (isset($moviesData['results']) && count($moviesData['results']) > 0) {
    $mostPopularMovie = $moviesData['results'][0];
    $movieIdp = $mostPopularMovie['id'];

    $movieUrl = "https://api.themoviedb.org/3/movie/$movieIdp?api_key=$apiKey";
    $movieResponse = requestAPI($movieUrl);
    $movieData = json_decode($movieResponse, true);
    $desc = $mostPopularMovie['overview'];
    $titl = $mostPopularMovie['title'];

    // Display the most popular movie details
    //echo "Most Popular Movie Released in $currentYear:<br>";
    //echo "Movie Title: " . $mostPopularMovie['title'] . "<br>";
    //echo "Movie ID: " . $mostPopularMovie['id'] . "<br>";
    //echo "Overview: " . $mostPopularMovie['overview'] . "<br>";

    if (isset($movieData['poster_path'])) {
        $posterPath = $movieData['poster_path'];
        $posterUrl2 = "https://image.tmdb.org/t/p/w500$posterPath";
        //echo "Poster URL: $posterUrl<br>";
    } else {
        echo "Poster URL not available.<br>";
    }

    // Get the official trailer
    $videosUrl = "https://api.themoviedb.org/3/movie/$movieIdp/videos?api_key=$apiKey";
    $videosResponse = requestAPI($videosUrl);
    $videosData = json_decode($videosResponse, true);

    if (isset($videosData['results']) && count($videosData['results']) > 0) {
        foreach ($videosData['results'] as $video) {
            if ($video['type'] === 'Trailer' && $video['official']) {
                $trailerKey2 = $video['key'];
                break;
            }
        }
    } else {
        echo "Trailer URL not available.<br>";
    }

///echo $trailerKey;
} else {
    echo "No movies released in $currentYear found.<br>";
}


?>