<?php

namespace App\Http\Requests\Sales;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class CreateSalesTransactionRequest extends FormRequest
{
    protected $redirectRoute = 'dashboard';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return in_array($this->user()->role, [UserRole::Manager, UserRole::MarketingAgent]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'sales_item' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'gt:0'],
        ];
    }

    public function messages() {
       return [
            'amount.numeric' => 'Please enter a number.',
            'amount.gt' => 'Please enter a valid amount.',
       ];
    }
}
