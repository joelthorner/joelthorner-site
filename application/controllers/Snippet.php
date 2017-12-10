<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Snippet extends CI_Controller {
	public function index($snippetParam=NULL) {
		
		// return NULL or repo object
		$_REPO = $this->json_model->searchRepo($snippetParam, 'snippet', true);

		if ($_REPO != NULL) {

			$data = array(
				'title' => $snippetParam . ' - Joelthorner',
				'descMeta' => 'Joel Thorner personal developer web',
				'keyWordsMeta' => $snippetParam . 'repositories, tags, tag, joelthorner tags, hastag, github',

				'zone' => 'snippet',
				'menu' => $this->json_model->getMenu(),
				'repo' => $_REPO,
				'readme' => $this->json_model->getReadmeInHTML($_REPO->gitContent->_readme->content),
				'iframe' => $_REPO->source,
				'customIcon' => base_url() . '_snippets/' . $snippetParam . '/demo/img/icon.png'
			);

			$this->template->load('default', 'iframe', $data);
		}else{
			show_404();
		}
	}
}
