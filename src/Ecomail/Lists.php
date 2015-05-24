<?php

class Ecomail_Lists {
    public function __construct(Ecomail $master) {
        $this->master = $master;
    }
    
    /**
     * Update the pattern or webhook of an existing inbound mailbox route. If null is provided for any fields, the values will remain unchanged.
     * @param string $id the unique identifier of an existing mailbox route
     * @param string $pattern the search pattern that the mailbox name should match
     * @param string $url the webhook URL where the inbound messages will be published
     * @return struct the updated mailbox route information
     *     - id string the unique identifier of the route
     *     - pattern string the search pattern that the mailbox name should match
     *     - url string the webhook URL where inbound messages will be published
     */
    public function updateRoute($id, $pattern=null, $url=null) {
        $_params = array("id" => $id, "pattern" => $pattern, "url" => $url);
        return $this->master->call('inbound/update-route', $_params);
    }

}