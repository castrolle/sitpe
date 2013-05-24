<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->database();

	}

	public function index()
	{
		echo "<h1>Bienvenido al mundo de Codeigniter</h1>";//Solo un ejemplo!
		die();
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */