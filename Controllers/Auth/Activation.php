<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use App\Models\Users;
use App\Models\Banip;
use Config\Services;
class Activation extends Controller {
   private $session;
   private $users;
   //private $ban;
   public function __construct() {
      helper(['form', 'url']);
      $this->session = Services::session();
   }
   public function index() {
      return view('activation');
   }
   public function activation() {
      $validation = Services::validation();
      $rule = 'required|valid_email|max_length[255]|is_not_unique[users.email]';
      $email = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
      if ($validation->check($email, $rule)) {
         $this->users = new Users();
         $row = $this->users->where('email', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->where('active', 0)->countAllresults();
         if ($row == 1) {
           $get = $this->users->where('email', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->where('active', 0)->first();
           $key = rand(111111, 999999);
           if ($this->users->save([
           'id' => $get->id,
           'key' => $key
           ]) === true) {
              $this->session->setFlashData('success', 'We already send a varification email to you. Check your inbox.');
             
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
              return view('verifyid');
           }
         } else {
            $this->session->set('aattempt', $this->session->get('aattempt') + 1);
            $this->session->setFlashData('notfound', 'You enter email address is not found in database or your account is alredy active');
            return view('activation');
         }
      } else {
         $this->session->set('aattempt', $this->session->get('aattempt') + 1);
         return view('activation', ['validation' => $this->validator]);
      }
   }
   public function __destruct() {
      if ($this->session->get('aattempt') == 6 || $this->session->get('aattempt') > 6) {
         $ban = new Banip();
         $time = new Time();
         $until = $time->parse('2 hours');
         $data = [
         'ip' => $this->request->getIPAddress(),
         'cause' => 'Your ip is ban for 2 hours. Some suspious activity detect.',
         'until' => $until
         ];
         $ban->save($data);
         $this->session->remove('aattempt');
      }
   }
}
?>