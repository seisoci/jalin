<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);
      Relation::morphMap([
        'tambahbarang' => 'App\Models\TambahBarang',
        'kurangbarang' => 'App\Models\KurangBarang',
        'kembalikanbarang' => 'App\Models\KembalikanBarang',
      ]);
    }
}
