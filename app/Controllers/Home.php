<?php

namespace App\Controllers;

use App\Models\Identitas;

class Home extends BaseController
{
    protected $editorModel;

    public function __construct()
    {
        $this->editorModel = new Identitas();
    }

    public function index(): string
    {
        $data = ['editor' => $this->editorModel->select('*')];
        return view('index', $data);
    }
}
