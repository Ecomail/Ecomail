<?php

class Ecomail_Account {
    
    public function __construct(Ecomail $master) {
        $this->master = $master;
    }
    
    /**
     * Create new Ecomail account
     * @param string $name unique name of new account
     * @param string $email new account email
     * @param string $password password for new account
     * @return struct created account
     */
    public function create($name, $email, $password) {
        $_params = array("name" => $name, "email" => $email, "password" => $password);
        return $this->master->client->post('account/create', ['body' => $_params]);
    }

}