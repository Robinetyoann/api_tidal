<?php

function body_request() {
    $string_body = file_get_contents('php://input');
    $string_body =  explode('&', $string_body);
    $body = [];

    foreach ($string_body  as $elem) {
        $array = explode('=', $elem);
        array_push($body, [$array[0] => $array[1]]);
    }
    return $body;
}