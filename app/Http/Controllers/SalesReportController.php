<?php

namespace App\Http\Controllers;

use App\Enum\SalesReportView;
use App\Models\SalesTransaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Sales\SalesReportRequest;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class SalesReportController extends Controller
{
    public function index(SalesReportRequest $request): Response {
        $month = $request->input('month') ?? Carbon::now()->month;
        $year = $request->input('year') ?? Carbon::now()->year;
        $view = SalesReportView::tryFrom($request->input('view')) ?? SalesReportView::Month;

        return Inertia::render('ManagerReports', [
            'view' => $request->view,
            'views' => SalesReportView::cases(),
            'viewLabels' => config('labels.sales_report_view_labels'),
            'date' => Carbon::now()->day(1)->month($month)->year($year),
            'salesTransactions' => 
                SalesTransaction::with('user')
                    ->when($view === SalesReportView::Month, function ($query) use ($month) {
                        $query->whereMonth('created_at', $month);
                    })
                    ->whereYear('created_at', $year)
                    ->when($request->agent, function($query, $agent_id) {
                        $query->whereUserId($agent_id);
                    })
                    ->whereHas('user', function ($query) {
                        $query->whereHas('marketing_agent', function ($query) {
                            $query->whereManagerId(Auth::id());
                        });
                    })
                    ->get(),
            'agents' => $request->user()->marketing_agents
        ]);
    }
}
