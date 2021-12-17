<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class JobListing extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'job_listing';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_name',
        'job_title',
        'link',
        'description',
        'amount',
        'pay_type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'edited_at'  => 'datetime',
        'updated_at' => 'datetime',
    ];
}
