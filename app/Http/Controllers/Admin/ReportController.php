<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default periode: bulan ini
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();
            
        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();

        // ========== SUMMARY DATA ==========
        $totalTransaksi = Transaction::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalPendapatan = Transaction::whereBetween('created_at', [$startDate, $endDate])->sum('total');
        $totalPesanan = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $rataRataTransaksi = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        // ========== DAILY SALES ==========
        $dailySales = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // ========== TOP MENUS ==========
        $topMenus = DB::table('order_items')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('transactions', 'orders.id', '=', 'transactions.order_id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->select(
                'menus.nama',
                'menus.kategori',
                'menus.harga',
                DB::raw('SUM(order_items.qty) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_pendapatan')
            )
            ->groupBy('menus.id', 'menus.nama', 'menus.kategori', 'menus.harga')
            ->orderBy('total_qty', 'desc')
            ->limit(10)
            ->get();

        // ========== SALES BY CATEGORY ==========
        $salesByCategory = DB::table('order_items')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('transactions', 'orders.id', '=', 'transactions.order_id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->select(
                'menus.kategori',
                DB::raw('SUM(order_items.qty) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT transactions.id) as total_transaksi')
            )
            ->groupBy('menus.kategori')
            ->orderBy('total_pendapatan', 'desc')
            ->get();

        // ========== PAYMENT METHOD BREAKDOWN ==========
        $paymentMethods = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                'metode_pembayaran',
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('metode_pembayaran')
            ->get();

        // ========== HOURLY SALES PATTERN ==========
        $hourlySales = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        return view('admin.report.index', compact(
            'startDate',
            'endDate',
            'totalTransaksi',
            'totalPendapatan',
            'totalPesanan',
            'rataRataTransaksi',
            'dailySales',
            'topMenus',
            'salesByCategory',
            'paymentMethods',
            'hourlySales'
        ));
    }

    public function print(Request $request)
    {
        // Same data as index but for print view
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();
            
        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();

        $totalTransaksi = Transaction::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalPendapatan = Transaction::whereBetween('created_at', [$startDate, $endDate])->sum('total');
        $totalPesanan = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $rataRataTransaksi = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        $dailySales = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $topMenus = DB::table('order_items')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('transactions', 'orders.id', '=', 'transactions.order_id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->select(
                'menus.nama',
                'menus.kategori',
                'menus.harga',
                DB::raw('SUM(order_items.qty) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_pendapatan')
            )
            ->groupBy('menus.id', 'menus.nama', 'menus.kategori', 'menus.harga')
            ->orderBy('total_qty', 'desc')
            ->limit(10)
            ->get();

        $salesByCategory = DB::table('order_items')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('transactions', 'orders.id', '=', 'transactions.order_id')
            ->whereBetween('transactions.created_at', [$startDate, $endDate])
            ->select(
                'menus.kategori',
                DB::raw('SUM(order_items.qty) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_pendapatan')
            )
            ->groupBy('menus.kategori')
            ->orderBy('total_pendapatan', 'desc')
            ->get();

        $paymentMethods = Transaction::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                'metode_pembayaran',
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('metode_pembayaran')
            ->get();

        return view('admin.report.print', compact(
            'startDate',
            'endDate',
            'totalTransaksi',
            'totalPendapatan',
            'totalPesanan',
            'rataRataTransaksi',
            'dailySales',
            'topMenus',
            'salesByCategory',
            'paymentMethods'
        ));
    }

    public function export(Request $request)
    {
        // Export to CSV
        $startDate = $request->filled('start_date') 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();
            
        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();

        $transactions = Transaction::with(['order.items.menu'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $filename = 'laporan_penjualan_' . $startDate->format('Y-m-d') . '_to_' . $endDate->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['Tanggal', 'ID Transaksi', 'Pelanggan', 'Menu', 'Qty', 'Subtotal', 'Total', 'Metode Pembayaran']);
            
            // Data
            foreach ($transactions as $transaction) {
                foreach ($transaction->order->items as $item) {
                    fputcsv($file, [
                        $transaction->created_at->format('Y-m-d H:i'),
                        $transaction->id,
                        $transaction->order->nama_pelanggan,
                        $item->menu->nama,
                        $item->qty,
                        $item->subtotal,
                        $transaction->total,
                        $transaction->metode_pembayaran,
                    ]);
                }
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}