<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Snippets extends CI_Controller {

	public function index() {
		
		$repos = $this->json_model->getReposByType('snippet');
		$repos = $this->json_model->sufixRepoImage($repos, '_s');

		$data = array(
			'title' => 'Snippets - Joelthorner',
			'descMeta' => 'Html snippets by joelthorner',
			'keyWordsMeta' => 'snippets, html, html 5, css3, css, javascript, jquery, code snippet, js',

			'zone' => 'snippets',
			'menu' => $this->json_model->getMenu(),
			'repos' => $repos,
			'h1' => 'Snippets',
			'typeView' => 'snippet'
			);

		$this->template->load('default', 'listRepos', $data);
	}
}
