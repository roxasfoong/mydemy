<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Course(){
        return $this->belongsTo(Course::class, 'course_id' ,'id');
    }

    public function Instructor(){
        return $this->belongsTo(User::class, 'instructor_id' ,'id')->where('role', 'instructor');
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id' ,'id');
    }

    public function Payment(){
        return $this->belongsTo(Payment::class, 'payment_id' ,'id');
    }


}
