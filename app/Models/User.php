<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
     /**
     * The attributes that are mass assignable.
     *s
     * @var string[]
     */
    protected $table ="users";
    protected $primaryKey = 'id';
    protected $fillable = ['idNumber','email','password','contactNumber','lastName','firstName','middleName','role','units','overload','regular','status','role2','accpeted_by'];

    public function getActivationBadgeAttribute()
    {
        $badges=[
            'accept' => 'success',
            'requesting'=> 'secondary',
        ];
        return $badges[$this->activation];
    }
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('lastName','like', $term)
                  ->orwhere('firstName','like',$term)
                  ->orwhere('middleName','like',$term)
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
