<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseProviderRequest extends FormRequest
{
    protected static function rulesForProvider(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|min:10|max:15',
            'address' => 'required|string|max:255',
        ];
    }
}
