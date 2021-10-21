<?php

namespace App\Controllers;

class DashboardUser extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $userModel = new \App\Models\UserModel();
        $bookModel = new \App\Models\BookModel();
        $rentModel = new \App\Models\rentModel();

        if (session()->get('idUser')) {
            $userData = $userModel->select('idUser, nama, email, username, password, picture')->where('idUser', session()->get('idUser'))->first();
        }

        $number = 1;
        $numberPerPage = 2;

        if ($this->request->getGet('keywordSearch')) {
            $bookModel->like('title',$this->request->getGet('keywordSearch'))->orLike('author',$this->request->getGet('keywordSearch'));
        }

        if ($this->request->getGet('page_book')) {
            $number = (int) $this->request->getGet('page_book') * $numberPerPage - ($numberPerPage - 1);
        }

        $key = [
            'idUser' => session()->get('idUser'),
            'status' => 'pending'
        ];

        $data = [
          'title' => 'User',
            'userData' => $userData,
            'users' => $bookModel->paginate($numberPerPage,'book'),
            'pager' => $bookModel->pager,
            'rentData' => $rentModel->where($key)->findAll(),
            'acceptCount' => count($rentModel->where('status', 'accept')->where('idUser', session()->get('idUser'))->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->where('idUser', session()->get('idUser'))->findAll()),
            'number' => $number
        ];
        return view('DashboardUser/ViewComponent', $data);
    }

    public function rentBook() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $stokBook = $bookModel->where('idBook', $this->request->getPost('getIdBook'))->first()["stok"];

        if ((int) $stokBook === 0) {
            session()->setFlashdata('successAddNewBook','Book stock has run out');
            return redirect()->back();
        }
        $db = \Config\Database::connect();

        if ($rentModel->where('idBook',$this->request->getPost('getIdBook'))->where('idUser', session()->get('idUser'))->where('status', 'pending')->first()
        || $rentModel->where('idBook',$this->request->getPost('getIdBook'))->where('idUser', session()->get('idUser'))->where('status', 'accept')->first()) {
            session()->setFlashdata('successAddNewBook','The book has been processed on request');
            return redirect()->back();
        } else {
            try {
                $bytes = random_bytes(2);

                $data = [
                    'idRent' => 'RENT-'.bin2hex($bytes),
                    'idUser' => session()->get('idUser'),
                    'idBook' => $this->request->getPost('getIdBook'),
                    'status' => 'pending'
                ];
                $rentModel->insert($data);
                if ($db->affectedRows()) {
                    session()->setFlashdata('notifications','Wait until the admin confirms your book accept request');
                    return redirect()->back();
                } else {
                    d("FAILS");
                }
            } catch (\Exception $e) {

            }
        }
    }

    public function cancelRentBook() {
        $rentModel = new \App\Models\rentModel();
        $db = \Config\Database::connect();

        try {
            $rentModel->where('idBook',$this->request->getPost('getIdBook'))->where('idUser', session()->get('idUser'))->delete();
            if ($db->affectedRows()) {
                session()->setFlashdata('notifications','Book request has been cancelled');
                return redirect()->back();
            } else {
                d("FAILS");
            }
        } catch (\Exception $e) {

        }
    }

    public function pendingBook() {

        $db = \Config\Database::connect();
        $userModel = new \App\Models\UserModel();
        $rentModel = new \App\Models\rentModel();

        if (session()->get('idUser')) {
            $userData = $userModel->select('idUser, nama, email, username, password, picture')->where('idUser', session()->get('idUser'))->first();
        }

        $number = 1;
        $numberPerPage = 2;

        if ($this->request->getGet('page_rent')) {
            $number = (int) $this->request->getGet('page_rent') * $numberPerPage - ($numberPerPage - 1);
        }

        if ($this->request->getGet('keywordSearch')) {
            $rentModel->like('idRent', $this->request->getGet('keywordSearch'))->orLike('title', $this->request->getGet('keywordSearch'));
        }

        $key = [
            'idUser' => session()->get('idUser'),
            'status' => 'pending'
        ];

        $data = [
            'title' => 'User',
            'userData' => $userData,
            'users' => $rentModel->select("*")->join('book', 'book.idBook = rent.idBook')->where('status','pending')->where('idUser', session()->get('idUser'))->paginate(2,'rent'),
            'pager' => $rentModel->pager,
            'rentData' => $rentModel->where($key)->findAll(),
            'acceptCount' => count($rentModel->where('status', 'accept')->where('idUser', session()->get('idUser'))->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->where('idUser', session()->get('idUser'))->findAll()),
            'number' => $number
        ];
        return view('DashboardUser/ViewPendingBook', $data);
    }

    public function getIDUserAjax() {
        $userModel = new \App\Models\UserModel();

        if ($this->request->isAJAX()) {
             $idUser = $this->request->getPost('idUser');
            return json_encode($userModel->where('idUser', $idUser)->first());
        }
    }

    public function getIDBookAjax() {
        $bookModel = new \App\Models\BookModel();

        if ($this->request->isAJAX()) {
            $idBook = $this->request->getPost('idBook');
            return json_encode($bookModel->where('idBook',$idBook)->first());
        }
    }

    public function logoutUser() {
        session()->destroy();
        return redirect()->to('/user');
    }

    public function acceptBook() {
        $db = \Config\Database::connect();
        $userModel = new \App\Models\UserModel();
        $rentModel = new \App\Models\rentModel();

        if (session()->get('idUser')) {
            $userData = $userModel->select('idUser, nama, email, username, password, picture')->where('idUser', session()->get('idUser'))->first();
        }

        $number = 1;
        $numberPerPage = 2;

        if ($this->request->getGet('page_rent')) {
            $number = (int) $this->request->getGet('page_rent') * $numberPerPage - ($numberPerPage - 1);
        }

        if ($this->request->getGet('keywordSearch')) {
            $rentModel->like('idRent', $this->request->getGet('keywordSearch'))->orLike('title', $this->request->getGet('keywordSearch'));
        }

        $key = [
            'idUser' => session()->get('idUser'),
            'status' => 'pending'
        ];

        $data = [
            'title' => 'User',
            'userData' => $userData,
            'users' => $rentModel->select("*")->join('book', 'book.idBook = rent.idBook')->where('status','accept')->where('idUser', session()->get('idUser'))->paginate(2,'rent'),
            'pager' => $rentModel->pager,
            'rentData' => $rentModel->where($key)->findAll(),
            'acceptCount' => count($rentModel->where('status', 'accept')->where('idUser', session()->get('idUser'))->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->where('idUser', session()->get('idUser'))->findAll()),
            'number' => $number
        ];
        return view('DashboardUser/ViewAcceptBook', $data);
    }

    public function returnBook() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $db = \Config\Database::connect();

        $getIDBook = $this->request->getPost("getIdBook");
        $idUser = session()->get("idUser");
        $stokBook = (int) $bookModel->where('idBook', $getIDBook)->first()["stok"];

        try {
            $bookModel->where('idBook', $getIDBook)->set('stok', $stokBook + 1)->update();

            if ($db->affectedRows()) {
                $rentModel->where('idUser', $idUser)->where('idBook', $getIDBook)->set('status', 'complete')->update();
                if ($db->affectedRows()) {
                    session()->setFlashdata('notifications','The book has been returned');
                    return redirect()->back();
                }
            }
        } catch (\ReflectionException $e) {
        }
    }

    public function declineBook() {
        $db = \Config\Database::connect();
        $userModel = new \App\Models\UserModel();
        $rentModel = new \App\Models\rentModel();

        if (session()->get('idUser')) {
            $userData = $userModel->select('idUser, nama, email, username, password, picture')->where('idUser', session()->get('idUser'))->first();
        }

        $number = 1;
        $numberPerPage = 2;

        if ($this->request->getGet('page_rent')) {
            $number = (int) $this->request->getGet('page_rent') * $numberPerPage - ($numberPerPage - 1);
        }

        if ($this->request->getGet('keywordSearch')) {
            $rentModel->like('idRent', $this->request->getGet('keywordSearch'))->orLike('title', $this->request->getGet('keywordSearch'));
        }

        $key = [
            'idUser' => session()->get('idUser'),
            'status' => 'pending'
        ];

        $data = [
            'title' => 'User',
            'userData' => $userData,
            'users' => $rentModel->select("*")->join('book', 'book.idBook = rent.idBook')->where('status','decline')->where('idUser', session()->get('idUser'))->paginate(2,'rent'),
            'pager' => $rentModel->pager,
            'rentData' => $rentModel->where($key)->findAll(),
            'acceptCount' => count($rentModel->where('status', 'accept')->where('idUser', session()->get('idUser'))->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->where('idUser', session()->get('idUser'))->findAll()),
            'number' => $number
        ];
        return view('DashboardUser/ViewDeclineBook', $data);
    }

    public function retryRequestBook() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $db = \Config\Database::connect();

        try {
            $rentModel->where("idBook", $this->request->getPost("getIdBook"))->where("idrent", $this->request->getPost("getIdRent"))->set('status', 'pending')->update();

            if ($db->affectedRows()) {
                session()->setFlashdata('notifications','Re-request is being processed');
                return redirect()->back();
            }

        } catch (\ReflectionException $e) {
        }
    }
}