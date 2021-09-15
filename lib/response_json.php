<?php 
function json($code, $data)
{
    if($code <400)
    {
        echo json_encode([
            'success' => true,
            'code'=>$code,
            'data' => $data
        ]);
    }else{
        echo json_encode([
            'success' => false,
            'code'=>$code,
            'error' => $data
        ]);
    }
}