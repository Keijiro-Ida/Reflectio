<?php

namespace App\UseCases\Reflection;

use App\Models\Reflection;
use App\Models\User;
use App\Dto\Reflection\ReflectionData;

class CreateReflectionUseCase
{
    public function handle(User $user, ReflectionData $data): Reflection
    {
        return $user->reflections()->create([
            'quote' => $data->quote,
            'response' => $data->response,
        ]);
    }
}
