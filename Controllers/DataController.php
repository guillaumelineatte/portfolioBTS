<?php

namespace Controllers;

class DataController extends Controller {

    public function index($url) {
    
        $connectUserAge="25";
        echo $this->twig-> render('data.html', ['connectUserAge' => $connectUserAge]);
    }

    public function list($url) {
        var_dump($url);
        $data="jjjjj";
        echo $this->twig-> render('list.html', ['data' => $data]);
    }    
}
?>