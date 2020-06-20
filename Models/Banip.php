<?php
namespace App\Models;
use CodeIgniter\Model;
class Banip extends Model {
   protected $table = 'ban_ip';
   protected $primaryKey = 'id';
   protected $allowedFields = [
   'ip',
   'cause',
   'until'
   ];
   protected $returnType = 'object';
   protected $useSoftDeletes = true;
   protected $useTimestamps = true;
   protected $createdField = 'created_at';
   protected $updatedField = 'updated_at';
   protected $deletedField = 'deleted_at';
   protected $validationRules = [
   'ip' => 'required|valid_ip|max_length[45]',
   'cause' => 'required|max_length[500]',
   'until' => 'required'
   ];
   protected $skipValidation = false;
}
?>