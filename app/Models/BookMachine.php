<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class BookMachine extends Model {

protected $table    = 'book_machines';
protected $fillable = [
		'id',
		'admin_id',
        'client_id',

        'machine_id',

        'question_1',
        'answer',

		'created_at',
		'updated_at',
	];

	/**
    * client_id relation method
    * @param void
    * @return object data
    */
   public function client_id(){
      return $this->hasOne(\App\Models\Client::class,'id','client_id');
   }

	/**
    * machine_id relation method
    * @param void
    * @return object data
    */
   public function machine_id(){
      return $this->hasOne(\App\Models\Machine::class,'id','machine_id');
   }

 	/**
    * Static Boot method to delete or update or sort Data
    * @param void
    * @return void
    */
   protected static function boot() {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
         static::deleting(function($bookmachine) {
			//$bookmachine->client_id()->delete();
			//$bookmachine->client_id()->delete();
         });
   }
		
}
