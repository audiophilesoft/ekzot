<?php
/**
 * Created by PhpStorm.
 * User: Audi
 * Date: 21.11.2017
 * Time: 15:00
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // Make all fields fillable
    protected $guarded = [];
    protected $dateFormat = 'Y-m-d H:i:sO';

    use TimezoneAccessor;

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}