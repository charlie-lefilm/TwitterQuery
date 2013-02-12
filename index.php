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
		$content = $connection->get($query);

		print_r($content);
		exit;

		if(!empty($content->statuses)){

			//$this->searchResults($search, $rpp + 50);
		}else{

		}

							print_r($results_objects);
		exit;

		return $return;
	}

}

echo "<pre>";
$twitter = new Twitter();
echo $twitter->searchResults("charlielefilm");