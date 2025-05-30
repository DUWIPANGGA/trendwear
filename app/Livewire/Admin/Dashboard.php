<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ActivityLog;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $salesData;
    public $revenueData;
    
    public function mount()
    {
        // Prepare data for charts
        $this->prepareChartData();
    }

    protected function prepareChartData()
    {
        // Last 30 days sales data
        $sales = Order::where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        // Last 30 days revenue data
        $revenue = Order::where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(grand_total) as amount')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('amount', 'date');

        $this->salesData = [
            'labels' => $sales->keys()->map(fn($date) => Carbon::parse($date)->format('d M'))->toArray(),
            'data' => $sales->values()->toArray()
        ];

        $this->revenueData = [
            'labels' => $revenue->keys()->map(fn($date) => Carbon::parse($date)->format('d M'))->toArray(),
            'data' => $revenue->values()->toArray()
        ];
    }

    public function render()
    {
        $stats = [
            'total_sales' => [
                'value' => Order::where('status', 'completed')->sum('grand_total'),
                'change' => $this->getSalesChangePercentage()
            ],
            'total_products' => [
                'value' => Product::count(),
                'change' => $this->getProductChangePercentage()
            ],
            'total_users' => [
                'value' => User::count(),
                'change' => $this->getUserChangePercentage()
            ],
            'new_orders' => Order::where('status', 'pending')->count()
        ];

        $recentOrders = Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $topProducts = Product::with('category')
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(5)
            ->get();

        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('themes.indotoko.dashboard', [
            'stats' => $stats,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
            'recentActivities' => $recentActivities,
            'salesData' => $this->salesData,
            'revenueData' => $this->revenueData
        ]);
    }

    protected function getSalesChangePercentage()
    {
        $currentMonth = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('grand_total');

        $lastMonth = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('grand_total');

        return $lastMonth > 0 ? round(($currentMonth - $lastMonth) / $lastMonth * 100, 1) : 100;
    }

    protected function getProductChangePercentage()
    {
        $currentMonth = Product::whereMonth('created_at', now()->month)->count();
        $lastMonth = Product::whereMonth('created_at', now()->subMonth()->month)->count();

        return $lastMonth > 0 ? round(($currentMonth - $lastMonth) / $lastMonth * 100, 1) : 100;
    }

    protected function getUserChangePercentage()
    {
        $currentMonth = User::whereMonth('created_at', now()->month)->count();
        $lastMonth = User::whereMonth('created_at', now()->subMonth()->month)->count();

        return $lastMonth > 0 ? round(($currentMonth - $lastMonth) / $lastMonth * 100, 1) : 100;
    }
}