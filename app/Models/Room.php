<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
   
    protected $table ="rooms";
    protected $primaryKey = 'id';
    protected $fillable = ['room','available','created_by','changed_by'];
    public function client()
    {
        return $this->belongsTo(Room::class);
    }

    public function getRoomsBadgeAttribute()
    {
        $badges=[
            'ACTIVE' => 'success',
            'INACTIVE'=> 'secondary',
        ];
        return $badges[$this->available];
    }
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('room','like', $term);
        });
    }
}
