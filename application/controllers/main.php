<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('main_model');
    }

    public function index($start, $stop, $step)
    {
        $data['start'] = $start;
        $data['stop'] = $stop;
		$data['step'] = $step;
		$data['x'] = 'Проміжки часу';
		$data['y'] = 'Сума';
		
        $start = new DateTime($start);
        $stop = new DateTime($stop);
        $interval = $stop->diff($start);
        $points = (int) ($interval->format('%a') / $step);
		
		if ($interval->invert == 0 || !is_numeric($step) || (is_numeric($step) && $step <= 0)) {
            show_404();
        } else {
            $arr = $this->main_model->get_data($start, $stop, new DateInterval("P".$step."D"), $points);
			$data['arr'] = json_encode($arr);
			
            $this->load->view('main_view', $data);
        }
    }
}
