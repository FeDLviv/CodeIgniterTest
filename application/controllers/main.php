<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('main_model');
	}

	public function index()
	{
        $data['arr'] = $this->main_model->get_data();
        $this->load->view('main_view', $data);
    }

}