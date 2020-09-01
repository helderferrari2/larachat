<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateChatsTable.
 */
class CreateChatsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('sender_user_id');
			$table->unsignedBigInteger('receiver_user_id');
			$table->text('message');
			$table->timestamps();

			//Foreign Keys
			$table->foreign('sender_user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('receiver_user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chats');
	}
}
