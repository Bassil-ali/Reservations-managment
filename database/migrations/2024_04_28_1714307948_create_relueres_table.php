<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class CreateRelueresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relueres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("user_id")->constrained("clients")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->string('code');
            $table->enum('format',['1','0']);
            $table->string('poids');
            $table->foreignId("category_id")->constrained("categories")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("decesion_id")->constrained("decesions")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("machine_id")->constrained("machines")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->dateTime('date');
            $table->string('equipe');
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
        Schema::dropIfExists('relueres');
    }
}