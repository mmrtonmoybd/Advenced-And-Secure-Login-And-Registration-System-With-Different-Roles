<?php
namespace App\Controllers\Users;
use CodeIgniter\Controller;
use Config\Services;
class Dashboard extends Controller {
   private $session;
   public function __construct() {
      $this->session = Services::session();
   }
   public function index() {
      //$session = Services::session();
      echo "You are loged in";
      echo "Your username is ";
      echo $this->session->username;
    //$this->session->set('work', 'kvnkvkvkv');
      echo $this->session->work;
      
   }
}
?>