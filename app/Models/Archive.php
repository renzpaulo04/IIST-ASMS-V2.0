<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;
    protected $table ="archives";
    protected $primaryKey = 'id';
    public $fillable = ['course','year','section','semester','subject','teacher','room','weekday','startTime','endTime','startSchool','endSchool','difference','created_by','changed_by'];
}
