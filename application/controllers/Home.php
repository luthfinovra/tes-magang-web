<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $data['proyek'] = $this->get_data('proyek');
        $data['lokasi'] = $this->get_data('lokasi');
        $this->load->view('home_view', $data);
    }

    private function get_data($type) {
        $url = 'http://localhost:8080/api/' . $type;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            curl_close($ch);
            return [];
        }

        curl_close($ch);

        $response_data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }
        return isset($response_data['data']['content']) ? $response_data['data']['content'] : [];
    }
}
