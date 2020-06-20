<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use App\Models\Banip;
use Config\Services;
class Ban implements FilterInterface {
   public function before(RequestInterface $request) {
      $time = new Time();
      $currentIP = $request->getIPAddress();
      $ban = new Banip();
      $row = $ban->where('ip', $currentIP);
      if ($row->countAllresults() > 0) {
         $get = $ban->where('ip', $currentIP)->first();
         //$today = strtotime(date("Y-m-d H:i:s"));
         
         $today = $time->parse("now");
               $until = $time->parse($get->until);
               //$until = $time->parse($created->toDateString());
               
               
         //$until = strtotime($get->until);
         if ($until->isAfter($today) === true) {
            Services::response()->setStatusCode(403);
          return redirect()->to(base_url('ban/ip'));  
         } elseif ($today->isAfter($until) === true) {
            return $ban->where('id', $get->id)->delete();
         }
      }
   }
   public function after(RequestInterface $request, ResponseInterface $response) {
      /****
      $currentIP = $request->getIPAddress();
      $ban = new Banip();
      $row = $ban->where('ip', $currentIP);
      echo "Hhhhhhhh";
      if ($row->countAllresults() > 0) {
         echo "I am live";
         $get = $ban->where('ip', $currentIP)->orderBy('id', 'desc')->first();
         $today = strtotime(date("Y-m-d H:i:s"));
         $until = strtotime($get->until);
         if ($today > $until) {
            echo "I am working";
          return $ban->where('id', $get->id)->delete();
         }
      }
      ****/
   }
}
?>