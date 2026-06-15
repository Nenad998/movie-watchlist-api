<?php

namespace App\Http\Requests\Watchlist;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWatchlistItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'string', 'in:to_watch,watching,watched'],
            'personal_rating' => ['sometimes', 'nullable', 'integer', 'min:1', 'max:10'],
            'notes' => ['sometimes', 'nullable', 'string', 'max:2000'],
            'watched_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
