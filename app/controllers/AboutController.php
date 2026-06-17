<?php

require_once 'app/core/Controller.php';

class AboutController extends Controller {

    public function index() {
        $this->view('about', [
            'title' => 'Tentang Kami - Second Store'
        ]);
    }
}
