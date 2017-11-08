<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct() {
        parent::__construct(); 
		$this->load->database();
	}

    function get_data($start, $stop, $step, $points) {
        $query = $this->db->query('SELECT DISTINCT(dc_id) AS id FROM reservations ORDER BY dc_id');
        $data[] = ["id"]; 
        foreach($query->result_array() as $row) {
            $data[0][] = $row['id'];
        }

        $days = [];
        foreach(new DatePeriod($start, $step, $points) as $day) {
            $days[] = $day->format('Y-m-d');
        }

        // echo "<pre>";
        // for($i = 0; i < count($days)-2; $i++) {
        //     $query = $this->db->query('SELECT dc_id, sum(amount) FROM reservations WHERE datein >= ? AND datein <=? GROUP BY dc_id', array($days[i], $days[i+1]));print_r($query->result_array());
        //     print_r($query->result_array());
        // }
        // echo "<br>";
        

        

        // for() {
        //     $query = $this->db->query('SELECT dc_id, sum(amount) FROM reservations WHERE datein >= ? AND datein <= ? GROUP BY dc_id', array('2012-11-28', '2013-12-01'));
        // }
        // print_r($query->result_array());

        //echo "<pre>";
        //print_r($data);
        //return $data;
    }

}