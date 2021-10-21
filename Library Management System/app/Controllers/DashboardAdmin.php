<?php

namespace App\Controllers;

class DashboardAdmin extends BaseController
{
    public function index()
    {
        $adminModel = new \App\Models\AdminModels();
        $bookModel = new \App\Models\BookModel();
        $userModel = new \App\Models\UserModel();
        $rentModel = new \App\Models\rentModel();

        $number = 1;
        $numberPerPage = 2;

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        if ($this->request->getGet('page_book')) {
            $number = (int) $this->request->getGet('page_book') * $numberPerPage - ($numberPerPage - 1);
        }

        if ($this->request->getGet('keywordSearch')) {
            $bookModel->like('title',$this->request->getGet('keywordSearch'))->orLike('author',$this->request->getGet('keywordSearch'));
        }

        $data = [
          'title' => 'Admin',
            'adminData' => $adminData,
            'users' => $bookModel->paginate($numberPerPage,'book'),
            'pager' => $bookModel->pager,
            'listUser' => count($userModel->findAll()),
            'number' => $number,
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
        ];

        return view('DashboardAdmin/ViewComponent', $data);
    }

    public function logoutAdmin() {
        session()->destroy();
        return redirect()->to('/admin');
    }

    public function addBook() {
        $adminModel = new \App\Models\AdminModels();
        $rentModel = new \App\Models\rentModel();
        $userModel = new \App\Models\UserModel();

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        $data = [
            'title' => 'Admin',
            'adminData' => $adminData,
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
            'listUser' => count($userModel->findAll()),
        ];
        return view('DashboardAdmin/AddBookView', $data);
    }

    public function insertNewBook() {
        $validation =  \Config\Services::validation();
        $bookModel = new \App\Models\BookModel();
        $db = \Config\Database::connect();

        $validation->setRules([
                'isbn' => [
                    'label'  => 'ISBN',
                    'rules'  => 'required|is_unique[book.isbn]|alpha_numeric',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'is_unique' => '{field} code already used',
                        'alpha_numeric' => '{field} code can only contain numbers and letters',
                    ],
                ],
                'title' => [
                    'label'  => 'Title',
                    'rules'  => 'required|alpha_numeric_punct|is_unique[book.title]',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'alpha_numeric_punct' => '{field} can only contain numbers, letters and spaces',
                        'is_unique' => '{field} already used',
                    ],
                ],
                'author' => [
                    'label'  => 'Author',
                    'rules'  => 'required|alpha_space',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'alpha_space' => '{field} can only contain letters and spaces'
                    ],
                ],
                'publisher' => [
                    'label'  => 'Publisher',
                    'rules'  => 'required|alpha_numeric_space',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'alpha_numeric_space' => '{field} can only contain numbers, letters and spaces'
                    ],
                ],
                'picture' => [
                    'label'  => 'Picture',
                    'rules'  => 'uploaded[picture]|max_size[picture,3048]|is_image[picture]|ext_in[picture,png,jpg]',
                    'errors' => [
                        'uploaded' => '{field} must have provided',
                        'max_size' => '{field} max size is 3MB',
                        'is_image' => '{field} must be images',
                        'ext_in' => '{field} must be extension png or jpg'
                    ],
                ],
                'stok' => [
                    'label'  => 'Stok',
                    'rules'  => 'required|is_natural',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'is_natural' => '{field} can only contain numbers'
                    ],
                ],
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $isbn = $this->request->getPost('isbn');
            $title = $this->request->getPost('title');
            $author = $this->request->getPost('author');
            $publisher = $this->request->getPost('publisher');
            $picture = $this->request->getFile('picture');
            $newNamePicture = $picture->getRandomName();
            $stok = $this->request->getPost('stok');

            try {
                $data = [
                    'idBook' => 'BOOK-' . bin2hex(random_bytes(2)),
                    'ISBN' => $isbn,
                    'title' => $title,
                    'author' => $author,
                    'publish' => $publisher,
                    'picture' => $newNamePicture,
                    'stok' => $stok
                ];

                $bookModel->insert($data);
                if ($db->affectedRows()) {
                    $picture->move('cover', $newNamePicture);
                    session()->setFlashdata('successAddNewBook', 'New book added successfully');
                    return redirect()->back();
                } else {
                    d("FAILS");
                }
            } catch (\Exception $e) {
            }
        } else {
            session()->setFlashdata([
                'isbn' => $validation->getError('isbn'),
                'title' => $validation->getError('title'),
                'author' => $validation->getError('author'),
                'publisher' => $validation->getError('publisher'),
                'picture' => $validation->getError('picture'),
                'stok' => $validation->getError('stok'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function editBook() {
        $bookModel = new \App\Models\BookModel();
        $adminModel = new \App\Models\AdminModels();
        $rentModel = new \App\Models\rentModel();
        $userModel = new \App\Models\UserModel();

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        $data = [
            'adminData' => $adminData,
            'title' => 'Edit Book',
            'dataBook' => $bookModel->where('idBook', $this->request->getGet('getIdBook'))->first(),
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
            'listUser' => count($userModel->findAll()),
        ];

        return view('DashboardAdmin/EditBookView', $data);
    }

    public function editOldBook() {

//        CHECK FOR ISBN
        if ($this->request->getPost('isbn') === $this->request->getPost('oldISBNBook')) {
            $rules = 'required|';
            $getValueISBN = $this->request->getPost('oldISBNBook');
        } else {
            $rules = 'required|is_unique[book.isbn]|';
            $getValueISBN = $this->request->getPost('isbn');
        }

//        CHECK FOR PICTURE
        if ($this->request->getFile('picture')->getError() === 4) {
            $rulesImage = '';
            $getValuePicture = $this->request->getPost('oldNamePictureBook');
        } else {
            $rulesImage = 'uploaded[picture]|';
            $deleteOldPicture = $this->request->getPost('oldNamePictureBook');
            $getPicture = $this->request->getFile('picture');
            $getValuePicture = $getPicture->getRandomName();
        }

        $validation =  \Config\Services::validation();
        $bookModel = new \App\Models\BookModel();
        $db = \Config\Database::connect();

        $validation->setRules([
            'isbn' => [
                'label'  => 'ISBN',
                'rules'  => $rules . 'alpha_numeric',
                'errors' => [
                    'required' => '{field} must have provided',
                    'is_unique' => '{field} code already used',
                    'alpha_numeric' => '{field} code can only contain numbers and letters',
                    ],
                ],
                'title' => [
                    'label'  => 'Title',
                    'rules'  => 'required|alpha_numeric_punct',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'alpha_numeric_punct' => '{field} can only contain numbers, letters and spaces'
                    ],
                ],
                'author' => [
                    'label'  => 'Author',
                    'rules'  => 'required|alpha_space',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'alpha_space' => '{field} can only contain letters and spaces'
                    ],
                ],
                'publisher' => [
                    'label'  => 'Publisher',
                    'rules'  => 'required|alpha_numeric_space',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'alpha_numeric_space' => '{field} can only contain numbers, letters and spaces'
                    ],
                ],
                'picture' => [
                    'label'  => 'Picture',
                    'rules'  => $rulesImage . 'max_size[picture,3048]|is_image[picture]|ext_in[picture,png,jpg]',
                    'errors' => [
                        'uploaded' => '{field} must have provided',
                        'max_size' => '{field} max size is 3MB',
                        'is_image' => '{field} must be images',
                        'ext_in' => '{field} must be extension png or jpg'
                    ],
                ],
                'stok' => [
                    'label'  => 'Stok',
                    'rules'  => 'required|is_natural',
                    'errors' => [
                        'required' => '{field} must have provided',
                        'is_natural' => '{field} can only contain numbers'
                    ],
                ],
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $data = [
                'ISBN' => $getValueISBN,
                'title' => $this->request->getPost('title'),
                'author' => $this->request->getPost('author'),
                'publish' => $this->request->getPost('publisher'),
                'picture' => $getValuePicture,
                'stok' => $this->request->getPost('stok'),
            ];


            try {
                $bookModel->where('idBook', $this->request->getPost('idBook'))->set($data)->update();
                if ($db->affectedRows()) {
                    session()->setFlashdata('successAddNewBook', 'The book has been changed');

                    if ($this->request->getFile('picture')->getError() !== 4) {
                        $getPicture->move('cover', $getValuePicture);
                        unlink('cover/' . $deleteOldPicture);
                    }

                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }

        } else {
            session()->setFlashdata([
               'isbn' => $validation->getError('isbn'),
               'title' => $validation->getError('title'),
               'author' => $validation->getError('author'),
               'publisher' => $validation->getError('publisher'),
               'picture' => $validation->getError('picture'),
               'stok' => $validation->getError('stok'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function deleteBook() {
        $bookModel = new \App\Models\BookModel();
        $namePicture = $bookModel->where('idBook', $this->request->getPost('getIdBook'))->first()["picture"];
        unlink('cover/' . $namePicture);
        $bookModel->where('idBook', $this->request->getPost('getIdBook'))->delete();
        session()->setFlashdata('message', 'Book deleted successfully');
        return redirect()->back();
    }

    public function getIdBookAjax() {
        $bookModel = new \App\Models\BookModel();
        if ($this->request->isAJAX()) {
            $namePicture = $bookModel->where('idBook', $this->request->getPost('idBook'))->first();
            return json_encode($namePicture);
        }
    }

    public function listUser() {

        $adminModel = new \App\Models\AdminModels();
        $userModel = new \App\Models\UserModel();
        $rentModel = new \App\Models\rentModel();

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        $number = 1;
        $numberPerPage = 2;

        if ($this->request->getGet('keywordSearch')) {
            $userModel->like('nama', $this->request->getGet('keywordSearch'))->orLike('email', $this->request->getGet('keywordSearch'));
        }

        if ($this->request->getGet('page_user')) {
            $number = (int) $this->request->getGet('page_user') * $numberPerPage - ($numberPerPage - 1);
        }

        $data = [
            'title' => 'Admin',
            'adminData' => $adminData,
            'users' => $userModel->paginate($numberPerPage,'user'),
            'pager' => $userModel->pager,
            'listUser' => count($userModel->findAll()),
            'number' => $number,
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
        ];

        return view('DashboardAdmin/ListUserComponent', $data);
    }

    public function deleteUser() {
        $userModel = new \App\Models\UserModel();
        $rentModel = new \App\Models\rentModel();

        $db = \Config\Database::connect();

        $rentModel->where('idUser', $this->request->getPost('getIdUser'))->delete();

        if ($db->affectedRows()) {
            unlink('profile/' . $userModel->where('idUser', $this->request->getPost('getIdUser'))->first()["picture"]);
            $userModel->where('idUser', $this->request->getPost('getIdUser'))->delete();
            session()->setFlashdata('message', 'User deleted successfully');
            return redirect()->to("/dashboardAdmin/listUser");
        } else {
            unlink('profile/' . $userModel->where('idUser', $this->request->getPost('getIdUser'))->first()["picture"]);
            $userModel->where('idUser', $this->request->getPost('getIdUser'))->delete();
            session()->setFlashdata('message', 'User deleted successfully');
            return redirect()->to("/dashboardAdmin/listUser");
        }
    }

    public function pendingRequest() {

        $adminModel = new \App\Models\AdminModels();
        $userModel = new \App\Models\UserModel();
        $rentModel = new \App\Models\rentModel();

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        if ($this->request->getGet('keywordSearch')) {
            $rentModel->like('nama',$this->request->getGet('keywordSearch'))->orLike('title',$this->request->getGet('keywordSearch'));
        }

        $number = 1;
        $numberPerPage = 2;

        if ($this->request->getGet('page_rent')) {
            $number = (int) $this->request->getGet('page_rent') * $numberPerPage - ($numberPerPage - 1);
        }

        $data = [
            'title' => 'Admin',
            'adminData' => $adminData,
            'listUser' => count($userModel->findAll()),
            'users' => $rentModel->join('user','user.idUser = rent.idUser')->join('book','book.idBook = rent.idBook')->where('status', 'pending')->paginate($numberPerPage,'rent'),
            'pager' => $rentModel->pager,
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
            'number' => $number
        ];

        return view("DashboardAdmin/PendingBookViews", $data);
    }

    public function getIDUserAjax() {
        $userModel = new \App\Models\UserModel();

        if ($this->request->isAJAX()) {
            $idUser = $this->request->getPost('idUser');
            return json_encode($userModel->where('idUser', $idUser)->first());
        }
    }

    public function deleteRequest() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $db = \Config\Database::connect();

        $getIDBook = $rentModel->where('idRent', $this->request->getPost('getIdRent'))->first()["idBook"];
        $stokBook = (int) $bookModel->where('idBook', $getIDBook)->first()["stok"];

        try {
            $rentModel->where('idRent', $this->request->getPost('getIdRent'))->delete();
            if ($db->affectedRows()) {
                session()->setFlashdata('notifications','Book request deleted successfully');
                return redirect()->back();
            } else {
                d("FAILS");
            }
        } catch (\ReflectionException $e) {
        }
    }

    public function acceptRequest() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $adminModel = new \App\Models\AdminModels();
        $db = \Config\Database::connect();

        $getIDBook = $rentModel->where('idRent', $this->request->getPost('getIdRent'))->first()["idBook"];
        $stokBook = (int) $bookModel->where('idBook', $getIDBook)->first()["stok"];
        $usernameAdmin = $adminModel->where('idAdmin', session()->get('idAdmin'))->first()["username"];

        if ($stokBook === 0) {
            session()->setFlashdata('notifications','Sorry, because many requests have been received in this book so the book is out of stock');
            return redirect()->back();
        }

        try {
            $bookModel->where('idBook', $getIDBook)->set('stok', $stokBook - 1)->update();
            if ($db->affectedRows()) {
                $dataUpdate = [
                    'status' => 'accept',
                    'usernameAdmin' => $usernameAdmin
                ];
                $rentModel->where('idRent', $this->request->getPost('getIdRent'))->set($dataUpdate)->update();
                if ($db->affectedRows()) {
                    session()->setFlashdata('notifications','Book request has been accepted');
                    return redirect()->back();
                }
            } else {
                d("FAILS");
            }
        } catch (\ReflectionException $e) {

        }
    }

    public function acceptUser() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $adminModel = new \App\Models\AdminModels();
        $userModel = new \App\Models\UserModel();

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        if ($this->request->getGet('keywordSearch')) {
            $rentModel->like('nama',$this->request->getGet('keywordSearch'))->orLike('title',$this->request->getGet('keywordSearch'));
        }

        $number = 1;
        $numberPerPage = 2;

        if ($this->request->getGet('page_rent')) {
            $number = (int) $this->request->getGet('page_rent') * $numberPerPage - ($numberPerPage - 1);
        }

        $data = [
            'title' => 'Admin',
            'adminData' => $adminData,
            'users' => $rentModel->join('user','user.idUser = rent.idUser')->join('book','book.idBook = rent.idBook')->where('status', 'accept')->paginate($numberPerPage,'rent'),
            'pager' => $rentModel->pager,
            'listUser' => count($userModel->findAll()),
            'number' => $number,
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
        ];

        return view("DashboardAdmin/AcceptBookViews", $data);
    }

    public function cancelAcceptRequest() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $adminModel = new \App\Models\AdminModels();
        $db = \Config\Database::connect();

        $getIDBook = $rentModel->where('idRent', $this->request->getPost('getIdRent'))->first()["idBook"];
        $stokBook = (int) $bookModel->where('idBook', $getIDBook)->first()["stok"];
        $usernameAdmin = $adminModel->where('idAdmin', session()->get('idAdmin'))->first()["username"];

        try {
            $bookModel->where('idBook', $getIDBook)->set('stok', $stokBook + 1)->update();
            if ($db->affectedRows()) {

                $data = [
                    'status' => 'pending',
                    'usernameAdmin' => $usernameAdmin
                ];

                $rentModel->where('idRent', $this->request->getPost('getIdRent'))->set($data)->update();
                if ($db->affectedRows()) {
                    session()->setFlashdata('notifications','Book request has been cancelled');
                    return redirect()->back();
                }
            }
        } catch (\ReflectionException $e) {
        }
    }

    public function declineRequest() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $adminModel = new \App\Models\AdminModels();
        $userModel = new \App\Models\UserModel();

        $number = 1;
        $numberPerPage = 2;

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        if ($this->request->getGet('page_rent')) {
            $number = (int) $this->request->getGet('page_rent') * $numberPerPage - ($numberPerPage - 1);
        }

        if ($this->request->getGet('keywordSearch')) {
            $rentModel->like('nama',$this->request->getGet('keywordSearch'))->orLike('title',$this->request->getGet('keywordSearch'));
        }


        $data = [
            'title' => 'Admin',
            'adminData' => $adminData,
            'users' => $rentModel->join('user','user.idUser = rent.idUser')->join('book','book.idBook = rent.idBook')->where('status', 'decline')->paginate($numberPerPage,'rent'),
            'pager' => $rentModel->pager,
            'listUser' => count($userModel->findAll()),
            'number' => $number,
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
        ];

        return view("DashboardAdmin/DeclineBookViews", $data);
    }

    public function declineUser() {
        $rentModel = new \App\Models\rentModel();
        $adminModel = new \App\Models\AdminModels();
        $db = \Config\Database::connect();

        $usernameAdmin = $adminModel->where('idAdmin', session()->get('idAdmin'))->first()["username"];
        $idRent = $this->request->getPost("getIdRent");

        try {
            $data = [
                'usernameAdmin' => $usernameAdmin,
                'status' => 'decline'
            ];
            $rentModel->where('idRent', $idRent)->set($data)->update();

            if ($db->affectedRows()) {
                session()->setFlashdata('notifications','Book request has been decline');
                return redirect()->back();
            }
        } catch (\ReflectionException $e) {

        }
    }

    public function completeRead() {
        $rentModel = new \App\Models\rentModel();
        $bookModel = new \App\Models\BookModel();
        $adminModel = new \App\Models\AdminModels();
        $userModel = new \App\Models\UserModel();

        $number = 1;
        $numberPerPage = 2;

        if (session()->get('idAdmin')) {
            $adminData = $adminModel->select('idAdmin, nama, email, username, password, picture')->where('idAdmin', session()->get('idAdmin'))->first();
        }

        if ($this->request->getGet('page_rent')) {
            $number = (int) $this->request->getGet('page_rent') * $numberPerPage - ($numberPerPage - 1);
        }

        if ($this->request->getGet('keywordSearch')) {
            $rentModel->like('nama',$this->request->getGet('keywordSearch'))->orLike('title',$this->request->getGet('keywordSearch'));
        }

        $data = [
            'title' => 'Admin',
            'adminData' => $adminData,
            'users' => $rentModel->join('user','user.idUser = rent.idUser')->join('book','book.idBook = rent.idBook')->where('status', 'complete')->paginate($numberPerPage,'rent'),
            'pager' => $rentModel->pager,
            'listUser' => count($userModel->findAll()),
            'number' => $number,
            'pendingCount' => count($rentModel->where('status', 'pending')->findAll()),
            'acceptCount' => count($rentModel->where('status', 'accept')->findAll()),
            'declineCount' => count($rentModel->where('status', 'decline')->findAll()),
            'completeCount' => count($rentModel->where('status', 'complete')->findAll()),
        ];

        return view("DashboardAdmin/CompleteViewBook", $data);
    }
}
