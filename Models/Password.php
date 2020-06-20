<?php
namespace App\Models;
use CodeIgniter\Model;
class Password extends Model {
   protected $table = 'password_reset';
   protected $primaryKey = 'id';
   protected $useSoftDeletes = true;
   protected $allowedFields = [
   'username',
   'send_to',
   'until',
   'key'
   ];
   protected $returnType = 'object';
   protected $useTimestamps = true;
   protected $createdField = 'created_at';
   protected $updatedField = 'updated_at';
   protected $deletedField = 'deleted_at';
   protected $beforeInsert = ['hashKey'];
   protected function hashKey(array $data) {
      if(isset($data['data']['key']))
      $data['data']['key'] = password_hash($data['data']['key'], PASSWORD_DEFAULT);

    return $data;
  }
}
?>