<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use App\Models\Users;
use App\Models\Password;
use App\Models\Banip;
use CodeIgniter\I18n\Time;
use Config\Services;
class Forget extends Controller {
   private $users;
   private $password;
   private $session;
   public function __construct() {
      helper(['url', 'form']);
      $this->session = Services::session();
   }
   public function index() {
      return view('forget');
   }
   public function forget() {
      $validation = Services::validation();
      $rule = 'required|max_length[255]|valid_email|is_not_unique[users.email]';
      if ($validation->check($this->request->getPost('email', FILTER_SANITIZE_EMAIL), $rule)) {
         $this->users = new Users();
        // $this->password = new Password();
         $row = $this->users->where('email', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->where('active', 1)->countAllresults();
         if ($row == 1) {
            $this->password = new Password();
            $prow = $this->password->where('send_to', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->countAllresults();
           $time = new Time();
               $until = $time->parse("2 hours");
            if ($prow == 1) {
               $passget = $this->password->where('send_to', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->first();
               $uutil = $time->parse($passget->until);
               
               $create = $time->parse($passget->created_at);
               if ($create->isBefore($uutil)) {
                  $this->session->setFlashData('exist', 'You did not get new key before 2 hours. An old key is alredy exist it will be expire after 2 hours.');
                  return view('forget');
               } else {
                $this->password->delete($passget->id);
                 $get = $this->users->where('email', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->where('active', 1)->first();
            $key = rand(111111, 999999);
            $data = [
            'username' => $get->username,
            'send_to' => $get->email,
            'key' => $key,
            'until' => $until
            ];
          if ($this->password->save($data) === true) {
             $email = Services::email();
             $email->setTo($this->request->getPost('email'));
            $email->setSubject('Forget password key');
            $uri = $this->request->uri;
            $host = $uri->getHost();
            $protocol = $uri->getScheme() . "://";
            $segm = "/forget/password/" . $get->username . "/" . $key;
            $fullurl = $protocol . $host . $segm;
           $meg = "We alredy send you a mail with forget password link. Visit on this link to forget password. 
            " . $fullurl; $email->setMessage($meg);
           $email->send();
           $this->session->setFlashData('success', 'Your forget mail is successfully send. Check your email');
           $this->session->set('fattempt', $this->session->get('fattempt') + 1);
           return view('forget');
          }  
               }
            } else {
            //$
            //if ()
            
            $get = $this->users->where('email', $this->request->getPost('email', FILTER_SANITIZE_EMAIL))->where('active', 1)->first();
            $key = rand(111111, 999999);
            $data = [
            'username' => $get->username,
            'send_to' => $get->email,
            'key' => $key,
            'until' => $until
            ];
          if ($this->password->save($data) === true) {
             $email = Services::email();
             $email->setTo($this->request->getPost('email'));
            $email->setSubject('Forget Password');
            $uri = $this->request->uri;
            $host = $uri->getHost();
            $protocol = $uri->getScheme() . "://";
            $segm = "/forget/password/" . $get->username . "/" . $key;
            $fullurl = $protocol . $host . $segm;
           $meg = "We alredy send you a mail with forget password link. Visit on this link to forget password. 
            " . $fullurl; $email->setMessage($meg);
           $email->send();
           $this->session->setFlashData('success', 'Your forget mail is successfully send. Check your email');
           $this->session->set('fattempt', $this->session->get('fattempt') + 1);
           return view('forget');
          }  
          }
         } else {
            $this->session->set('fattempt', $this->session->get('fattempt') + 1);
            $notfound = "Your email is not found or your account is not avtive";
            $this->session->setFlashData('notfound', $notfound);
            return view('forget');
         }
      } else {
         $this->session->set('fattempt', $this->session->get('fattempt') + 1);
         return view('forget', [
         'validation' => $this->validator
         ]);
      }
   }
   public function __destruct() {
      if ($this->session->get('fattempt') == 6 || $this->session->get('fattempt') > 6) {
         $ban = new Banip();
         $time = new Time();
         $until = $time->parse('2 hours');
         $data = [
         'ip' => $this->request->getIPAddress(),
         'cause' => 'Your ip is ban for 2 hours. Some suspious activity detect.',
         'until' => $until
         ];
         $ban->save($data);
         $this->session->remove('fattempt');
      }
   }
}
?>