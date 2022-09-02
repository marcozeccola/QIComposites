<?php
class Pages extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');
    }

    public function index() {
        $data = [
            'title' => 'Home page'
        ];
        
        if(isLoggedIn()){ 
            header("location:".URLROOT."/progetti");
        }else{
            header("location:".URLROOT."/users/login");
        }
    }
 
}
