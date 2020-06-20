<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loginfaild extends Migration
{
	public function up()
	{
		$this->forge->addField([
		'id' => [
		'type' => 'INT',
		'constraint' => 6,
		'unsigned' => true,
		'auto_increment' => true
		],
		'ip' => [
		'type' => 'VARCHAR',
		'constraint' => 45
		],
		'browser' => [
		'type' => 'TEXT'
		],
		'email' => [
		'type' => 'VARCHAR',
		'constraint' => 255,
		'null' => true
		],
		'total_faild' => [
		'type' => 'INT',
		'constraint' => 6
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
		$this->forge->createTable('login_failed', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('login_failed', true);
	}
}