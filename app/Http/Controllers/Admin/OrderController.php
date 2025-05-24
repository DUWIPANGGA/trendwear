<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'approvedBy', 'cancelledBy'])
            ->latest()
            ->paginate(10);

        return view('themes.indotoko.orders.index', compact('orders'));
    }

    public function create()
{
    $users = User::all(); 
    return view('themes.indotoko.orders.create', compact('users'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_first_name' => 'required|string|max:100',
            'customer_last_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_address1' => 'required|string|max:255',
            'customer_city' => 'required|string|max:100',
            'customer_province' => 'required|string|max:100',
            'customer_postcode' => 'required|string|max:10',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'customer_note' => 'nullable|string',
        ]);

        $validated['code'] = 'ORD-' . Str::upper(Str::random(10));
        $validated['order_date'] = now();
        $validated['payment_due'] = now()->addDays(1);

        Order::create($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order created successfully');
    }

    public function show(Order $order)
    {
        return view('themes.indotoko.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $users = User::customer()->get();
        $statuses = ['pending', 'processing', 'completed', 'cancelled'];
        
        return view('themes.indotoko.orders.edit', compact('order', 'users', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_first_name' => 'required|string|max:100',
            'customer_last_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_address1' => 'required|string|max:255',
            'customer_city' => 'required|string|max:100',
            'customer_province' => 'required|string|max:100',
            'customer_postcode' => 'required|string|max:10',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'customer_note' => 'nullable|string',
            'cancellation_note' => 'required_if:status,cancelled|nullable|string',
        ]);

        if ($validated['status'] == 'cancelled') {
            $validated['cancelled_by'] = auth()->id();
            $validated['cancelled_at'] = now();
        } elseif ($validated['status'] == 'completed') {
            $validated['approved_by'] = auth()->id();
            $validated['approved_at'] = now();
        }

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully');
    }

    public function approve(Order $order)
    {
        $order->update([
            'status' => 'completed',
            'approved_by' => auth()->id(),
            'approved_at' => now()
        ]);

        return back()->with('success', 'Order approved successfully');
    }

    public function cancel(Order $order)
    {
        $order->update([
            'status' => 'cancelled',
            'cancelled_by' => auth()->id(),
            'cancelled_at' => now()
        ]);

        return back()->with('success', 'Order cancelled successfully');
    }
}