<?php
// only visible for server chrono exec every 30min
// censured password :P
// php /home/joelthorner/public_html/_gitUpdate/gitUpdate.php *********

// util
function array_push_assoc($array, $key, $value){
	$array[$key] = $value;
	return $array;
}

$SAVE_FILE = true;
$LOG = "\n";

try {

	$pass = $argv[1];
	// if ($pass != '*********') {
		throw new Exception("Error password", 1);
	// }

	$__ALL = array();
	include(__DIR__."/../vendor/autoload.php");

	$client = new \Github\Client(
		new \Github\HttpClient\CachedHttpClient(array('cache_dir' => './tmp/github-api-cache'))
		);
	
	$LOG = $LOG . "\nGet all repositories from joelthorner ";

	$repos = $client->api('user')->repositories('joelthorner');

	$LOG = $LOG . " - [SUCCESS]";	

	$_repos = array();
	foreach ($repos as $key => $value) {
		$LOG = $LOG . "\nGet full info of repo ".$value['owner']['login']. ' '.$value['name'];

		$value = $client->api('repo')->show($value['owner']['login'], $value['name']);
		$LOG = $LOG . " - [SUCCESS]";	


		try {
			$LOG = $LOG . "\nGet last release from repo ";
			// for every repo get last release
			$value['_lastRelease'] = $client->api('repo')->releases()->latest($value['owner']['login'], $value['name']);
			$LOG = $LOG . " - [SUCCESS]";	
		} catch (Exception $e) {
			$value['_lastRelease'] = NULL;
			$LOG = $LOG . " - [NULL]";	
		}
		try {
			$LOG = $LOG . "\nGet readme of repo ";
			$value['_readme'] = $client->api('repo')->contents()->readme($value['owner']['login'], $value['name']);
			
			$LOG = $LOG . " - [SUCCESS]";	
		} catch (Exception $e) {
			$value['_readme'] = NULL;
			$LOG = $LOG . " - [NULL]";	
		}

		$LOG = $LOG . "\n{REPO SAVED}";
		$_repos = array_push_assoc($_repos, $value['name'], $value);
	}

	/* set REPOS */
	$LOG = $LOG . "\n{All repos saved}";
	$__ALL = array_push_assoc($__ALL, 'repos', $_repos);

	$LOG = $LOG . "\nGet joelthorner info ";

	$user = $client->api('user')->show('joelthorner');
	$LOG = $LOG . " - [SUCCESS]";


	$LOG = $LOG . "\nGet starred of joelthorner ";
	try {
		$user['_starred'] = $client->api('user')->starred('joelthorner'); 
		$LOG = $LOG . " - [SUCCESS]";	
	} catch (Exception $e) {
		$LOG = $LOG . " - [ERROR]";	
		$SAVE_FILE = false;
	}

	/* set OWNER */
	$LOG = $LOG . "\n{User info saved}";
	$__ALL = array_push_assoc($__ALL, 'me', $user);


	$LOG = $LOG . "\nSaving JSON";
	$__ALL_JSON = json_encode($__ALL, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); // solucionar html codification


} catch (Exception $e) {
	$LOG = $LOG . "\n############# SUPERFAIL ERROR ############";
	$LOG = $LOG . "\n" . $e->getMessage();
	$LOG = $LOG . "\n############# /SUPERFAIL ERROR ############";

	$SAVE_FILE = false;
}

try {
	if ($SAVE_FILE) {
		
		$file = "../githubAPI.json";
		$open = fopen($file, "w+");

		if ( $open ) {
			fwrite($open, $__ALL_JSON);
			fclose($open);
			$LOG = $LOG . "\n################# file saved ###################";
		}else{
			$LOG = $LOG . "\n[ERROR in save file $SAVE_FILE = true]";
		}
	}else{
		$LOG = $LOG . "\n[ERROR in save file $SAVE_FILE = false]";
	}
	
} catch (Exception $e) {
	
	$LOG = $LOG . "\n[ERROR in save file ".$e->getMessage()."]";

}

/*save log*/
try {
	$file = "./logs/log.txt";
	$open = fopen($file, "a");

	if ($open) {
		fwrite($open, $LOG);
		fclose($open);
	}
	
} catch (Exception $e) {
}