<?php


class Twitter {

	protected  $results;

	public function searchResults( $search = null, $rpp = 50 ) {

		require_once('twitteroauth/twitteroauth/twitteroauth.php');

		$consumer_key='rD0JPpDsScVVjv30SCtllg'; //Provide your application consumer key
		$consumer_secret='6HcwZYe3fD0VLyCL8UcOEQg4rdIUjGltGWKhsc'; //Provide your application consumer secret
		$oauth_token = '1170521828-ve33ya1u1TwmfZecl5LuvST8KLXC6lcgDAfUkwy'; //Provide your oAuth Token
		$oauth_token_secret = '7PKqQ5qdRe9ZfeV9EyS7VdiDQF0k9aHu1DUwmWxgK4'; //Provide your oAuth Token Secret

		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);

		$query = "https://api.twitter.com/1.1/search/tweets.json?q=" . urlencode( $search ) . "&lang=fr&rpp=$rpp&include_entities=true";
		//$query = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=NOE_interactive&count=1'; //Your Twitter API query
		$content = $connection->get($query);
		print_r($content);
		exit;


		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $url );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		$result = curl_exec( $curl );
		curl_close( $curl );

		$results_objects = json_decode($result);

		if(!empty($results_objects->results)){

			//$this->searchResults($search, $rpp + 50);
		}

							print_r($results_objects);
		exit;

		return $return;
	}

}

echo "<pre>";
$twitter = new Twitter();
echo $twitter->searchResults("charlielefilm");