<?php

namespace App\Dto\Reflection;

class ReflectionData {
    public function __construct(
        public string $quote,
        public string $response,
    ) {
    }

}
