<?php

namespace App\UseCases\Reflection;

use App\Models\Reflection;
use App\Models\User;
use App\Dto\Reflection\ReflectionData;

class DeleteReflectionUseCase
{
    public function handle(User $user, int $reflection_id): void
    {
        $reflection = Reflection::findOrFail($reflection_id);

        if($reflection->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $reflection->delete();
    }
}
