<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'role_id','name', 'email', 'password', 'address', 'mobile',
        'facebook', 'instagram', 'whatsapp', 'gender', 'image', 'info', 'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/images/' . $this->image) : asset('images/noimage.png');
    }
   
    public function role(){
     return $this->belongsTo(Role::class);
    }


    public function toggleStatus()
    {
        $this->update(['status' => !$this->status]);
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('id');
    }

    public static function getRecord(){
         return self::ordered()->with('role')->get();
    }
}
