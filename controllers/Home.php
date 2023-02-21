<?php

class Home extends Controller
{

    # http://localhost/
    public function index()
    {
        $this->render('index', []);
    }
}