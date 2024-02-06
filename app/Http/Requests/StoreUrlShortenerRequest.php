<?php

namespace App\Http\Requests;

use App\Models\UrlShortener;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreUrlShortenerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'original_url' => [
                'required',
                'url',
                function ($attribute, $value, $fail) {
                    $userId = auth()->id();
                    
                    $exists = UrlShortener::where('user_id', $userId)
                        ->where('original_url', $value)
                        ->exists();

                    if ($exists) {
                        $fail('The ' . $attribute . ' must be unique for the authenticated user.');
                    }
                },
            ],
        ];

        
    }
}
