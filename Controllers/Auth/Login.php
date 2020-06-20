<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use App\Models\Users;
use App\Models\Loginfailed;
use App\Models\Banip;
use App\Models\Usersinfo;
use Config\Services;
class Login extends Controller {
   private $users;
   private $info;
   private $data;
   private $session;
   private $Loginfailed;
   private $time;
   public function __construct() {
      helper('form', 'url');
      $this->session = Services::session();
      $this->time = new Time();
   }
   public function index() {
      return view('login');
   }
   public function login() {
      $validation = Services::validation();
      $this->data = [
      'email' => $this->request->getPost('email'),
      'password' => $this->request->getPost('password')
      ];
      
      if ($validation->run($this->data, 'login')) {
         $this->users = new Users();
         $row = $this->users->where('email', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->where('active', 1);
         if ($row->countAllresults() == 1) {
            $get = $row->first();
          if (password_verify($this->request->getPost('password'), $get->password)) {
            // $get = $this->users->where('email', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->where('active', 1)->first();
             $this->info = new Usersinfo();
             $getui = $this->info->where('id', $get->id)->first();
             
             $this->data = [
             'isLogin' => true,
             'username' => $get->username,
             'email' => $get->email,
             'rank' => $get->rank,
             'id' => $get->id,
             'ip' => $this->request->getIPAddress(),
             'browser' => $this->request->getUserAgent(),
             'fullname' => $getui->fullname,
             'address' => $getui->address,
             'mobile' => $getui->mobile,
             'dob' => $getui->dob,
             'image' => $getui->image,
             'created_at' => $get->created_at
             ];
             $this->session->set($this->data);
             $this->users->save([
             'id' => $get->id,
             'ip' => $this->request->getIPAddress(),
             'browser' => $this->request->getUserAgent()]);
             return redirect()->to(base_url('users/dashboard'));
          } else {
             //password incorrect
           $this->session->set('attempt', $this->session->get('attempt') + 1);
           $this->session->setFlashdata('ipass', 'Your password is incorrect for ' . $this->request->getPost("email", FILTER_SANITIZE_EMAIL) . '');
           echo view('login');
          }
         } else {
            //account not found or not active
            $this->session->set('attempt', $this->session->get('attempt') + 1);
            $this->session->setFlashdata('active', 'Your email address is not found or Your account is not active.');
            echo view('login');
         }
      } else {
       $this->session->set('attempt', $this->session->get('attempt') + 1);
         return view('login', [
         'validation' => $this->validator ]);
      }
   }
   public function __destruct() {
      if ($this->session->attempt == 6 || $this->session->get('attempt') > 6) {
         $this->Loginfailed = new Loginfailed();
         $row = $this->Loginfailed->where('ip', $this->request->getIPAddress())->orderBy('created_at', 'desc')->limit(1);
         //echo $row->getCompiledSelect();
         //echo $row->first()->id;
            if ($row->countAllresults() > 0) {
               $get = $this->Loginfailed->where('ip', $this->request->getIPAddress())->orderBy('created_at', 'desc')->limit(1)->first();
               //$get = $row->resetQuery()->first();

               //echo $fetch->id;
               //var_dump($get);
               $today = $this->time->parse($this->time->toDateString());
               $created = $this->time->parse($get->created_at);
               $created = $created->toDateString();
               
if ($today->sameAs($created) === true) {
   $ban = new Banip();
   
$this->Loginfailed->save(['id' => $get->id,
            'total_faild' => $get->total_faild + $this->session->get('attempt'),
            'browser' => $this->request->getUserAgent()
            ]);
            if ($get->total_faild > 6 || $get->total_faild == 6) {
     
$end = $this->time->parse("2 hours");
$ban->save([
'ip' => $this->request->getIPAddress(),
'cause' => 'Your ip is ban for 2 hours. Some suspious activity detect',
'until' => $end
]);
$this->session->remove('attempt');
            }
} else {
   $this->Loginfailed->insert([
            'ip' => $this->request->getIPAddress(),
            'browser' => $this->request->getUserAgent(),
            'total_faild' => $this->session->get('attempt'),
            'email' => $this->request->getPost('email')
            ]);
}
            } else {
             $this->Loginfailed->insert([
            'ip' => $this->request->getIPAddress(),
            'browser' => $this->request->getUserAgent(),
            'total_faild' => $this->session->get('attempt'),
            'email' => $this->request->getPost('email')
            ]); 
            } //unset($this->session->attempt);
      }
   }
}
?>