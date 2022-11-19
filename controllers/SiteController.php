<?php 

namespace App\Controllers;

use App\Core\App;
use App\Core\Controller;
use App\Core\Request;

class SiteController extends Controller{

    public function home()
    {
        $params = [
            'name' => 'Rabby MVC!'
        ];
        return $this->view('home', $params);
    }

    public function handleContact(Request $request)
    {
        var_dump($request->getBody());exit;
        $body = $request->getBody();
        return 'Contact Post!';
    }

    public function contact()
    {
        return $this->view('contact');
    }

    public function blogs()
    {
        return $this->view('blogs');
    }
}