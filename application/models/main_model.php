<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct() {
		$this->load->database();
	}

    function get_data() {
        //$query = $this->db->query('SELECT * FROM reservations LIMIT ?;', array(2));
        //return $query->result_array();

        $query = $this->db->query('SELECT DISTINCT(dc_id) AS id FROM reservations ORDER BY dc_id');
        $data[] = ["id"]; 
        foreach($query->result_array() as $row) {
            $data[0][] = $row['id'];
        }

        $start = new DateTime('2013-11-26'); 
        $stop = new DateTime('2017-11-12'); 
        $interval = $stop->diff($start);
        //echo $interval->days;

        // for() {
        //     $query = $this->db->query('SELECT dc_id, sum(amount) FROM reservations WHERE datein >= ? AND datein <= ? GROUP BY dc_id', array('2012-11-28', '2013-12-01'));
        // }
        // print_r($query->result_array());

        //echo "<pre>";
        //print_r($data);
        //return $data;
    }

}