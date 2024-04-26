<?php
namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */

	public function boot() {

		//   \URL::forceScheme('https');
		Paginator::useBootstrap();

		app()->singleton('admin', function () {
				return 'admin';
			});
		if (file_exists(base_path('config/itconfiguration.php'))) {
			Schema::defaultStringLength(config('itconfiguration.SchemadefaultStringLength'));
			if (config('itconfiguration.ForeignKeyConstraints')) {
				Schema::enableForeignKeyConstraints();
			} else {
				Schema::disableForeignKeyConstraints();
			}
		}
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */

	public function register() {
		//
	}
}
