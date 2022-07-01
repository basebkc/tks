<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obox_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function getDataCR006($minggu1, $minggu2){

        $data = $this->db->select('obox_cr006.*,tbl_kantor.kd_kantor_ojk,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_cr006')
                        ->join('inisialisasi_laporan','obox_cr006.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->join('tbl_kantor','tbl_kantor.kd_kan=obox_cr006.kode_kantor')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
                        
        
        
        return $data->result_array();
    }

    function getDataCR007($minggu1, $minggu2){

        $data = $this->db->select('obox_cr007.*,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_cr007')
                        ->join('inisialisasi_laporan','obox_cr007.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
                        
        
        
        return $data->result_array();
    }
    

    function getDataCR008($minggu1, $minggu2){

        $data = $this->db->select('obox_cr008.*,tbl_kantor.kd_kantor_ojk,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_cr008')
                        ->join('inisialisasi_laporan','obox_cr008.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->join('tbl_kantor','tbl_kantor.kd_kan=obox_cr008.kode_kantor')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    function getDataCR009($minggu1, $minggu2){

        $data = $this->db->select('obox_cr009.*,tbl_kantor.kd_kantor_ojk,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_cr009')
                        ->join('inisialisasi_laporan','obox_cr009.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->join('tbl_kantor','tbl_kantor.kd_kan=obox_cr009.kode_kantor')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    function getDataOP001($minggu1, $minggu2){

        $data = $this->db->select('obox_op001.*,tbl_kantor.kd_kantor_ojk,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_op001')
                        ->join('inisialisasi_laporan','obox_op001.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->join('tbl_kantor','tbl_kantor.kd_kan=obox_op001.kode_kantor')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    function getDataOP002($minggu1, $minggu2){

        $data = $this->db->select('obox_op002.*,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_op002')
                        ->join('inisialisasi_laporan','obox_op002.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    function getDataOP003($minggu1, $minggu2){

        $data = $this->db->select('obox_op003.*,tbl_kantor.kd_kantor_ojk,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_op003')
                        ->join('inisialisasi_laporan','obox_op003.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->join('tbl_kantor','tbl_kantor.kd_kan=obox_op003.kode_kantor')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    function getDataLQ003($minggu1,$minggu2){
        $data = $this->db->select('obox_lq003.*,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_lq003')
                        ->join('inisialisasi_laporan','obox_lq003.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    function getDataLQ004($minggu1,$minggu2){
        $data = $this->db->select('obox_lq004.*,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_lq004')
                        ->join('inisialisasi_laporan','obox_lq004.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->where('inisialisasi_laporan.daritgl', $minggu1)
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    function getDataLQ005($minggu2){
        $data = $this->db->select('obox_lq005.*,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_lq005')
                        ->join('inisialisasi_laporan','obox_lq005.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }


    function getDataLQ006($minggu2){
        $data = $this->db->select('obox_lq006.*,inisialisasi_laporan.daritgl,inisialisasi_laporan.sampaitgl,inisialisasi_laporan.tgllaporan')
                        ->from('obox_lq006')
                        ->join('inisialisasi_laporan','obox_lq006.id_inisialisasi=inisialisasi_laporan.id','inner')
                        ->where('inisialisasi_laporan.sampaitgl', $minggu2)
                        ->get();
        
        return $data->result_array();
    }

    
    
    function insertInisialisasi($input){
        
        // var_dump($input);die;
        $data = $this->db->insert('inisialisasi_laporan',$input);
        
        if($data == TRUE){
			return 'true'; 
        } else {
			return 'false';
		}

    }

    function getAll(){

        return $this->db->order_by('id','desc')->get('inisialisasi_laporan')->result();

    }

    function getlastid(){

        return $this->db->order_by('id','desc')
                        ->limit(1)
                        ->get('inisialisasi_laporan')
                        ->result_array();

    }

    function getInitData($tanggal1,$tanggal2){

        return $this->db->order_by('id','desc')
                        ->get('inisialisasi_laporan')
                        ->where('')
                        ->result_array();

    }


    function storeCR006($input){
        
        
        $data = $this->db->insert('obox_cr006',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeCR007($input){
        
        $data = $this->db->insert('obox_cr007',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeCR008($input){
        
        
        $data = $this->db->insert('obox_cr008',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeCR009($input){
        
        
        $data = $this->db->insert('obox_cr009',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeOP001($input){
        
        $data = $this->db->insert('obox_op001',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeOP002($input){
        
        $data = $this->db->insert('obox_op002',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeLQ003($input){
        
        $data = $this->db->insert('obox_lq003',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeLQ004($input){
        
        $data = $this->db->insert('obox_lq004',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeLQ005($input){
        
        $data = $this->db->insert('obox_lq005',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function storeLQ006($input){
        
        $data = $this->db->insert('obox_lq006',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }

    function getDataKolek($tanggal1, $tanggal2){

        $data = $this->db->select('perubahan_kolek.*')
                        ->from('perubahan_kolek')
                        ->where('daritgl', $tanggal1)
                        ->where('sampaitgl', $tanggal2)
                        ->get();
        
        return $data->result_array();
    }

    function storeKolek($input){
        
        
        $data = $this->db->insert('perubahan_kolek',$input);
        
        if($data == TRUE){
            return 'true'; 
        } else {
            return 'false';
        }
    }
}

/* End of file Antrian_model.php */
/* Location: ./application/models/Antrian_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 13:10:59 */
/* http://harviacode.com */