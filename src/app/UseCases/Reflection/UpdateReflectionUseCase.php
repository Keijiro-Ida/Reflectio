<?php

namespace App\UseCases\Reflection;

use App\Models\Reflection;
use App\Models\User;
use App\Dto\Reflection\ReflectionData;
use Illuminate\Support\Facades\Log;

class UpdateReflectionUseCase
{
    public function handle(User $user, int $reflection_id, ReflectionData $data): Reflection
    {
        $reflection = Reflection::findOrFail($reflection_id);

        if($reflection->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $reflection->update([
            'quote' => $data->quote,
            'response' => $data->response,
        ]);

        return $reflection;

    }
}
