<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('main_model');
	}

	public function index($start, $stop, $step)
	{
		$start = new DateTime($start); 
        $stop = new DateTime($stop); 
		$interval = $stop->diff($start);
		$points = (int) ($interval->format('%a') / $step);

		if($interval->invert == 0 || !is_numeric($step) || (is_numeric($step) && $step <= 0)) {
			show_404();
		} else {
			$data['arr'] = $this->main_model->get_data($start, $stop, new DateInterval("P".$step."D"), $points);
						
			// $data['first'] = $start;
			// $data['second'] = $stop;
			// $data['third'] = $step;

			// $arr[] = ['Time', 'Перший', 'Другий'];
			// $arr[] = ['2',  1000,      400];
			// $arr[] = ['4',  1170,      460];
			// $arr[] = ['6',  660,       1120];
			// $arr[] = ['8',  1030,      540];

			// $data['arr'] = json_encode($arr);	

			$this->load->view('main_view', $data);
		}
	}

}