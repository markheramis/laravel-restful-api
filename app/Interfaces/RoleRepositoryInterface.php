<?php

namespace App\Interfaces;
use App\Interfaces\RoleInterface;

/**
 *
 * @author Mark
 */
interface RoleRepositoryInterface {

    /**
     * Finds a role by the given primary key.
     *
     * @param int $id
     *
     * @return \App\Interfaces\RoleInterface|null
     */
    public function findById(int $id): ?RoleInterface;

    /**
     * Finds a role by the given slug.
     *
     * @param string $slug
     *
     * @return \App\Interfaces\RoleInterface|null
     */
    public function findBySlug(string $slug): ?RoleInterface;

    /**
     * Finds a role by the given name.
     *
     * @param string $name
     *
     * @return \App\Interfaces\RoleInterface|null
     */
    public function findByName(string $name): ?RoleInterface;
}
