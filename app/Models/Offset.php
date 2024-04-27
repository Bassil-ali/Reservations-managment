<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Auto Models By Baboon Script
// Baboon Maker has been Created And Developed By  [it v 1.6.40]
// Copyright Reserved  [it v 1.6.40]
class Offset extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];

protected $table    = 'offsets';
protected $fillable = [
		'id',
		'admin_id',
        'client_id',

        'code',
        'cahier number',
        'grammage',
        'format',
        'poids',
        'category_id',

        'date',
        'equipe',
        'visa',
        'machine_id',

        'decision_id',

		'created_at',
		'updated_at',
		'deleted_at',
	];

	/**
	 * admin id relation method to get how add this data
	 * @type hasOne
	 * @param void
	 * @return object data
	 */
   public function admin_id() {
	   return $this->hasOne(\App\Models\Admin::class, 'id', 'admin_id');
   }
	

	/**
    * client_id relation method
    * @param void
    * @return object data
    */
   public function client_id(){
      return $this->hasOne(\App\Models\Client::class,'id','client_id');
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
    * machine_id relation method
    * @param void
    * @return object data
    */
   public function machine_id(){
      return $this->hasOne(\App\Models\Machine::class,'id','machine_id');
   }

	/**
    * decision_id relation method
    * @param void
    * @return object data
    */
   public function decision_id(){
      return $this->hasOne(\App\Models\Decesion::class,'id','decision_id');
   }

 	/**
    * Static Boot method to delete or update or sort Data
    * @param void
    * @return void
    */
   protected static function boot() {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
         static::deleting(function($offset) {
			//$offset->client_id()->delete();
			//$offset->client_id()->delete();
			//$offset->client_id()->delete();
			//$offset->client_id()->delete();
         });
   }
		
}
