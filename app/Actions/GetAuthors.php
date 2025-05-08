<?php
declare(strict_types=1);

namespace App\Actions;

class GetAuthors
{
    public function __invoke(int $id)
    {
        return (new \App\Services\Contents\Content())->authors($id);
    }
}
