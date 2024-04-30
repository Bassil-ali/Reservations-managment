<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Reluere extends Model {

protected $table    = 'relueres';
protected $fillable = [
		'id',
		'admin_id',
        'user_id',

        'code',
        'format',

        'poids',
        'category_id',

        'decesion_id',

        'machine_id',

        'date',
        'equipe',
		'created_at',
		'updated_at',
	];

	/**
    * user_id relation method
    * @param void
    * @return object data
    */
   public function user_id(){
      return $this->hasOne(\App\Models\Client::class,'id','user_id');
   }

	/**
    * category_id relation method
    * @param void
    * @return object data
    */
   public function category_id(){
      return $this->hasOne(\App\Models\Category::class,'id','category_id');
   }

	/**
    * decesion_id relation method
    * @param void
    * @return object data
    */
   public function decesion_id(){
      return $this->hasOne(\App\Models\Decesion::class,'id','decesion_id');
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
         static::deleting(function($reluere) {
			//$reluere->user_id()->delete();
			//$reluere->user_id()->delete();
			//$reluere->user_id()->delete();
			//$reluere->user_id()->delete();
         });
   }
		
}
