<?php

namespace App\Http\Controllers;

use App\Enum\SalesReportView;
use Illuminate\Http\Request;
use App\Models\SalesTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Sales\CreateSalesTransactionRequest;
use App\Http\Requests\Sales\SalesReportRequest;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class SalesReportController extends Controller
{
    public function index(SalesReportRequest $request): Response {
        switch($request->view) {
            case SalesReportView::Month->value:
                $month = $request->input('month', Carbon::now()->month);
                return Inertia::render('Sales/Report', [
                    'date' => Carbon::now()->day(1)->month($month),
                    'sales_transactions' => 
                        SalesTransaction::whereMonth($month)
                            ->when($request->agent, function($query, $agent_id) {
                                $query->whereUserId($agent_id);
                            })
                ]);
            case SalesReportView::Year->value:
                $year = $request->input('year', Carbon::now()->year);
                return Inertia::render('Sales/Report', [
                    'date' => Carbon::now()->day(1)->month(1)->year($year),
                    'sales_transactions' => 
                        SalesTransaction::whereYear($year)
                            ->when($request->agent, function($query, $agent_id) {
                                $query->whereUserId($agent_id);
                            })
                ]);
        }
    }
}
