<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasswordReset extends Migration
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
		'send_to' => [
		'type' => 'VARCHAR',
		'constraint' => 255
		],
		'key' => [
		'type' => 'VARCHAR',
		'constraint' => 255
		],
		'until' => [
		'type' => 'datetime'
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
		$this->forge->createTable('password_reset', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('password_reset', true);
	}
}