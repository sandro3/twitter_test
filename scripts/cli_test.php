<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../lib/init.php';

echo 'Twitter Test', "\n\n";

if ($argc < 2 || !preg_match('/^[a-z0-9_]{1,15}$/i', $argv[1])) {
    usage();
    exit;
}

$screenName = $argv[1];

$twitter = new TwitterAPIExchange(App::config());

// Fetch user info
$url = 'https://api.twitter.com/1.1/users/show.json';
$getField = '?screen_name=' . $screenName;
$requestMethod = 'GET';

echo doRequest($twitter, $url, $getField, $requestMethod, function($result) {
	$output = 'Name: ' . $result->name . "\n";
	$output .= 'Followers: ' . $result->followers_count . "\n";
	$output .= 'Following: ' . $result->friends_count . "\n";
	$output .= 'Tweets: ' . $result->statuses_count . "\n";
	return $output;
});

echo "\n";

// Latest 5 tweets
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getField = '?screen_name=' . $screenName . '&count=5';
$requestMethod = 'GET';

//print results
echo doRequest($twitter, $url, $getField, $requestMethod, function($result) {
	$output = '';
    foreach ($result as $tweet) {
        $output .= $tweet->created_at . "\n";
        $output .= $tweet->text . "\n";
        $output .= "\n";
    }
    return $output;
});


/**
 *
 * Executes request to twitter
 * @param TwitterAPIExchange $twitter
 * @param string $url
 * @param string $getField
 * @param string $requestMethod
 * @param function $callback
 */
function doRequest($twitter, $url, $getField, $requestMethod, $callback = null) {
    $output = '';

    // Make a request
    $response = $twitter->setGetfield($getField)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();

    // Decoding result
    $result = json_decode($response);

    // Check for errors
    if (!$result) {
        $output .= 'ERROR: Bad authorisation data or couldn\'t connect to user steam.' . "\n";
        return $output;
    }

    if (isset($result->errors)) {
        foreach ($result->errors as $error) {
            $output .= 'ERROR: ' . $error->message . "\n";
        }
        return $output;
    }

    if (is_callable($callback)) {
        $output .= call_user_func($callback, $result);
    }
    else {
        $output .= $response;
    }

    return $output;
}

/**
 *
 * Displays usage message
 */
function usage() {
    echo "\n", 'USAGE: php ', basename(__FILE__), ' <SCREEN_NAME>';
    echo "\n\n", 'SCREEN_NAME can only contain alphanumeric characters (letters A-Z, numbers 0-9) with the exception of underscores and cannot be longer than 15 characters.', "\n\n";
}