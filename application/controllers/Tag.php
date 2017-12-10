<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {

	public function index($tagParam=NULL) {

		// return NULL or repo object
		$_REPOS = $this->json_model->getReposByTag($tagParam);

		if ($_REPOS != NULL) {

			$data = array(
				'title' => 'Tag ' . $tagParam . ' - Joelthorner',
				'descMeta' => 'Joel Thorner personal developer web ' . 'tag ' . $tagParam,
				'keyWordsMeta' => $tagParam . ' repositories, tags, tag, joelthorner tags, hastag, github',
				'typeView' => 'mixed',
				'zone' => 'tag',
				'menu' => $this->json_model->getMenu(),
				'repos' => $_REPOS,
				'h1' => $tagParam
				);

			$this->template->load('default', 'listRepos', $data);
		}else{
			show_404();
		}
	}
}
