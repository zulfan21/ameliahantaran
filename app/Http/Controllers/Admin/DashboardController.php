<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\PaymentProof;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::waitingPayment()->count() + Order::paymentVerification()->count(),
            'processing_orders' => Order::diproses()->count(),
            'completed_orders' => Order::selesai()->count(),
            'total_products' => Product::count(),
            'low_stock_products' => Product::where('stock', '<', 5)->where('is_active', true)->count(),
            'pending_testimonials' => Testimonial::pending()->count(),
            'pending_payments' => PaymentProof::pending()->count(),
        ];

        // Recent orders
        $recentOrders = Order::latest()
            ->take(10)
            ->get();

        // Sales chart data (last 30 days)
        $salesData = Order::where('status', 'selesai')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $salesData->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d M'));
        $chartData = $salesData->pluck('total');

        // Low stock products
        $lowStockProducts = Product::where('stock', '<', 5)
            ->where('is_active', true)
            ->orderBy('stock')
            ->take(5)
            ->get();

        // Pending payments
        $pendingPayments = PaymentProof::pending()
            ->with('order')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'chartLabels',
            'chartData',
            'lowStockProducts',
            'pendingPayments'
        ));
    }
}
