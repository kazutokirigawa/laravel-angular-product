<?php

namespace App\Providers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('unique_field', function ($attribute, $value, $parameters, $validator) {
            $ignore_id = null;
            if (count($parameters) > 3) {
                $ignore_id = $parameters[3]; // a flag, if needs to ignore specific id
            }
            $table = $parameters[0]; // table name
            $supporting_field = $parameters[1] == '' ? null : $parameters[1]; // for supporting condition, field name
            $supporting_field_value = $parameters[2] == '' ? null : trim($parameters[2]); // for supporting condition, field value
            $query = DB::table($table)->where($attribute, $value);
            if (!is_null($supporting_field) && !is_null($supporting_field_value)) {
                $query->where($supporting_field, $supporting_field_value);
            }
            if ($ignore_id) {
                $query->where('id', '!=', $ignore_id);
            }
            return !$query->exists();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
