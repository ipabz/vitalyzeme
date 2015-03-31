<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tracking', function(Blueprint $table)
		{
			$table->increments('track_id');
			$table->string('ip_address', 20);
			$table->text('topic_done')->nullable();
			$table->text('current_topic')->nullable();
			$table->text('date_created');
			$table->text('last_updated');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tracking');
	}

}
