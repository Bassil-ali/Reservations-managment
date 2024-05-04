<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// Auto Schema  By Baboon Script
// Baboon Maker has been Created And Developed By [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class CreateBookMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_machines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("client_id")->constrained("clients")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("machine_id")->constrained("machines")->references("id")->onUpdate("cascade")->onDelete("cascade");
            $table->string('question_1');
            $table->enum('answer',['Yes','No','empty'])->nullable();
            $table->string('Document_number');
            $table->string('isAnswer')->nullable();
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
        Schema::dropIfExists('book_machines');
    }
}