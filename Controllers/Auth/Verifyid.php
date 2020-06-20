<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use App\Models\Users;
use Config\Services;
use CodeIgniter\I18n\Time;
class Verifyid extends Controller {
   private $username;
   private $key;
   private $users;
   private $validation;
   private $session;
   public function index(string $username, int $key) {
      $this->validation = Services::validation();
      $data = [
      'username' => $this->request->uri->getSegment(3),
      'key' => $this->request->uri->getSegment(4)
      ];
      if ($this->validation->run($data, 'verifyid')) {
         $this->users = new Users();
         $row = $this->users->where('username', $this->request->uri->getSegment(3))->where('active', 0)->countAllresults();
         $this->session = Services::session();
         if ($row == 1) {
            $get = $this->users->where('username', $this->request->uri->getSegment(3))->where('active', 0)->first();
             (password_verify($this->request->uri->getSegment(4), $get->key)) {
              $this->users->protect(false)->save([
              'id' => $get->id,
              'active' => 1
              ]);
              $this->users->protect(true);
              $this->session->setFlashData('success', 'Your account is successfully active. Now you can login on our site.');
              return view('verifyid');
            } else {
               $this->session->setFlashData('inkey', 'You enter verification key for the username is incorrect');
               return view('verifyid');
            }
         } else {
            $this->session->setFlashData('notfound', 'Your username is not match or your account is already active.');
            return view('verifyid');
         }
      } else {
         return view('verifyid', [
         'validation' => $this->validator
         ]);
      }
   }
}
?>