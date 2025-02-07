<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\SaleItem;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch or calculate statistics, sales, etc. for your dashboard
        $totalSales = Sale::sum('total');
        $totalSalesReturn = 0; // replace with real logic
        $totalPurchase = 0;    // replace with real logic
        $totalPurchaseReturn = 0;
        $profit = $totalSales - $totalPurchase;
        $invoiceDue = 0; // replace with real logic
        $totalExpenses = 0;
        $totalPaymentReturns = 0;

        // Example data for charts
        $sales30 = [12000, 14000, 13500, 12500, 12800, 13400, 14500, 25000, 15500, 14000,14000, 15000,12000,18000,11000,12500, 13000, 18000, 17800, 19000, 12800, 13400, 14500, 25000, 15500, 14000,11400, 12100,16000,15500];
        $salesYear = [25000, 22000, 23500, 22500, 22800, 40400, 24500, 25000, 25500, 26000, 24000, 28500];

        // Example "Payment Due" table data
        $duePayments = [
            ['name' => 'Muluken Melese', 'avatar' => '/images/avatar1.png', 'invoice' => '23421', 'amount' => 1000],
            ['name' => 'Kebede mola', 'avatar' => '/images/avatar2.png', 'invoice' => '23123', 'amount' => 2000],
            ['name' => 'Mamo girma', 'avatar' => '/images/avatar3.png', 'invoice' => '43435', 'amount' => 3000],
            ['name' => 'solomon lema', 'avatar' => '/images/avatar4.png', 'invoice' => '23212', 'amount' => 4000],
        ];

        return view('dashboard', compact(
            'totalSales', 'totalSalesReturn', 'totalPurchase', 'totalPurchaseReturn',
            'profit', 'invoiceDue', 'totalExpenses', 'totalPaymentReturns',
            'sales30', 'salesYear', 'duePayments'
        ));
    }
}