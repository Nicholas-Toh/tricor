<?php

namespace App\Http\Requests\Sales;

use App\Enum\SalesReportView;
use App\Models\User;
use App\Enum\UserRole;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SalesReportRequest extends FormRequest
{
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
            'view' => ['nullable', 'string', Rule::in(['month', 'year'])],
            'month' => ['nullable', 'numeric', 'between:1,12'],
            'year' => ['nullable', 'string'],
            'agent' => ['nullable', 'numeric', 'exists:' . User::class . ',id'],
        ];
    }

    public function messages(): array {
        return [
            'view' => "Please select a valid format.",
            'month' => "Please enter a valid month.",
            'year' => "Please enter a valid year.",
            'agent' => "Agent does not exist.",
        ];
    }
}
