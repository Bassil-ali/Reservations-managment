<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
$table->foreignId("admin_id")->constrained("admins")->onUpdate("cascade")->onDelete("cascade");
            $table->string('first_name');
            $table->string('second_name');
            $table->foreignId("grade_id")->constrained("grades")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("type_id")->constrained("types")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->string('Passowrd');
            $table->string('username');
            $table->foreignId("direction_id")->constrained("Directions")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->enum('active',['stoped','activate','hanging'])->nullable();
            $table->string('photo')->nullable();
            $table->string('email');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}