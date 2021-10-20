<?php

function get_token() {
    $headers = getallheaders();
    return explode(' ',trim($headers['Authorization']))[1];
}