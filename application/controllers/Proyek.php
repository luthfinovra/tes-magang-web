<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Proyek_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['proyek'] = $this->Proyek_model->get_all_proyek();
        $this->load->view('proyek/home', $data);
    }

    public function create() {
        $this->form_validation->set_rules('nama_proyek', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('client', 'Client', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('proyek/create');
        } else {
            $data = $this->input->post();
            $this->Proyek_model->create_proyek($data);
            redirect('proyek');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('nama_proyek', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('client', 'Client', 'required');

        if ($this->input->post()) {
            if ($this->form_validation->run() == FALSE) {
                $data['proyek'] = $this->Proyek_model->get_proyek_by_id($id);
                $this->load->view('proyek/edit', $data);
            } else {
                $data = $this->input->post();
                $this->Proyek_model->update_proyek($id, $data);
                redirect('proyek');
            }
        } else {
            $data['proyek'] = $this->Proyek_model->get_proyek_by_id($id);
            $this->load->view('proyek/edit', $data);
        }
    }

    public function delete($id) {
        $this->Proyek_model->delete_proyek($id);
        redirect('proyek');
    }

    public function view($id) {
        $result = $this->Proyek_model->get_proyek_by_id($id);
        
        if ($result && isset($result['data'])) {
            $data = [
                'proyek' => $result['data']
            ];
            $this->load->view('proyek/view', $data);
        } else {
            show_404();
        }
    }
}
