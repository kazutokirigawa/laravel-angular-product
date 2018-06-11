<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'number_of_stocks',
    ];

    protected $visible = [
        'id',
        'user_id',
        'name',
        'description',
        'price',
        'discount',
        'number_of_stocks',
        'created_at',
        'updated_at',
    ];

    /**
     * Product's creator
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
