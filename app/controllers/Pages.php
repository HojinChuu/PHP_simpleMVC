<?php

class Pages extends Controller
{
    public function __construct()
    {

    }

    public function index() 
    {
        $data = [
            'title' => 'Simple social network',
            'description' => 'Simple social network built on the mvc PHP framework'
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'ABOUT',
            'description' => 'App to share post with other users'
        ];

        $this->view('pages/about', $data);
    }
}