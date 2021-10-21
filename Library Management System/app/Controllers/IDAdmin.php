<?php

namespace App\Controllers;

class IDAdmin extends BaseController
{
    public function index()
    {
        return view('IDAdmin/Views');
    }

    public function getData()
    {
        $db = \Config\Database::connect();

        if ($this->request->isAJAX()) {
            $authIDLibraryModel = new \App\Models\AuthIDLibraryModels();

            $data = [
              'idAdmin' => $this->request->getPost('idAdmin')
            ];

            try {
                $authIDLibraryModel->insert($data);
                if ($db->affectedRows()) {
                    return json_encode('WORK');
                }
            } catch (\ReflectionException $e) {

            }
        }
    }
}
