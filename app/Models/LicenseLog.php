<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseLog extends Model
{
    // Solo created_at, no necesitamos updated_at para logs
    const UPDATED_AT = null; 

    protected $fillable = [
        'license_id', 
        'action', 
        'old_value', 
        'new_value', 
        'ip_address'
    ];

    public function license() {
        return $this->belongsTo(License::class);
    }
}