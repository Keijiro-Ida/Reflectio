<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Dto\Reflection\ReflectionData;

class StoreReflectionRequest extends FormRequest
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
            'quote' => 'required|string|max:255',
            'response' => 'required|string|max:10000',
        ];
    }

    public function toDto(): ReflectionData
    {
        return new ReflectionData(
            quote: $this->input('quote'),
            response: $this->input('response'),
        );
    }
}
