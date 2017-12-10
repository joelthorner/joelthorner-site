<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {

		$data = array(
			'title' => 'Joelthorner',
			'descMeta' => 'Joel Thorner personal developer web',
			'keyWordsMeta' => 'jquery, developer, joel thorner, css, bootstrap, php, libraries, javascript',

			'zone' => 'home',
			'menu' => $this->json_model->getMenu(),
			'homeItems' => $this->json_model->getHomeZone(true),
			'myStarred' => $this->json_model->getStarred(),
			'allTags' => $this->json_model->getAllTags()
			);

		$this->template->load('default', 'defaultGrid', $data);
	}

}
