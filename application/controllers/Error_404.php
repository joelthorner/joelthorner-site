<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Error_404 extends CI_Controller {
	
	public function __construct() {
		parent::__construct(); 
	} 
	
	public function index() {

		$data = array(
			'title' => 'Page not found - Joelthorner',
			'descMeta' => 'Joel Thorner page not found 404',
			'keyWordsMeta' => 'jquery, developer, joel thorner, css, bootstrap, php, libraries, javascript',

			'zone' => 'notfound',
			'menu' => $this->json_model->getMenu()
			);

		$this->output->set_status_header('404');
		$this->template->load('default', 'notFound', $data);
	}

}
