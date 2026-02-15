<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderInvoiceDownloadController extends Controller
{
    public function __invoke(Request $request): StreamedResponse
    {
        $user = Auth::user();

        $orders = Order::query()
            ->when($user, function ($query) use ($user) {
                $query->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                        ->orWhere('customer_email', $user->email);
                });
            })
            ->latest()
            ->get();

        $fileName = 'omnicore-invoices-'.now()->format('YmdHis').'.csv';

        return response()->streamDownload(function () use ($orders) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Order ID',
                'ERP Order ID',
                'Customer Email',
                'Status',
                'Total Amount',
                'Created At',
            ]);

            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->id,
                    $order->erp_order_id,
                    $order->customer_email,
                    $order->status,
                    $order->total_amount,
                    optional($order->created_at)->toDateTimeString(),
                ]);
            }

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
