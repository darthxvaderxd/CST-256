<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Group extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'affinity_group';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'group',
    ];

    public function setGroupAttribute($value) {
        $this->attributes['group'] = strtolower($value);
    }
}
