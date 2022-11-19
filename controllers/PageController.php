<?php 

namespace App\Controllers;

class PageController{
    public function index()
    {
        // return $_GET['q'];
        return "from page controller";
    }

    public function create()
    {
        return "Page create";
    }

    public function edit($id='')
    {
        return "Page edit". $id;
    }
}

