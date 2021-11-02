<?php 
function json($code, $data) {
    
    http_response_code($code);
    header('Content-Type: application/json');
    if($code <400) {
        file_put_contents('log.txt', $data);
        echo json_encode([
            'success' => true,
            'code'=>$code,
            'data' => json_encode($data)
        ]);
    } else {
        file_put_contents('log.txt', $data);
        echo json_encode([
            'success' => false,
            'code'=>$code,
            'error' =>json_encode($data)
        ]);
    }
}