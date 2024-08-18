<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_model extends CI_Model {

    private $apiUrl = 'http://localhost:8080/api/lokasi';

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

    // Fetch all Lokasi
    public function get_all_lokasi() {
        $response = $this->execute_curl($this->apiUrl);
        return json_decode($response, true);
    }

    // Fetch Lokasi by ID
    public function get_lokasi_by_id($id) {
        $response = $this->execute_curl($this->apiUrl . '/' . $id);
        return json_decode($response, true);
    }

    // Create new Lokasi
    public function create_lokasi($data) {
        $response = $this->execute_curl($this->apiUrl, 'POST', $data);
        return json_decode($response, true);
    }

    // Update Lokasi by ID
    public function update_lokasi($id, $data) {
        $response = $this->execute_curl($this->apiUrl . '/' . $id, 'PUT', $data);
        return json_decode($response, true);
    }

    // Delete Lokasi by ID
    public function delete_lokasi($id) {
        $response = $this->execute_curl($this->apiUrl . '/' . $id, 'DELETE');
        return json_decode($response, true);
    }
}
