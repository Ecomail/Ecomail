<?php

require_once 'Ecomail/Exceptions.php';
require_once 'Ecomail/Lists.php';

class Ecomail {
    
    public $apikey;
    public $client;
    public $root = 'http://api2.ecomailapp.cz';

    public function __construct($apikey=null) {
        if(!$apikey) $apikey = getenv('ECOMAIL_APIKEY');
        if(!$apikey) $apikey = $this->readConfigs();
        if(!$apikey) throw new Ecomail_Error('You must provide a Ecomail API key');
        $this->apikey = $apikey;

        $this->client = new GuzzleHttp\Client();
        $this->client->setDefaultOption('headers', array('key' => $this->apikey, 'accept' => 'application/json'));
        
        $this->lists = new Ecomail_Lists($this);

    }

    public function readConfigs() {
        $paths = array('~/.ecomail.key', '/etc/ecomail.key');
        foreach($paths as $path) {
            if(file_exists($path)) {
                $apikey = trim(file_get_contents($path));
                if($apikey) return $apikey;
            }
        }
        return false;
    }

    public function castError($result) {
        if($result['status'] !== 'error' || !$result['name']) throw new Ecomail_Error('We received an unexpected error: ' . json_encode($result));

        return new Ecomail_Error($result['message'], $result['code']);
    }
}