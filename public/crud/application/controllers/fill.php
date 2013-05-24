<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fill extends CI_Controller {
	
	 function __construct()
    {
        parent::__construct();

 
        /* Standard Libraries */
        $this->load->database();
        $this->load->helper('url');

        /* ------------------ */    
 
        $this->load->library('grocery_CRUD');    
    }
 
    function _example_output($output = null)

    {
        $this->load->view('bus.php',$output);    
    }
 
    function bus()
    {
        $crud = new grocery_CRUD();
 
        $crud->set_subject('Bus');
        $crud->set_table('bus');
		$crud->columns('id','id_route','plate','number');
		$crud->fields('id','id_route','plate','number');
		
        $output = $crud->render();
 
        $this->_example_output($output);                
    }
	
	function driver()
    {
         $crud = new grocery_CRUD();
 
        $crud->set_subject('Driver');
        $crud->set_table('driver');
		$crud->columns('id','name','family_name');
		$crud->fields('id','name','family_name');
		
        $output = $crud->render();
 
        $this->_example_output($output);                
    }
	
    function bus_driver()
    {
        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

   function check_point()
    {
        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

 
    function parameter()
    {
        $output = $this->grocery_crud->render();
        $this->_example_output($output);
    }

	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */