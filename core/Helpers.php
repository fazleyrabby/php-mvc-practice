<?php 

namespace App\Core;

function dd($data){
    echo "<pre style='padding: 6px; background: #111; color: yellow'>";
    var_dump($data);
    echo "</pre>";
    exit;
}


