<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plugins extends CI_Controller {

	public function index() {

		$repos = $this->json_model->getReposByType('plugin');
		$repos = $this->json_model->sufixRepoImage($repos, '_s');

		$data = array(
			'title' => 'Plugins - Joelthorner',
			'descMeta' => 'Joel Thorner personal developer web',
			'keyWordsMeta' => 'plugins, html, html 5, css3, css, joelthorner, joel thorner, plugin, free',

			'zone' => 'plugins',
			'menu' => $this->json_model->getMenu(),
			'repos' => $repos,
			'h1' => 'Plugins',
			'typeView' => 'plugin' 
			// 'allTags' => $_allTags
			);

		$this->template->load('default', 'listRepos', $data);
	}
}
