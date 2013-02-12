<?php


class Twitter {

	protected  $results = array();

	public function searchResults( $search = null, $rpp = 100 ) {

		require_once('twitteroauth/twitteroauth/twitteroauth.php');

		$consumer_key='rD0JPpDsScVVjv30SCtllg'; //Provide your application consumer key
		$consumer_secret='6HcwZYe3fD0VLyCL8UcOEQg4rdIUjGltGWKhsc'; //Provide your application consumer secret
		$oauth_token = '1170521828-ve33ya1u1TwmfZecl5LuvST8KLXC6lcgDAfUkwy'; //Provide your oAuth Token
		$oauth_token_secret = '7PKqQ5qdRe9ZfeV9EyS7VdiDQF0k9aHu1DUwmWxgK4'; //Provide your oAuth Token Secret

		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$query = "https://api.twitter.com/1.1/search/tweets.json?q=" . urlencode( $search ) . "&rpp=$rpp&include_entities=true";
		$content = $connection->get($query);

		$memcache_obj = new Memcache;
		$memcache_obj->connect('memcache_host', 11211);

		#$memcache_obj->delete('tweet_charlie');

		if($data = $memcache_obj->get('tweet_charlie')){
			$this->results = unserialize($memcache_obj->get('tweet_charlie'));
		}else{
			if(!empty($content->statuses)){
				foreach ($content->statuses as $key_tweet => $value_tweet) {
					if(!empty($value_tweet->entities->media)){
						foreach ($value_tweet->entities->media as $key_media => $value_media) {
							if(!empty($value_media->media_url)){
									$this->results[] = $value_media->media_url;
							}
						}
					}
				}
				$memcache_obj->add('tweet_charlie', serialize($this->results), false, 2592000);
			}
		}

		return $this->results;
	}

}

$twitter = new Twitter();
echo json_encode($twitter->searchResults("charlielefilm"));
