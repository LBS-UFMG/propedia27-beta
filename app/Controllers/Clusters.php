<?php

namespace App\Controllers;

class Clusters extends BaseController
{
    public function index(): string
    {
        $data = [];
        return view('clusters', $data);
    }
}
