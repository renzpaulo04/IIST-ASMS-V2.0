<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Faculty as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Faculty extends Model
{
    use HasApiTokens,HasFactory, Notifiable;
    protected $table ="facultys";
    protected $primaryKey = 'id';
    protected $fillable = ['idNumber','email','password','lastName','units','firstName','activation','middleName','regular','overload'];

    public function getActivationBadgeAttribute()
    {
        $badges=[
            'ACTIVE' => 'success',
            'INACTIVE'=> 'secondary',
        ];
        return $badges[$this->activation];
    }
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('lastName','like', $term)
                  ->orwhere('firstName','like',$term)
                  ->orwhere('idNumber','like',$term);
        });
    }
      /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
