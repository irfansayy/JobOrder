<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'order_sequence',
        'color',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_sequence' => 'integer',
    ];

    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }
}