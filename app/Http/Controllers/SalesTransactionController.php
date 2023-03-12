<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales\CreateSalesTransactionRequest;
use App\Models\SalesTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class SalesTransactionController extends Controller
{
    public function index(Request $request) {
        return SalesTransaction::paginate($request->input('limit', 10));
    }

    /**
     * Creates a new sales transaction entry.
     */
    public function store(CreateSalesTransactionRequest $request): Response
    {
        return SalesTransaction::create([
            'sales_item' => $request->sales_item,
            'amount' => $request->amount,
            'user_id' => Auth::id(),
        ]);
    }
}
