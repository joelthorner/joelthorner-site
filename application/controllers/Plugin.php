<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin extends CI_Controller {
	public function index($pluginParam=NULL) {

		// return NULL or repo object
		$_REPO = $this->json_model->searchRepo($pluginParam, 'plugin', true);

		if ($_REPO != NULL) {

			$data = array(
				'title' => $pluginParam . ' - Joelthorner',
				'descMeta' => 'Joel Thorner personal developer web',
				'keyWordsMeta' => $pluginParam . 'repositories, tags, tag, joelthorner tags, hastag, github',

				'zone' => 'plugin',
				'menu' => $this->json_model->getMenu(),
				'repo' => $_REPO,
				'readme' => $this->json_model->getReadmeInHTML($_REPO->gitContent->_readme->content),
				'iframe' => $_REPO->source,
				'customIcon' => base_url() . '_plugins/' . $pluginParam . '/demo/img/icon.png'
				);

			$this->template->load('default', 'iframe', $data);
		}else{
			show_404();
		}
	}
}
