<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usersinfo extends Migration
{
	public function up()
	{
		$this->forge->addField([
		'id' => [
		'type' => 'INT',
		'constraint' => 5,
		'unsigned' => true,
		'auto_increment' => true
		],
		'fullname' => [
		'type' => 'TEXT',
		'constraint' => 400,
		'collate' => 'utf8_general_ci'
		],
		'address' => [
		'type' => 'TEXT',
		'constraint' => 500,
		'collate' => 'utf8_general_ci',
		'null' => true
		],
		'mobile' => [
		'type' => 'INT',
		'constraint' => 13,
		'null' => true
		],
		'dob' => [
		'type' => 'VARCHAR',
		'constraint' => 12,
		'null' => true
		],
		'image' => [
		'type' => 'VARCHAR',
		'constraint' => 14,
		'null' => true
		],
		'deleted_at' => [
		'type' => 'datetime',
		'null' => true
		],
		'updated_at' => [
		'type' => 'datetime'
		],
		'created_at' => [
		'type' => 'datetime'
		]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('users_info', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users_info', true);
	}
}