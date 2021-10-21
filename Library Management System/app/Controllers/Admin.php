<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        if (session()->get('idAdmin')) {
            session()->remove('idAdmin');
        }


        $data = [
          'title' => 'Login Admin',
        ];
        return view('LoginAdmin/Views', $data);
    }

    public function getDataForm() {
        $validation =  \Config\Services::validation();
        $adminModel = new \App\Models\AdminModels();

        $validation->setRules([
            'usernameOrEmail' => 'required|string',
            'password' => 'required|min_length[8]|max_length[20]|alpha_numeric'
            ],
            [   // Errors
                'usernameOrEmail' => [
                    'required' => 'All accounts must have provided',
                    'string' => 'Must be format text / string'
                ],
                'password' => [
                    'required' => 'All accounts must have {field} provided',
                    'min_length' => 'minimal 8 characters',
                    'max_length' => 'maximum 20 characters',
                    'alpha_numeric' => 'Fails if field contains anything other than alphanumeric characters.'
                ],
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $usernameOrEmail = $this->request->getPost('usernameOrEmail');
            $password = $this->request->getPost('password');

            if ($adminModel->where('email',$usernameOrEmail)->orWhere('username', $usernameOrEmail)->first()) {
                $idAdmin = $adminModel->select('idAdmin, nama, email, username, password')->where('email',$usernameOrEmail)->orWhere('username', $usernameOrEmail)->first()['idAdmin'];
                $passwordHash = $adminModel->select('idAdmin, nama, email, username, password')->where('email',$usernameOrEmail)->orWhere('username', $usernameOrEmail)->first()['password'];
                if (password_verify($password, $passwordHash)) {
                    session()->set('idAdmin', $idAdmin);
                    return redirect()->to('/dashboardAdmin');
                } else {
                    session()->setFlashdata('password','Password Wrong');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('usernameOrEmail','Check input because not registered in database');
                return redirect()->back()->withInput();
            }

        } else {
            $data = [
              'usernameOrEmail' => $validation->getError('usernameOrEmail'),
                'password' => $validation->getError('password')
            ];
            session()->setFlashdata($data);
            return redirect()->back()->withInput();
        }
    }

    public function signUp() {
        $data = [
          'title' => 'Sign Up Admin'
        ];
        return view('AdminSignUp/Views', $data);
    }

    public function getDataSignUp() {
        $validation =  \Config\Services::validation();

        $validation->setRules([
                'idAdmin' => [
                    'label'  => 'ID Admin',
                    'rules'  => 'required|is_unique[admin.idAdmin]|alpha_dash',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'is_unique' => '{field} already exists',
                        'alpha_dash' => '{field} must be contains -, a-zA-Z, 0-9'
                    ]
                ],
                'nama' => [
                    'label'  => 'Nama',
                    'rules'  => 'required|alpha_space',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'alpha_space' => '{field} Fails if contains anything other than space characters or a-zA-Z.'
                    ]
                ],
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'valid_email' => '{field} Fails if field does not contain a valid email address.'
                    ]
                ],
                'username' => [
                    'label'  => 'Username',
                    'rules'  => 'required|is_unique[admin.username]|alpha_numeric',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'is_unique' => '{field} already exists',
                        'alpha_numeric' => '{field} Fails if field contains anything other than alphanumeric characters.'
                    ]
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[8]|max_length[20]|alpha_numeric',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => '{field} minimal 8 characters',
                        'max_length' => '{field} maximum 20 characters',
                        'alpha_numeric' => '{field} Fails if field contains anything other than alphanumeric characters.'
                    ]
                ],
                'confirmPassword' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[8]|max_length[20]|alpha_numeric|matches[password]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => '{field} minimal 8 characters',
                        'max_length' => '{field} maximum 20 characters',
                        'alpha_numeric' => '{field} Fails if field contains anything other than alphanumeric characters.',
                        'matches' => '{field} are not the same'
                    ]
                ],
                'pictureProfile' => [
                    'label'  => 'Profile Picture',
                    'rules'  => 'uploaded[pictureProfile]|max_size[pictureProfile,2048]|max_dims[pictureProfile,1000,1000]|is_image[pictureProfile]|ext_in[pictureProfile,jpg,png]',
                    'errors' => [
                        'uploaded' => 'All accounts must have {field} provided',
                        'max_size' => '{field} max size 2048KB',
                        'max_dims' => '{field} maximum dimension 1000 x 1000',
                        'is_image' => '{field} must be image',
                        'ext_in' => '{field} extension must be jpg, png'
                    ]
                ],
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $authIDModel = new \App\Models\AuthIDLibraryModels();
            $adminModel = new \App\Models\AdminModels();
            $db = \Config\Database::connect();

            $idAdmin = $this->request->getPost('idAdmin');
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $profileImage = $this->request->getFile('pictureProfile');
            $nameImage = $this->request->getFile('pictureProfile')->getRandomName();
            $passwordHash = password_hash($password,PASSWORD_DEFAULT);

            if ($authIDModel->where('idAdmin',$idAdmin)->first()) {
               $data = [
                 'idAdmin' => $idAdmin,
                 'nama' => $nama,
                 'email' => $email,
                   'username' => $username,
                   'password' => $passwordHash,
                   'picture' => $nameImage
               ];
                try {
                    $adminModel->insert($data);
                    if ($db->affectedRows()) {
                        session()->setFlashdata('successSignUpAdmin','Successfully create admin account');
                        $profileImage->move('profile',$nameImage);
                        return redirect()->back();
                    } else {
                        d("FAILS");
                    }
                } catch (\ReflectionException $e) {
                }
            } else {
                session()->setFlashdata([
                    'idAdmin' => 'ID Admin Tidak Ditemukan Silahkan Hubungi Petugas Bersangkutan'
                ]);
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata([
               'idAdmin' => $validation->getError('idAdmin'),
                'nama' => $validation->getError('nama'),
                'email' => $validation->getError('email'),
                'username' => $validation->getError('username'),
                'password' => $validation->getError('password'),
                'confirmPassword' => $validation->getError('confirmPassword'),
                'pictureProfile' => $validation->getError('pictureProfile')
            ]);
            return redirect()->back()->withInput();
        }
    }
}
