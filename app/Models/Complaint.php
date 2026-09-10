<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // Pastikan user_id masuk ke dalam array fillable ini!
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'photo', 
        'status'
    ];

    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) {
            return null;
        }

        // Jika sudah berupa URL lengkap Cloudinary / HTTP
        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
            // Jika tersimpan URL lokal dengan domain berbeda/hardcode, sesuaikan dengan request saat ini
            if (str_contains($this->photo, '/storage/')) {
                $path = substr($this->photo, strpos($this->photo, '/storage/'));
                return url($path);
            }
            return $this->photo;
        }

        // Jika hanya menyimpan relative path (misal: complaints/xxx.jpg)
        return asset('storage/' . $this->photo);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}