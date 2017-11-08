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

    public function get_all_id() {
        $query = $this->db->query('SELECT DISTINCT(dc_id) AS id FROM reservations ORDER BY dc_id');
        return $query->result_array();
    }
    
    public function get_data_by_range_time($start, $stop, $include=false)
    {
        $sql;
        if($include){
            $sql = 'SELECT dc_id AS id, sum(amount) AS sum FROM reservations WHERE datein >= ? AND datein <= ? GROUP BY dc_id ORDER BY dc_id';
        } else {
            $sql = 'SELECT dc_id AS id, sum(amount) AS sum FROM reservations WHERE datein >= ? AND datein < ? GROUP BY dc_id ORDER BY dc_id';
        }
        $query = $this->db->query($sql, array($start, $stop));
        return $query->result_array();
    }
}
