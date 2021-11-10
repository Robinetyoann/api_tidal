<?php

function get_token() {
    $headers = getallheaders();
    if(isset($headers['Authorization'])){
        return explode(' ',trim($headers['Authorization']))[1];
    }else{
        return null;
    }
    
}