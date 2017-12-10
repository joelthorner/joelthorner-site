<?php

use \Michelf\Markdown;
use \Michelf\MarkdownExtra;

class Json_model extends CI_Model {

	private $joelthornerJSON;
	private $githubJSON;

	public function __construct()
	{
		parent::__construct();

		$_JSON = file_get_contents("joelthorner.json");
		$this->joelthornerJSON = json_decode($_JSON);

		$_JSON2 = file_get_contents("githubAPI.json");
		$this->githubJSON = json_decode($_JSON2);
		
		// fill repos with git info
		foreach ($this->joelthornerJSON->repos as $repoName => $repo) {
			if(isset($this->joelthornerJSON->repos->{$repoName}) && isset($this->githubJSON->repos->{$repoName}))
				$this->joelthornerJSON->repos->{$repoName}->gitContent = $this->githubJSON->repos->{$repoName};
		}
	}

	/* joelthorner.json */
	public function getAllTags($ordered = true){
		$_allTags = array();

		foreach ($this->joelthornerJSON->repos as $key => $value) {
			foreach (explode(',', $value->tags) as $tag){
				$_allTags[] = $tag;
			}
		}
		if ($ordered) {
			sort($_allTags);
		}
		$_allTags = array_unique($_allTags);
		
		return $_allTags;
	}

	/* joelthorner.json */
	public function getMenu(){
		return $this->joelthornerJSON->menu;
	}

	/* 
		joelthorner.json 
		github.json 
	*/
	public function getHomeZone($fillRepositories = true){
		if ($fillRepositories) {
			foreach ($this->joelthornerJSON->home->items as $homeItemName => $homeItem){
				if(isset($homeItem->repo)) 
					$this->joelthornerJSON->home->items->{$homeItemName}->repo = $this->joelthornerJSON->repos->{$homeItem->repo};
			}
		}
		return $this->joelthornerJSON->home;
	}

	/* github.json */
	public function getStarred(){
		return $this->githubJSON->me->_starred;
	}

	/* 
		joelthorner.json 
		github.json 
	*/
	public function searchRepo($gitName = "", $workType = "ALL"/*, $fillRepositories = true*/){
		foreach ($this->joelthornerJSON->repos as $repo) {
			if ($repo->workType == $workType) {
				if ($repo->gitRepo == $gitName || $workType == "ALL") {
					return $repo;
				}
			}
		}
		return NULL;
	}

	/* 
		joelthorner.json 
		github.json 
	*/
	public function getReposByType($type){
		$reposfinded = (object)array();
		foreach ($this->joelthornerJSON->repos as $repo) {
			if ($repo->workType == $type) {
				$reposfinded->{$repo->gitRepo} = $repo;
			}
		}
		if (count((array)$reposfinded) === 0) {
			return NULL;
		}
		return $reposfinded;
	}

	/* 
		joelthorner.json 
		github.json 
	*/
	public function getReposByTag($tag){
		$reposfinded = (object)array();
		foreach ($this->joelthornerJSON->repos as $repo) {
			if (strpos($repo->tags, $tag) !== false) {
				$reposfinded->{$repo->gitRepo} = $repo;
			}
		}
		if (count((array)$reposfinded) === 0) {
			return NULL;
		}
		return $reposfinded;
	}

	/* util */
	public function sufixRepoImage($repos, $sufix){
		foreach ($repos as $repo) {
			$image = str_replace('.jpg', $sufix . '.jpg', $repo->image); 
			$image = str_replace('.png', $sufix . '.png', $image);
			$image = str_replace('.gif', $sufix . '.gif', $image);
			$image = str_replace('.svg', $sufix . '.svg', $image);
			$repo->image = $image;
		}
		return $repos;
	}

	/* 
		joelthorner.json 
		github.json 
	*/
	public function getReposForEachTag(){
		$tags = $this->getAllTags();

		$reposByTags = (object)array();
		foreach ($tags as $tag => $valueTag) {
			
			if (!empty($valueTag)) {
				$reposByTags->{$valueTag} = array();
				
				foreach ($this->joelthornerJSON->repos as $key => $value) {
					if(strpos($value->tags, $valueTag) !== false) array_push ($reposByTags->{$valueTag}, $value);
				}
			}
		}
		return $reposByTags;
	}

	/* Markdown library */
	public function getReadmeInHTML($base64String = ""){
		$readmeBase64 = base64_decode($base64String);
		$parser = new MarkdownExtra;
		$parser->fn_id_prefix = "post22-";
		$HTML = $parser->transform($readmeBase64);
		return $HTML;
	}
	

}