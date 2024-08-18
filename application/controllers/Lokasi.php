<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Lokasi_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['lokasi'] = $this->Lokasi_model->get_all_lokasi();
        $this->load->view('home', $data);
    }

    public function create() {
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('negara', 'Negara', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('lokasi/create');
        } else {
            $data = $this->input->post();
            $this->Lokasi_model->create_lokasi($data);
            redirect('lokasi');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('negara', 'Negara', 'required');

        if ($this->input->post()) {
            if ($this->form_validation->run() == FALSE) {
                $data['lokasi'] = $this->Lokasi_model->get_lokasi_by_id($id);
                $this->load->view('lokasi/edit', $data);
            } else {
                $data = $this->input->post();
                $this->Lokasi_model->update_lokasi($id, $data);
                redirect('lokasi');
            }
        } else {
            $data['lokasi'] = $this->Lokasi_model->get_lokasi_by_id($id);
            $this->load->view('lokasi/edit', $data);
        }
    }

    public function delete($id) {
        $this->Lokasi_model->delete_lokasi($id);
        redirect('lokasi');
    }

    public function view($id) {
        $this->load->model('Lokasi_model');
        $response = $this->Lokasi_model->get_lokasi_by_id($id);
        
        if (isset($response['data'])) {
            $data['lokasi'] = $response['data'];
        } else {
            $data['lokasi'] = [];
        }
        
        $this->load->view('lokasi/view', $data);
    }
    
}
