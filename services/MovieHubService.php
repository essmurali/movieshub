<?php
class MovieHubService {

	const API_URL = "http://localhost:8000/api/";
	public function getMoviesList()
	{
		$moviesList = $this->invokeService(self::API_URL."list", []);
		return $moviesList;
	}


    public function findMovies(string $movieName)
    {

        $moviesList = $this->invokeService(self::API_URL."search", ["movieName" => $movieName]);
        return $moviesList;
    }

	public function invokeService(string $url, array $post)
    {
        $ch = \curl_init($url);
        
        \curl_setopt($ch, CURLOPT_URL, $url);
		\curl_setopt($ch, CURLOPT_POST, 1);

        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $post);

        $response = \curl_exec($ch);
        $error    = \curl_error($ch);
        $errno    = \curl_errno($ch);
        
        if (\is_resource($ch)) {
            \curl_close($ch);
        }

        if (0 !== $errno) {
            throw new \RuntimeException($error, $errno);
        }
        
        return $response;
    }
	
}