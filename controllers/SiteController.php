<?php 

namespace App\Controllers;

use App\Core\App;
use App\Core\Request;
use App\Core\Response;
use App\Core\Controller;
use App\Models\ContactForm;

class SiteController extends Controller{

    public function home()
    {
        $params = [
            'title' => 'title',
            'name' => 'Rabby MVC!'
        ];
        return $this->view('home', $params);
    }

    // public function handleContact(Request $request)
    // {
    //     var_dump($request->getBody());exit;
    //     $body = $request->getBody();
    //     return 'Contact Post!';
    // }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                App::$app->session->setFlash('success','Thanks for contacting us!');
                return $response->redirect('/contact');
            }
        }
        
        return $this->view('contact', [
            'model' => $contact
        ]);
    }

    public function blogs()
    {
        return $this->view('blogs');
    }
}