<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;
use Config\Services;
class Admin implements FilterInterface {
   private $users;
   private $session;
   public function before(RequestInterface $request) {
      $this->session = Services::session();
      $this->users = new Users();
      $userID = $this->session->get('id');
      $row = $this->users->select('rank')->where('id', $userID)->countAllresults();
      //var_dump($row);
      if ($row == 1) {
         $get = $this->users->where('id', $userID)->limit(1)->first();
         if ($get->rank != 1) {
            return redirect()->to(base_url('users/dashboard'));
         }
      }
   }
   public function after(RequestInterface $request, ResponseInterface $response) {
      
   }
} 
?>