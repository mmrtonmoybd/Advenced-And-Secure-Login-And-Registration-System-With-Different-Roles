<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
class Nonauth implements FilterInterface {
   private $session;
   public function before(RequestInterface $request) {
      $this->session = Services::session();
      if ($this->session->get('isLogin') == true) {
         return redirect()->to(base_url('users/dashboard'));
      }
   }
   public function after(RequestInterface $request, ResponseInterface $response) {
      
   }
}
?>