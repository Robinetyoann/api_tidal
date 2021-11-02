<?php 
function json($code, $data)
{
    header('Content-Type: application/json');
    http_response_code($code);
    if($code <400)
    {
        file_put_contents('log.txt', $data);
        echo json_encode([
            'success' => true,
            'code'=>$code,
            'data' => $data
        ]);
    }else{
        file_put_contents('log.txt', $data);
        echo json_encode([
            'success' => false,
            'code'=>$code,
            'error' => $data
        ]);
    }
}