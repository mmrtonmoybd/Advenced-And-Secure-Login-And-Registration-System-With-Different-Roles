<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use App\Models\Users;
use App\Models\Password;
use Config\Services;
use CodeIgniter\I18n\Time;
use App\Models\Banip;
class Changepass extends Controller {
   private $session;
   private $username;
   private $key;
   private $password;
   private $users;
   public function __construct() {
      helper(['form', 'url']);
      $this->session = Services::session();
   }
   public function index() {
      //return view('changepass');
   }
   public function password(string $username, int $key) {
      //print_r($this->request->uri->getSegments());
      $segment = $this->request->uri;
      $username = $segment->getSegment(3);
      $key = $segment->getSegment(4);
      $validation = Services::validation();
      $data = [
      'username' => $username,
      'key' => $key
      ];
      if ($validation->run($data, 'verifyid')) {
         $this->password = new Password();
         $row = $this->password->where('username', $username)->orderBy('created_at', 'desc')->limit(1)->countAllresults();
         $time = new Time();
         if ($row == 1) {
            $get = $this->password->where('username', $username)->orderBy('created_at', 'desc')->limit(1)->first();
            $until = $time->parse($get->until);
            $create = $time->parse($get->created_at);
            if ($until->isAfter($create)) {
               if (password_verify($key, $get->key)) {
                  $rule = 'required|min_length[7]|matches[cpassword]';
                  $pdata = [
                  'password' => $this->request->getPost('password'),
                  'cpassword' => $this->request->getPost('cpassword')
                  ];
                  if ($validation->run($pdata, 'password')) {
                     $this->users = new Users();
                    $uget = $this->users->where('username', $username)->first();
                    if ($this->users->save([
                    'id' => $uget->id,
                    'password' => $this->request->getPost('password')
                    ]) === true) {
                       $this->password->delete($get->id);
                       
                       $this->session->setFlashData('success', 'Your password reset is successfully complete');
                       $validation->reset();
                       return view('verifyid');
                    }
                  } else {
                     return view('password', [
                     
        'username' => $username,
        'key' => $key,            'validation' => $this->validator]);
                  }
               }
            } else {
               //time expire
               $this->session->set('chattaptm', $this->session->get('chattaptm') + 1);
               $this->session->setFlashData('timeexp', 'Password reset key time is alredy expire.');
               return view('verify');
            }
         } else {
            //not found
            $this->session->set('chattaptm', $this->session->get('chattaptm') + 1);
            $this->session->setFlashData('usernotfounf', 'Username not found. your username is worng.');
            return view('verifyid');
         }
      } else {
         //validation error
         $this->session->set('chattaptm', $this->session->get('chattaptm') + 1);
         return view('verifyid', [ 'validation' => $this->validator]);
      }
   }
   public function __destruct() {
      if ($this->session->get('chattaptm') == 6 || $this->session->get('chattaptm') > 6) {
         $ban = new Banip();
         $time = new Time();
         $until = $time->parse('2 hours');
         $data = [
         'ip' => $this->request->getIPAddress(),
         'cause' => 'Your ip is ban for 2 hours. Some suspious activity detect.',
         'until' => $until
         ];
         $ban->save($data);
         $this->session->remove('chattaptm');
      }
   }
}
?>