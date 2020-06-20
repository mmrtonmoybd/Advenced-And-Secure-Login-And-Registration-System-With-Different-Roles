<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use App\Models\Users;
use App\Models\Usersinfo;
use Config\Services;
class Register extends Controller {
   private $username;
   private $name;
   private $email;
   private $password;
   private $cpassword;
   private $data;
   private $users;
   private $info;
   private $datai;
   public function __construct() {
      helper(['form', 'url']);
   }
   public function index() {
      return view('register');
   }
   public function register() {
      $this->username = $this->request->getPost('username');
      $this->name = $this->request->getPost('name');
      $this->email = $this->request->getPost('email');
      $this->password = $this->request->getPost('password');
      $this->cpassword = $this->request->getPost('cpassword');
      $this->data = [
      'name' => $this->name,
      'username' => $this->username,
      'email' => $this->email,
      'password' => $this->password,
      'cpassword' => $this->cpassword
	];
	$validation = Services::validation();
      
      if ($validation->withRequest($this->request)->run($this->data, 'register')) {
         $this->users = new Users();
         $this->info = new Usersinfo();
         $key = rand(111111, 999999);
         $this->data = [
         'username' => $this->username,
         'email' => $this->email,
         'password' => $this->password,
         'key' => $key,
         'ip' => $this->request->getIPAddress(),
         'browser' => $this->request->getUserAgent()
         ];
         $this->datai = [
         'fullname' => $this->name
         ];
         if ($this->users->save($this->data) === true && $this->info->save($this->datai) === true) {
            $email = Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setSubject('Account activation key');
            $uri = $this->request->uri;
            $host = $uri->getHost();
            $protocol = $uri->getScheme() . "://";
            $segm = "/verify/id/" . $this->request->getPost('username') . "/" . $key;
            $fullurl = $protocol . $host . $segm;
           $meg = "Hi {$this->request->getPost('fullname')}, you are successfully register on our site. Please active your account via visiting on thig link. 
           " . $fullurl; $email->setMessage($meg);
           $email->send();
           return redirect()->to('registration/successful');
         } else {
            return view('register', [
            'errors' => $this->users->errors(),
            'errorsi' => $this->info->errors()
            ]);
         }
      } else {
         return view('register', [ 
         'validation' => $this->validator 
         ]);
      }
   }
}
?>