<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'description',
        'title',
        'tagline',
        'about',
        'services',
    ];

    protected $casts = [
        'services' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}