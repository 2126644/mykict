<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';
    public $incrementing = true;    //auto-increment, use id (bigint)

    protected $fillable = ['ad_name', 'ad_email', 'ad_password'];

    //realtionships
    public function course()
    {
        return $this->hasMany(Course::class, 'admin_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
