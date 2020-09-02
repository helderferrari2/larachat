<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ChatRepository.
 *
 * @package namespace App\Repositories;
 */
interface ChatRepository extends RepositoryInterface
{
    public function search(array $filter);
}
