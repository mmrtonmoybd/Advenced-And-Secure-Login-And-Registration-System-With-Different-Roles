<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use Config\Services;
class Logout extends Controller {
   private $session;
   public function __construct() {
      $this->session = Services::session();
   }
   public function logout() {
      $this->session->destroy();
      return redirect()->to(base_url('login'));
   }
}
?>