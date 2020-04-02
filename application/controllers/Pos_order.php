<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pos_order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pos_order_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pos_order/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pos_order/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pos_order/index.html';
            $config['first_url'] = base_url() . 'pos_order/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pos_order_model->total_rows($q);
        $pos_order = $this->Pos_order_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pos_order_data' => $pos_order,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'pos_order/pos_order_list',
            'konten' => 'pos_order/pos_order_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Pos_order_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'invoice' => $row->invoice,
		'tanggal_order' => $row->tanggal_order,
		'produk' => $row->produk,
		'sku' => $row->sku,
		'varian' => $row->varian,
		'sales' => $row->sales,
		'qty' => $row->qty,
		'total_order' => $row->total_order,
		'customer' => $row->customer,
		'no_telp' => $row->no_telp,
		'alamat_customer' => $row->alamat_customer,
		'kategori_customer' => $row->kategori_customer,
		'kurir' => $row->kurir,
		'biaya_kirim' => $row->biaya_kirim,
		'status_kirim' => $row->status_kirim,
		'status_bayar' => $row->status_bayar,
		'date_create' => $row->date_create,
	    );
            $this->load->view('pos_order/pos_order_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pos_order'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'pos_order/pos_order_form',
            'konten' => 'pos_order/pos_order_form',
            'button' => 'Create',
            'action' => site_url('pos_order/create_action'),
	    'id' => set_value('id'),
	    'invoice' => set_value('invoice'),
	    'tanggal_order' => set_value('tanggal_order'),
	    'produk' => set_value('produk'),
	    'sku' => set_value('sku'),
	    'varian' => set_value('varian'),
	    'sales' => set_value('sales'),
	    'qty' => set_value('qty'),
	    'total_order' => set_value('total_order'),
	    'customer' => set_value('customer'),
	    'no_telp' => set_value('no_telp'),
	    'alamat_customer' => set_value('alamat_customer'),
	    'kategori_customer' => set_value('kategori_customer'),
	    'kurir' => set_value('kurir'),
	    'biaya_kirim' => set_value('biaya_kirim'),
	    'status_kirim' => set_value('status_kirim'),
	    'status_bayar' => set_value('status_bayar'),
	    'date_create' => set_value('date_create'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'invoice' => $this->input->post('invoice',TRUE),
		'tanggal_order' => $this->input->post('tanggal_order',TRUE),
		'produk' => $this->input->post('produk',TRUE),
		'sku' => $this->input->post('sku',TRUE),
		'varian' => $this->input->post('varian',TRUE),
		'sales' => $this->input->post('sales',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'total_order' => $this->input->post('total_order',TRUE),
		'customer' => $this->input->post('customer',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'alamat_customer' => $this->input->post('alamat_customer',TRUE),
		'kategori_customer' => $this->input->post('kategori_customer',TRUE),
		'kurir' => $this->input->post('kurir',TRUE),
		'biaya_kirim' => $this->input->post('biaya_kirim',TRUE),
		'status_kirim' => $this->input->post('status_kirim',TRUE),
		'status_bayar' => $this->input->post('status_bayar',TRUE),
		'date_create' => $this->input->post('date_create',TRUE),
	    );

            $this->Pos_order_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pos_order'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pos_order_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'pos_order/pos_order_form',
                'konten' => 'pos_order/pos_order_form',
                'button' => 'Update',
                'action' => site_url('pos_order/update_action'),
		'id' => set_value('id', $row->id),
		'invoice' => set_value('invoice', $row->invoice),
		'tanggal_order' => set_value('tanggal_order', $row->tanggal_order),
		'produk' => set_value('produk', $row->produk),
		'sku' => set_value('sku', $row->sku),
		'varian' => set_value('varian', $row->varian),
		'sales' => set_value('sales', $row->sales),
		'qty' => set_value('qty', $row->qty),
		'total_order' => set_value('total_order', $row->total_order),
		'customer' => set_value('customer', $row->customer),
		'no_telp' => set_value('no_telp', $row->no_telp),
		'alamat_customer' => set_value('alamat_customer', $row->alamat_customer),
		'kategori_customer' => set_value('kategori_customer', $row->kategori_customer),
		'kurir' => set_value('kurir', $row->kurir),
		'biaya_kirim' => set_value('biaya_kirim', $row->biaya_kirim),
		'status_kirim' => set_value('status_kirim', $row->status_kirim),
		'status_bayar' => set_value('status_bayar', $row->status_bayar),
		'date_create' => set_value('date_create', $row->date_create),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pos_order'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'invoice' => $this->input->post('invoice',TRUE),
		'tanggal_order' => $this->input->post('tanggal_order',TRUE),
		'produk' => $this->input->post('produk',TRUE),
		'sku' => $this->input->post('sku',TRUE),
		'varian' => $this->input->post('varian',TRUE),
		'sales' => $this->input->post('sales',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'total_order' => $this->input->post('total_order',TRUE),
		'customer' => $this->input->post('customer',TRUE),
		'no_telp' => $this->input->post('no_telp',TRUE),
		'alamat_customer' => $this->input->post('alamat_customer',TRUE),
		'kategori_customer' => $this->input->post('kategori_customer',TRUE),
		'kurir' => $this->input->post('kurir',TRUE),
		'biaya_kirim' => $this->input->post('biaya_kirim',TRUE),
		'status_kirim' => $this->input->post('status_kirim',TRUE),
		'status_bayar' => $this->input->post('status_bayar',TRUE),
		'date_create' => $this->input->post('date_create',TRUE),
	    );

            $this->Pos_order_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pos_order'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pos_order_model->get_by_id($id);

        if ($row) {
            $this->Pos_order_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pos_order'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pos_order'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('invoice', 'invoice', 'trim|required');
	$this->form_validation->set_rules('tanggal_order', 'tanggal order', 'trim|required');
	$this->form_validation->set_rules('produk', 'produk', 'trim|required');
	$this->form_validation->set_rules('sku', 'sku', 'trim|required');
	$this->form_validation->set_rules('varian', 'varian', 'trim|required');
	$this->form_validation->set_rules('sales', 'sales', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('total_order', 'total order', 'trim|required');
	$this->form_validation->set_rules('customer', 'customer', 'trim|required');
	$this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
	$this->form_validation->set_rules('alamat_customer', 'alamat customer', 'trim|required');
	$this->form_validation->set_rules('kategori_customer', 'kategori customer', 'trim|required');
	$this->form_validation->set_rules('kurir', 'kurir', 'trim|required');
	$this->form_validation->set_rules('biaya_kirim', 'biaya kirim', 'trim|required');
	$this->form_validation->set_rules('status_kirim', 'status kirim', 'trim|required');
	$this->form_validation->set_rules('status_bayar', 'status bayar', 'trim|required');
	$this->form_validation->set_rules('date_create', 'date create', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pos_order.php */
/* Location: ./application/controllers/Pos_order.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-04-02 13:35:45 */
/* https://jualkoding.com */