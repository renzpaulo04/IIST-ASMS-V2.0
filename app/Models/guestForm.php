<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guestForm extends Model
{
    use HasFactory;
    protected $table ="guest_forms";
    protected $primaryKey = 'id';
    protected $fillable = ['day','room','teacher','startTime','endTime','noStudent'];
}
