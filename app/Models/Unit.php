<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table ="units";
    protected $primaryKey = 'id';
    protected $fillable = ['teacher','startSchool','semester','regular','overload'];
}
