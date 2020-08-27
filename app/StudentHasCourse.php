<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class StudentHasCourse extends Model
{
    protected $guarded = [];
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }

    public function payment(){
        return $this->hasMany(Payment::class,'id','st_has_co_id');
    }

    public function student(){
        return $this->hasOne(Student::class,'id','student_id');
    }

    public function weekPayment(){
        return $this->hasMany(Payment::class,'course_id','course_id')
                    ->where('approve',false)
                    ->where('created_at', '>', Carbon::now()->startOfWeek())
                    ->where('created_at', '<', Carbon::now()->endOfWeek());
    }
}
