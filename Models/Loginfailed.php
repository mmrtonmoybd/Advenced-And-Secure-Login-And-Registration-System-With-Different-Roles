<?php
namespace App\Models;
use CodeIgniter\Model;
class Loginfailed extends Model {
   protected $table = 'login_failed';
   protected $primaryKey = 'id';
   protected $returnType = 'object';
   protected $allowedFields = [
   'ip',
   'browser',
   'email',
   'total_faild'
   ];
   protected $useSoftDeletes = true;
   protected $useTimestamps = true;
   protected $createdField = 'created_at';
   protected $updatedField = 'updated_at';
   protected $deletedField = 'deleted_at';
}
?>