<?php

namespace App\Http\Requests\Watchlist;

use Illuminate\Foundation\Http\FormRequest;

class AddMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required_without:external_id', 'string', 'max:255'],
            'external_id' => ['required_without:title', 'string', 'max:50'],
        ];
    }
}
