<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;
use Config\Services;
class Editor implements FilterInterface {
   private $users;
   private $session;
   public function before(RequestInterface $request) {
      $this->session = Services::session();
      $this->users = new Users();
      $userID = $this->session->id;
      $row = $this->users->select('rank')->where('id', $userID)->countAllresults();
      //var_dump($row);
      if ($row == 1) {
         $get = $this->users->where('id', $userID)->limit(1)->first();
         if ($get->rank < 2) {
            return redirect()->to(base_url('users/dashboard'));
         }
      }
   }
   public function after(RequestInterface $request, ResponseInterface $response) {
      
   }
} 
?>