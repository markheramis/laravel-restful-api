<?php

namespace App\Repositories;

use App\Interfaces\RoleInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Traits\RepositoryTrait;

/**
 * Description of RoleRepository
 *
 * @author Mark
 */
class RoleRepository implements RoleRepositoryInterface {

    use RepositoryTrait;

    /**
     * The Eloquent role model FQCN.
     *
     * @var string
     */
    protected $model = \App\Models\Role::class;

    /**
     * {@inheritdoc}
     */
    public function findById(int $id): ?RoleInterface {
        return $this->createModel()->newQuery()->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findBySlug(string $slug): ?RoleInterface {
        return $this->createModel()->newQuery()->where('slug', $slug)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function findByName(string $name): ?RoleInterface {
        return $this->createModel()->newQuery()->where('name', $name)->first();
    }

}
