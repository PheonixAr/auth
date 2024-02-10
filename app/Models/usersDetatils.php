<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersDetatils  extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'users';

    protected $fillable = [
        'name','email','phone','gender','role'
    ];
}
