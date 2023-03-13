<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Sales\CreateSalesTransactionRequest;

class SalesTransactionController extends Controller
{
    public function index(Request $request) {
        return SalesTransaction::paginate($request->input('limit', 10));
    }

    /**
     * Creates a new sales transaction entry.
     */
    public function store(CreateSalesTransactionRequest $request): RedirectResponse
    {
        SalesTransaction::create([
            'sales_item' => $request->sales_item,
            'amount' => $request->amount,
            'user_id' => Auth::id(),
        ]);

        return Redirect::to('/dashboard');
    }
}
