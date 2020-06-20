<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
		'username' => [
		'type' => 'VARCHAR',
		'constraint' => 25
		],
		'email' => [
		'type' => 'VARCHAR',
		'constraint' => 255
		],
		'password' => [
		'type' => 'VARCHAR',
		'constraint' => 255
		],
		'key' => [
		'type' => 'VARCHAR',
		'constraint' => 255
		],
		'active' => [
		'type' => 'INT',
		'constraint' => 1,
		'default' => 0
		],
		'rank' => [
		'type' => 'INT',
		'constraint' => 1,
		'default' => 4
		],
		'ip' => [
		'type' => 'VARCHAR',
		'constraint' => 45
		],
		'browser' => [
		'type' => 'TEXT',
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
		$this->forge->addUniqueKey('username');
		$this->forge->addUniqueKey('email');
		$this->forge->createTable('users', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users', true);
	}
}