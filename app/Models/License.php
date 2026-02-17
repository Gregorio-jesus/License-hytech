<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class License extends Model
{
    protected $fillable = [
        'gym_client_id', 
        'service_id', 
        'license_key', 
        'device_limit', 
        'hardware_id', // Esta es la columna real en tu DB
        'start_date', 
        'expiration_date', 
        'status',
        'is_trial',
        'last_check_in'
    ];

    protected $casts = [
        'start_date' => 'date',
        'expiration_date' => 'date',
        'is_trial' => 'boolean',
        'last_check_in' => 'datetime',      
    ];

    public function client(): BelongsTo
    {
        // Especificamos la FK por si acaso, aunque Laravel suele detectarla
        return $this->belongsTo(GymClient::class, 'gym_client_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(LicenseLog::class);
    }
}