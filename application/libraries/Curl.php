<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl {
    private $url = '';
    private $options = array();
    private $headers = array();
    private $post_data = array();
    private $put_data = array();
    private $error_code = 0;
    private $error_string = '';

    public function __construct() {
        if (!extension_loaded('curl')) {
            throw new Exception('The cURL extension is not loaded');
        }
    }

    public function create($url) {
        $this->url = $url;
        $this->options = array();
        $this->headers = array();
        $this->post_data = array();
        $this->put_data = array();
        $this->error_code = 0;
        $this->error_string = '';
        return $this;
    }

    public function option($code, $value) {
        $this->options[$code] = $value;
        return $this;
    }

    public function post($data = array()) {
        $this->options[CURLOPT_POST] = TRUE;
        $this->options[CURLOPT_POSTFIELDS] = http_build_query($data);
        return $this;
    }

    public function put($data = array()) {
        $this->options[CURLOPT_CUSTOMREQUEST] = 'PUT';
        $this->options[CURLOPT_POSTFIELDS] = http_build_query($data);
        return $this;
    }

    public function execute() {
        $ch = curl_init($this->url);

        // Set default options
        $this->options[CURLOPT_RETURNTRANSFER] = TRUE;
        $this->options[CURLOPT_FOLLOWLOCATION] = TRUE;
        $this->options[CURLOPT_SSL_VERIFYPEER] = FALSE;
        $this->options[CURLOPT_SSL_VERIFYHOST] = FALSE;

        // Set headers
        if (!empty($this->headers)) {
            $this->options[CURLOPT_HTTPHEADER] = $this->headers;
        }

        // Set options
        curl_setopt_array($ch, $this->options);

        // Execute request
        $response = curl_exec($ch);

        // Get error information
        $this->error_code = curl_errno($ch);
        $this->error_string = curl_error($ch);

        // Close connection
        curl_close($ch);

        return $response;
    }

    public function get_error_code() {
        return $this->error_code;
    }

    public function get_error_string() {
        return $this->error_string;
    }
} 