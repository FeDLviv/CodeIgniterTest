<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_data($start, $stop, $step, $points)
    {
        $query = $this->db->query('SELECT DISTINCT(dc_id) AS id FROM reservations ORDER BY dc_id');
        $data[] = ["id"];
        foreach ($query->result_array() as $row) {
            $data[0][] = $row['id'];
        }

        $days = [];
        foreach (new DatePeriod($start, $step, $points) as $day) {
            $days[] = $day->format('Y-m-d');
        }

        for ($i = 0; $i < count($days)-2; $i++) {
            $query = $this->db->query('SELECT dc_id AS id, sum(amount) AS sum FROM reservations WHERE datein >= ? AND datein < ? GROUP BY dc_id ORDER BY dc_id', array($days[$i], $days[$i+1]));
            $result = $query->result_array();
            
            $data[$i+1][] = $days[$i];
            if (empty($result)) {
                for ($n=1; $n<count($data[0]); $n++) {
                    $data[$i+1][]=0;
                }
            }

            for ($j=1; $j<count($data[0]); $j++) {
                for ($d = 0; $d < count($result); ++$d) {
                    if ($data[0][$j] == $result[$d]['id']) {
                        $data[$i+1][$j] = (int) $result[$d]["sum"];
                        break;
                    } else {
                        $data[$i+1][$j] = 0;
                    }
                }
            }
        }
        return $data;
    }
}
