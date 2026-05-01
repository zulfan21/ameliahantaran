<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'image_path',
        'bank_name',
        'account_name',
        'amount',
        'payment_date',
        'notes',
        'status',
        'admin_notes',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function approve($adminId, $notes = null)
    {
        $this->update([
            'status' => 'approved',
            'verified_by' => $adminId,
            'verified_at' => now(),
            'admin_notes' => $notes,
        ]);

        $this->order->update([
            'status' => 'diproses',
            'payment_status' => 'paid',
            'paid_at' => now(),
            'processed_at' => now(),
        ]);
    }

    public function reject($adminId, $notes = null)
    {
        $this->update([
            'status' => 'rejected',
            'verified_by' => $adminId,
            'verified_at' => now(),
            'admin_notes' => $notes,
        ]);

        $this->order->update([
            'status' => 'waiting_payment',
            'payment_status' => 'rejected',
        ]);
    }
}
