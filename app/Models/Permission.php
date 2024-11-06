<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['role_id', 'permission'];
    
    protected $casts = [
        'permission' => 'array',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function getRecords()
    {
        return Permission::orderByDesc('id')->paginate(10);
    }
}
