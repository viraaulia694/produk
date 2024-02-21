<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}

// log
// use App\Models\UserModel;

// class Login extends BaseController
// {
//     public function index()
//     {
//         return view('vw_login');
//     }
//     public function process()
//     {
//         $users = new UserModel();
//         $username = $this->request->getVar('username');
//         $password = $this->request->getvar('password');
//         $dataUser = $users->where([
//             'username' => $username,
//         ])->first();
//         if($dataUser) {
//             if (password_verify($password, $dataUser->password)) {
//                 session()->set([
//                     'username' => $dataUser->username,
//                     'nama' => $dataUser->nama,
//                     'logged_in' => TRUE
//                 ]); 
//                 return redirect()->to(base_url('produk'));
//             } else {
//                 session()->setFlashdata('error', 'Username & Password Salah');
//                 return redirect()->back();
//             }
//             } else {
//                 session()->setFlashdata('error','Username & Password salah');
//                 return redirect()->back();
//             }
//         }
//     }


// reg
// use App\Models\UserModel;
// class Register extends BaseController
// {
//     public function index()
//     {
//         return view('vw_register');
//     }
//     public function process()
//     {
//         if(!$this->validate([
//             'username'=>[
//                 'rules'=>
//                 'required|min_length[4]|max_length[20]|is_unique[users.username]',
//                 'errors'=> [
//                     'required'=> '{field} Harus diisi',
//                     'min_length'=> '{field} Minimal 4 Karakter',
//                     'max_length'=> '{field} Maksimal 20 Karakter',
//                     'is_unique'=> 'Username sudah digunakan sebelumnya'
//                 ]
//                 ],
//             'password'=>[
//                 'rules'=>
//                 'required|min_length[4]|max_length[50]',
//                 'errors'=>[
//                     'required'=>'{field} Harus diisi',
//                     'min_length'=> '{field} Minimal 4 Karakter',
//                     'max_length'=> '{field} Maksimal 20 Karakter',
//                 ]
//             ],
//             'password_conf'=>[
//                 'rules'=> 'matches[password]',
//                 'errors'=>[
//                 'matches'=> 'Konfirmasi Password tidak sesuai',
//                 ]
//             ],
//             'nama'=>[
//                 'rules'=>
//                 'required|min_length[4]|max_length[100]',
//                 'errors'=>[
//                     'required'=>'{field} Harus diisi',
//                     'min_length'=> '{field} Minimal 4 Karakter',
//                     'max_length'=> '{field} Maksimal 100 Karakter',
//                 ]
//             ],
//         ])) {
//             session()->setFlashdata('error', $this->validator->listErrors());
//             return redirect()->back()->withInput();
//         }
//         $users = new UserModel();
//         $users->insert([
//             'username'=>$this->request->getVar('username'),
//             'password'=> password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
//             'nama'=>$this->request->getVar('nama')
//         ]);
//         return redirect()->to('/login');
//     }
// }