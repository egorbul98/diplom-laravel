<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TranslateTable;
class Role extends Model
{
    use TranslateTable;

    protected $fillable = [
        'name', 'email', 'password', "lastname", "about", "language", "image"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user')->withPivot("user_id", "role_id");
    }
}
