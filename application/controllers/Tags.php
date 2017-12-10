<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Controller {

	public function index() {

		$data = array(
			'title' => 'Tags - Joelthorner',
			'descMeta' => 'Html snippets and plgugins by joelthorner classified for tags',
			'keyWordsMeta' => 'tags, snippets, html, html 5, css3, css, javascript, jquery, code snippet, js',

			'zone' => 'tags',
			'menu' => $this->json_model->getMenu(),
			'tagsContent' => $this->json_model->getReposForEachTag(),
			'h1' => 'All tags',
			'typeView' => 'mixed'
		);

		$this->template->load('default', 'listReposTags', $data);
	}
}
