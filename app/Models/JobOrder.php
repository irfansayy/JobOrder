<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JobOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'order_code',
        'customer_service_id',
        'brand_id',
        'client_id',
        'qty',
        'order_type_id',
        'product_id',
        'production_status_id',
        'order_priority_id',
        'deadline',
        'po_file',
        'po_link',
        'notes'
    ];

    protected $casts = [
        'order_date' => 'date',
        'deadline' => 'date',
    ];

    // Relationships
    public function customerService()
    {
        return $this->belongsTo(CustomerService::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function orderType()
    {
        return $this->belongsTo(OrderType::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productionStatus()
    {
        return $this->belongsTo(ProductionStatus::class);
    }

    public function orderPriority()
    {
        return $this->belongsTo(OrderPriority::class);
    }

    // Scopes
    public function scopeDeadlineToday($query)
    {
        return $query->whereDate('deadline', Carbon::today());
    }

    public function scopeByBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    // Generate Order Code
    public static function generateOrderCode()
    {
        $date = Carbon::now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', Carbon::today())
                         ->latest('id')
                         ->first();
        
        $number = $lastOrder ? intval(substr($lastOrder->order_code, -4)) + 1 : 1;
        
        return 'JO-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}