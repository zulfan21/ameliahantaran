<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'customer_name',
        'customer_photo',
        'rating',
        'content',
        'wedding_date',
        'photo',
        'status',
        'is_featured',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('status', 'approved');
    }

    public function getStarsAttribute()
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    public function approve($adminId)
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $adminId,
            'approved_at' => now(),
        ]);
    }

    public function reject()
    {
        $this->update([
            'status' => 'rejected',
        ]);
    }
}
