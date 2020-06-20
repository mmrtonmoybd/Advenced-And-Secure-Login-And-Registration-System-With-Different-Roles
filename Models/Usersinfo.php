<?php
namespace App\Models;
use CodeIgniter\Model;
class Usersinfo extends Model {
   protected $table = 'users_info';
   protected $primaryKey = 'id';
   protected $allowedFields = [
   'fullname',
   'address',
   'mobile',
   'dob',
   'image'
   ];
   protected $useSoftDeletes = true;
   protected $returnType = 'object';
   protected $useTimestamps = true;
   protected $createdField = 'created_at';
   protected $updatedField = 'updated_at';
   protected $deletedField = 'deleted_at';
  /* protected 
   $validationRules = [
    'fullname' => 'required|alpha_space',
    'address' => 'required|string',
    'mobile' => 'required|numeric'
   ];
   protected $skipValidation = false;*/
}
?>