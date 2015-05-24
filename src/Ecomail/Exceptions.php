<?php

class Ecomail_Error extends Exception {}
class Ecomail_HttpError extends Mandrill_Error {}

/**
 * The parameters passed to the API call are invalid or not provided when required
 */
class Ecomail_ValidationError extends Ecomail_Error {}

/**
 * The provided API key is not a valid Mandrill API key
 */
class Ecomail_Invalid_Key extends Ecomail_Error {}