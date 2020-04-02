<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kabupaten extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kabupaten_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kabupaten/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kabupaten/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kabupaten/index.html';
            $config['first_url'] = base_url() . 'kabupaten/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kabupaten_model->total_rows($q);
        $kabupaten = $this->Kabupaten_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kabupaten_data' => $kabupaten,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'kabupaten/kabupaten_list',
            'konten' => 'kabupaten/kabupaten_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kabupaten' => $row->id_kabupaten,
		'kabupaten' => $row->kabupaten,
		'id_provinsi' => $row->id_provinsi,
	    );
            $this->load->view('kabupaten/kabupaten_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'kabupaten/kabupaten_form',
            'konten' => 'kabupaten/kabupaten_form',
            'button' => 'Create',
            'action' => site_url('kabupaten/create_action'),
	    'id_kabupaten' => set_value('id_kabupaten'),
	    'kabupaten' => set_value('kabupaten'),
	    'id_provinsi' => set_value('id_provinsi'),
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
		'kabupaten' => $this->input->post('kabupaten',TRUE),
		'id_provinsi' => $this->input->post('id_provinsi',TRUE),
	    );

            $this->Kabupaten_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'kabupaten/kabupaten_form',
                'konten' => 'kabupaten/kabupaten_form',
                'button' => 'Update',
                'action' => site_url('kabupaten/update_action'),
		'id_kabupaten' => set_value('id_kabupaten', $row->id_kabupaten),
		'kabupaten' => set_value('kabupaten', $row->kabupaten),
		'id_provinsi' => set_value('id_provinsi', $row->id_provinsi),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kabupaten', TRUE));
        } else {
            $data = array(
		'kabupaten' => $this->input->post('kabupaten',TRUE),
		'id_provinsi' => $this->input->post('id_provinsi',TRUE),
	    );

            $this->Kabupaten_model->update($this->input->post('id_kabupaten', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);

        if ($row) {
            $this->Kabupaten_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kabupaten'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required');
	$this->form_validation->set_rules('id_provinsi', 'id provinsi', 'trim|required');

	$this->form_validation->set_rules('id_kabupaten', 'id_kabupaten', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kabupaten.php */
/* Location: ./application/controllers/Kabupaten.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-04-02 12:09:33 */
/* https://jualkoding.com */