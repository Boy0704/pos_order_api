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

    public function upload_excel()
    {
        unlink('upload/import_data.xlsx');
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Fungsi untuk melakukan proses upload file
        $return = array();
        $this->load->library('upload'); // Load librari upload
            
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = 'import_data';
    
        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('uploadexcel')){ // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            // return $return;
        }else{
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            // return $return;
        }
        // print_r($return);exit();
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('upload/import_data.xlsx'); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
        $data = array();

    
        $numrow = 1;
        foreach($sheet as $row){
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            
            if($numrow > 1){
                // Kita push (add) array data ke variabel data
                
                // $actualdate_du = date('Y-m-d',$temp_du);
                array_push($data, array(
                    'invoice' => $row['A'],
                    'tanggal_order' => $row['B'],
                    'produk' => $row['C'],
                    'sku' => $row['D'],
                    'varian' => $row['E'],
                    'sales' => $row['F'],
                    'qty' => $row['G'],
                    'total_order' => $row['H'],
                    'customer' => $row['I'],
                    'no_telp' => $row['J'],
                    'alamat_customer' => $row['K'],
                    'kategori_customer' => $row['L'],
                    'kurir' => $row['M'],
                    'biaya_kirim' => $row['N'],
                    'status_kirim' => '',
                    'status_bayar' => '',
                    'date_create' => get_waktu()
                   
                ));
            }
            
            $numrow++; // Tambah 1 setiap kali looping
        }
        // echo "<pre>";
        // print_r($data);exit;

        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        $this->db->insert_batch('pos_order', $data);
        
        $this->session->set_flashdata('message',alert_biasa('Import data excel berhasil','success'));
        redirect('pos_order','refresh');

        
    }

    



    

	
}
