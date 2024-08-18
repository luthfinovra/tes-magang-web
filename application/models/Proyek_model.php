<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek_model extends CI_Model {

    private $apiUrl = 'http://localhost:8080/api/proyek';

    public function __construct() {
        parent::__construct();
    }

    // Function to execute cURL requests
    private function execute_curl($url, $method = 'GET', $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method == 'POST' || $method == 'PUT') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    // Fetch all Proyek
    public function get_all_proyek() {
        $response = $this->execute_curl($this->apiUrl);
        return json_decode($response, true);
    }

    // Fetch Proyek by ID
    public function get_proyek_by_id($id) {
        $response = $this->execute_curl($this->apiUrl . '/' . $id);
        return json_decode($response, true);
    }

    // Create new Proyek
    public function create_proyek($data) {
        $response = $this->execute_curl($this->apiUrl, 'POST', $data);
        return json_decode($response, true);
    }

    // Update Proyek by ID
    public function update_proyek($id, $data) {
        $response = $this->execute_curl($this->apiUrl . '/' . $id, 'PUT', $data);
        return json_decode($response, true);
    }

    // Delete Proyek by ID
    public function delete_proyek($id) {
        $response = $this->execute_curl($this->apiUrl . '/' . $id, 'DELETE');
        return json_decode($response, true);
    }
}
