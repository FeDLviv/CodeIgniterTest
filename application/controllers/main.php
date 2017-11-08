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

    public function index($start = '2016-02-29', $stop = '2016-05-04', $step = '1')
    {
        try {
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
                $arr[] = ["id"];
                foreach ($this->main_model->get_all_id() as $row) {
                     $arr[0][] = $row['id'];
                }

                $days = [];
                foreach (new DatePeriod($start, new DateInterval("P".$step."D"), $points) as $day) {
                    $days[] = $day->format('Y-m-d');
                }
                $days[] = $stop->format('Y-m-d');

                for ($i=0; $i<count($days)-2; $i++) {
                    $result = $this->main_model->get_data_by_range_time($days[$i], $days[$i+1], $i==count($days)-3);
                
                    $arr[$i+1][] = $days[$i];
                
                    if (empty($result)) {
                        for ($z=1; $z<count($arr[0]); $z++) {
                            $arr[$i+1][]=0;
                        }
                    }
    
                    for ($j=1; $j<count($arr[0]); $j++) {
                        for ($z = 0; $z < count($result); ++$z) {
                            if ($arr[0][$j] == $result[$z]['id']) {
                                $arr[$i+1][$j] = (int) $result[$z]["sum"];
                                break;
                            } else {
                                $arr[$i+1][$j] = 0;
                            }
                        }
                    }
                }
            
                $data['arr'] = json_encode($arr);
            
                $this->load->view('main_view', $data);
            }
        } catch (Exception $e) {
            show_404();
        }
    }
}
