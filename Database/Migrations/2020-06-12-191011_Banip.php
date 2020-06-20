<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Banip extends Migration
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
		'ip' => [
		'type' => 'VARCHAR',
		'constraint' => 45
		],
		'cause' => [
		'type' => 'TEXT',
		'constraint' => 500,
		'null' => true
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
		$this->forge->createTable('ban_ip', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ban_ip', true);
	}
}