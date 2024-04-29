<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class CreateOffsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offsets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("client_id")->constrained("clients")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->bigInteger('code');
            $table->string('cahier_number');
            $table->string('grammage');
            $table->string('format');
            $table->string('poids');
            $table->foreignId("category_id")->constrained("categories")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->dateTime('date')->nullable();
            $table->string('equipe')->nullable();
            $table->string('visa');
            $table->foreignId("machine_id")->constrained("machines")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("decision_id")->constrained("decesions")->references("id")->onUpdate("cascade")->onDelete("cascade");
			$table->softDeletes();
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
        Schema::dropIfExists('offsets');
    }
}