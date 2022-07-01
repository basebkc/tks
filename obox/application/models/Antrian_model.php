<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Antrian_model extends CI_Model
{

    public $table = 'antrian';
    public $id = 'id_antrian';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
  function search_rekap($tgl_awal,$tgl_akhir,$cabang,$users,$limit="",$start="",$row="")
    {
        $where=$this->session->userdata("user_id");
        $this->db->select('*');
        if (!$this->ion_auth->in_group('admin', $where)) {
            if ($cabang !== "kosong") {
                   if ($tgl_awal=="kosong" || $tgl_akhir=="kosong") {
                    $where = array('id_kan' => $cabang,
                                   'id_user' => $where );
                    }else{
                    $where = array('tgl_upload >=' => $tgl_awal,
                           'tgl_upload <=' => $tgl_akhir,
                           'id_kan' => $cabang,
                           'id_user' => $where );
                    }
            }else{
             
                    if ($tgl_akhir !== "kosong") {
                    $where = array('tgl_upload >=' => $tgl_awal,
                                   'tgl_upload <=' => $tgl_akhir,
                                   'id_user' => $where );
                    }else{
                        $where = array('tgl_upload' => $tgl_awal,
                                       'id_user' => $where );
                    }
               
            
            }

          
        }else{
           if ($users=="kosong") {
               if ($cabang !== "kosong") {
                  if ($tgl_awal=="kosong" || $tgl_akhir=="kosong") {
                     $where = array('id_kan' => $cabang);
                 }else{
                     $where = array('tgl_upload >=' => $tgl_awal,
                           'tgl_upload <=' => $tgl_akhir,
                           'id_kan' => $cabang );
                }
            }else{

                    if ($tgl_akhir !== "kosong") {
                            $where = array('tgl_upload >=' => $tgl_awal,
                                   'tgl_upload <=' => $tgl_akhir);
                        }else{
                            $where = array('tgl_upload' => $tgl_awal);
                        }
                 
      
            }
           }else{
                  if ($cabang !== "kosong") {
                   if ($tgl_awal=="kosong" || $tgl_akhir=="kosong") {
                    $where = array('id_kan' => $cabang,
                                   'id_user' => $users );
                    }else{
                    $where = array('tgl_upload >=' => $tgl_awal,
                           'tgl_upload <=' => $tgl_akhir,
                           'id_kan' => $cabang,
                           'id_user' => $users );
                    }
            }else{
             
                    if ($tgl_akhir !== "kosong") {
                    $where = array('tgl_upload >=' => $tgl_awal,
                                   'tgl_upload <=' => $tgl_akhir,
                                   'id_user' => $users );
                    }else{
                        $where = array('tgl_upload' => $tgl_awal,
                                       'id_user' => $users );
                    }
               
            
            }
           }
        }
         $this->db->where($where);

        $this->db->order_by('id_antrian', 'desc');
        if ($row=="1") {
           return $this->db->get('antrian');
        }else{
            return $this->db->get('antrian', $limit, $start);
        }
    }
    function search_data($query,$where="")
    {
        $this->db->select('*');
        if (!$this->ion_auth->in_group('admin', $where)) {
            $this->db->where(array('id_user' => $where));
        }
         if($query != '')
            {
                $this->db->like('nama', $query);
                $this->db->or_like('no_antrian', $query);
                $this->db->or_like('no_ktp', $query);
                $this->db->or_like('tempat_lahir', $query);
                $this->db->or_like('tgl_upload', $query);
            }

        $this->db->order_by('id_antrian', 'desc');
            return $this->db->get('antrian');
    }
    function get_byuser($where="",$limit="",$start="")
    {
        if (!$this->ion_auth->in_group('admin', $where)) {
            $this->db->where(array('id_user' => $where));
        }
        $this->db->order_by('id_antrian', 'desc');
        return $this->db->get($this->table, $limit, $start)->result();
    }
     function get_histori_by_user($where="",$limit="",$start="")
    {
        $this->db->where(array('id_user' => $where));
        $this->db->order_by('id_antrian', 'desc');
        return $this->db->get($this->table, $limit, $start)->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_antrian', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('no_ktp', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('file', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('tgl_upload', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_antrian', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('no_ktp', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('file', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('tgl_upload', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Antrian_model.php */
/* Location: ./application/models/Antrian_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 13:10:59 */
/* http://harviacode.com */