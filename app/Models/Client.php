<?php
namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Client extends Model implements Authenticatable
{
    use AuthenticatableTrait;

protected $table    = 'clients';
protected $fillable = [
		'id',
		'admin_id',
        'first_name',
        'second_name',
        'grade_id',

        'type_id',

        'password',
        'username',
        'direction_id',

        'active',

        'photo',
        'email',
		'created_at',
		'updated_at',
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
    * grade_id relation method
    * @param void
    * @return object data
    */
   public function grade_id(){
      return $this->hasOne(\App\Models\Grade::class,'id','grade_id');
   }

	/**
    * type_id relation method
    * @param void
    * @return object data
    */
   public function type_id(){
      return $this->hasOne(\App\Models\Type::class,'id','type_id');
   }

	/**
    * direction_id relation method
    * @param void
    * @return object data
    */
   public function direction_id(){
      return $this->hasOne(\App\Models\Direction::class,'id','direction_id');
   }

 	/**
    * Static Boot method to delete or update or sort Data
    * @param void
    * @return void
    */
   protected static function boot() {
      parent::boot();
      // if you disable constraints should by run this static method to Delete children data
         static::deleting(function($client) {
			//$client->grade_id()->delete();
			//$client->grade_id()->delete();
			//$client->grade_id()->delete();
         });
   }
		
}
