<?php
namespace App\Models;
use CodeIgniter\Model;
class Users extends Model {
   protected $table = 'users';
   protected $primaryKey = 'id';
   protected $returnType = 'object';
   protected $useSoftDeletes = true;
   protected $allowedFields = [
   'username',
   'email',
   'password',
   'key',
   'ip',
   'browser'
   ];
   protected $useTimestamps = true;
   protected $createdField = 'created_at';
   protected $updatedField = 'updated_at';
   protected $deletedField = 'deleted_at';
   /* protected $validationRules = [
   'username' => 'required|alpha_numeric|max_length[25]|min_length[7]|is_unique[users.username]',
   'email' => 'required|valid_email|max_length[255]|is_unique[users.email]',
   'password' => 'required|min_length[8]',
   'key' => 'required|min_length[6]',
   'ip' => 'required|max_length[45]|valid_ip',
   'browser' => 'required'
   ];
   protected $skipValidation = false;
   */
   protected $beforeInsert = ['hashPassword', 'hashKey'];
   protected $beforeUpdate = ['hashPassword', 'hashKey'];
   
   protected function hashPassword(array $data)
{
    if(isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }
  protected function hashKey(array $data) {
      if(isset($data['data']['key']))
      $data['data']['key'] = password_hash($data['data']['key'], PASSWORD_DEFAULT);

    return $data;
  }
}
?>