<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {

	public function getDataWhere($tbl,$data){
		return $this->db->get_where($tbl,$data);
	}

	public function insertDataSave($tbl,$data){
		$this->db->insert($tbl,$data);
		$last_id = $this->db->insert_id();
        if($this->db->affected_rows() > 0){
            $return = array(
                'code' => 0,
                'message' => "Data saved",
                'last_id' => $last_id
            );
        }
        else{
            $return = array(
                'code' => 1,
                'message' => "Data not saved"
            );
        }
        return $return;
	}

	public function getDataQuery($sql){
		return $this->db->query($sql);
	}

	public function updData($tbl,$where,$data){
        $this->db->where($where);
        $this->db->update($tbl,$data);
        if($this->db->affected_rows() > 0){
            $return = array(
                'code' => 0,
                'message' => "Update successful"
            );
        }
        else{
            $return = array(
                'code' => 1,
                'message' => "Update unsuccessful"
            );
        }
        return $return;
    }

    public function selectAll($tbl){
        return $this->db->get($tbl);
    }

    public function selectAllOrderby($tbl,$col,$order){
        $this->db->order_by($col,$order);
        return $this->db->get($tbl);
    }

    public function delData($w,$t){
        $this->db->where($w);
        $this->db->delete($t);
        return $this->db->affected_rows();
    }

    public function thnInv(){
        $this->db->select('YEAR(a.tgl_invoice) as thn');
        $this->db->from('invoice a');
        $this->db->group_by('YEAR(a.tgl_invoice)');
        $this->db->order_by('YEAR(a.tgl_invoice)','asc');
        return $this->db->get();
    }

    public function namaBulan($bln){
        switch($bln){
            case 1:
                echo 'JANUARY';
            break;

            case 2:
                echo 'FEBRUARY';
            break;

            case 3:
                echo 'MARCH';
            break;

            case 4:
                echo 'APRIL';
            break;

            case 5:
                echo 'MAY';
            break;

            case 6:
                echo 'JUNE';
            break;

            case 7:
                echo 'JULY';
            break;

            case 8:
                echo 'AUGUST';
            break;

            case 9:
                echo 'SEPTEMBER';
            break;

            case 10:
                echo 'OCTOBER';
            break;

            case 11:
                echo 'NOVEMBER';
            break;

            case 12:
                echo 'DECEMBER';
            break;
        }
    }

    public function reportInv($yr){
        $mytgl = '';
        if($yr != NULL){$mytgl = date('Y-m-d',strtotime($yr));}
        $this->db->select('*,a.diskon_persen as diskon');
        $this->db->from('invoice a');
        $this->db->join('d_invoice b','a.id=b.id_invoice');
        $this->db->where('a.tgl_invoice >= ',$mytgl.' 00:00:00');
        $this->db->where('a.tgl_invoice <= ',$mytgl.' 23:59:59');
        $this->db->order_by('a.tgl_invoice','asc');
        return $this->db->get();
    }

    // public function reportInv1($yr,$bln){
    //     $this->db->select('*,a.diskon_persen as diskon');
    //     $this->db->from('invoice a');
    //     $this->db->join('d_invoice b','a.id=b.id_invoice');
    //     $this->db->where('MONTH(a.tgl_invoice)',$bln);
    //     $this->db->where('YEAR(a.tgl_invoice)',$yr);
    //     $this->db->order_by('a.tgl_invoice','asc');
    //     return $this->db->get();
    // }

}