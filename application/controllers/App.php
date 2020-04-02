<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public $image = '';
	
	public function index()
	{
        //log_r($this->session->userdata());
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function wilayah()
	{
        //log_r($this->session->userdata());
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
		$data = array(
			'konten' => 'wilayah/wilayah_list',
            'judul_page' => 'Wilayah Gudang',
		);
		$this->load->view('v_index', $data);
    }

    public function add_wilayah()
	{
        //log_r($this->session->userdata());
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
		
        if ($_GET) {
            //cek di data wilayah
            $gudang = $this->uri->segment(3);
            $provinsi = $_GET['provinsi'];
            $cek = $this->db->get_where('wilayah', array('id_provinsi'=>$provinsi));
            if ($cek->num_rows() > 0) {
                # code...
            } else {
                foreach ($this->db->get_where('kabupaten', array('id_provinsi'=>$provinsi))->result() as $key => $value) {
                    $this->db->insert('wilayah', array(
                        'id_gudang'=>$gudang,
                        'id_kabupaten'=>$value->id_kabupaten,
                        'id_provinsi'=>$value->id_provinsi,
                        'aktif'=>'tidak'
                    ));
                }
            }

            $data = array(
                'konten' => 'wilayah/wilayah_add',
                'judul_page' => 'Gudang : <b> '.get_data('gudang','id_gudang',$this->uri->segment(3),'nama_gudang').' </b>',
                'kab' => $this->db->get_where('kabupaten', array('id_provinsi'=>$provinsi))
            );
            $this->load->view('v_index', $data);
        } else {
            $data = array(
                'konten' => 'wilayah/wilayah_add',
                'judul_page' => 'Gudang : <b> '.get_data('gudang','id_gudang',$this->uri->segment(3),'nama_gudang').' </b>',
            );
            $this->load->view('v_index', $data);
        }
    }

    public function update_wilayah($id_kabupaten,$id_gudang,$status)
    {
        $sts = ($status=='ya') ? 'tidak' : 'ya' ;
        $this->db->where('id_kabupaten', $id_kabupaten);
        $this->db->where('id_gudang', $id_gudang);
        $this->db->update('wilayah', array('aktif'=>$sts));
        
        echo json_encode(array('a'=>'berhasil'));
    }

    



    

	
}
