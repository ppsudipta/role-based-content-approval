<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RejectPostRequest extends FormRequest
{
    /**
     * Authorization
     */
    public function authorize(): bool
    {
        // ✅ Allow request, authorization handled in Policy
        return true;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'reason' => 'required|string|min:3|max:500',
        ];
    }
}