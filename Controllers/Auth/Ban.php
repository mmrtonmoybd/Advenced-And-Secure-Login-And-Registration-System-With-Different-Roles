<?php
namespace App\Controllers\Auth;
use CodeIgniter\Controller;
use App\Models\Banip;
use Config\Services;
class Ban extends Controller {
   private $banip;
   public function __construct() {
      Services::response()->setStatusCode(403);
   }
   public function index() {
      $this->banip = new Banip();
      $row['data'] = $this->banip->where('ip', $this->request->getIPAddress())->orderBy('id', 'desc')->limit(1, 0)->findAll();
      return view('errors/403.php', $row);
   }
}
?>