<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'notes',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'paid_at',
        'processed_at',
        'shipped_at',
        'completed_at',
        'tracking_number',
        'cancel_reason',
        'cancel_rejected',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
        'processed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancel_rejected' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentProofs()
    {
        return $this->hasMany(PaymentProof::class);
    }

    public function latestPaymentProof()
    {
        return $this->hasOne(PaymentProof::class)->latest();
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeWaitingPayment($query)
    {
        return $query->where('status', 'waiting_payment');
    }

    public function scopePaymentVerification($query)
    {
        return $query->where('status', 'payment_verification');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'diproses');
    }

    public function scopeDikirim($query)
    {
        return $query->where('status', 'dikirim');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopeDibatalkan($query)
    {
        return $query->where('status', 'dibatalkan');
    }

    public function formattedTotal(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    public function formattedSubtotal(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'pending' => 'Menunggu',
            'waiting_payment' => 'Menunggu Pembayaran',
            'payment_verification' => 'Verifikasi Pembayaran',
            'diproses' => 'Diproses',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            'cancel_request' => 'Permintaan Pembatalan',
            'cancel_rejected' => 'Pembatalan Ditolak',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        $colors = [
            'pending' => 'gray',
            'waiting_payment' => 'yellow',
            'payment_verification' => 'orange',
            'diproses' => 'blue',
            'dikirim' => 'indigo',
            'selesai' => 'green',
            'dibatalkan' => 'red',
            'cancel_request' => 'orange',
        ];

        return $colors[$this->status] ?? 'gray';
    }

    public function canBeCancelled()
    {
        return $this->status === 'diproses'
            && $this->payment_status === 'paid';
    }

    public function canUploadPayment(): bool
    {
        return in_array($this->status, ['waiting_payment', 'payment_verification']);
    }
}
