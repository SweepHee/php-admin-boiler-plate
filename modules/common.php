<?php

// 프론트서버에서 보낸 request 받기
function CONVERT_TO_REQUEST()
{
    return json_decode(stripslashes(file_get_contents("php://input")));
}

// 랜덤 문자열 생성하기
function GenerateString($length)
{
    $characters  = "0123456789";
    $characters .= "abcdefghijklmnopqrstuvwxyz";
    $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $characters .= "_";

    $string_generated = "";

    $nmr_loops = $length;
    while ($nmr_loops--)
    {
        $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string_generated;
}
