<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
class Throttle implements FilterInterface {
   public function before(RequestInterface $request) {
      $throttle = Services::throttler();
      if ($throttle->check($request->getIPAddress(), 15, MINUTE) === false) {
         //$throttle->getTokentime(60);
         return Services::response()->setStatusCode(429);
      }
   }
   public function after(RequestInterface $request, ResponseInterface $response) {
      
   }
}
?>