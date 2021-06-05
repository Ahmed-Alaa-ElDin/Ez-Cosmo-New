<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'user-create', 'user-show-self', 'user-show-all', 'user-edit-self', 'user-edit-all', 'user-delete-self', 'user-delete-all', 'user-edit-role',
            'product-create', 'product-create-request', 'product-show', 'product-edit', 'product-edit-request', 'product-delete-request', 'product-soft-delete', 'product-permanent-delete', 'product-approve',
            'brand-create', 'brand-show', 'brand-edit', 'brand-delete',
            'line-create', 'line-show', 'line-edit', 'line-delete',
            'ingredient-create', 'ingredient-show', 'ingredient-edit', 'ingredient-delete',
            'form-create', 'form-show', 'form-edit', 'form-delete',
            'category-create', 'category-show', 'category-edit', 'category-delete',
            'indication-create', 'indication-show', 'indication-edit', 'indication-delete',
            'country-create', 'country-show', 'country-edit', 'country-delete',
            'review-create', 'review-show', 'review-delete-self', 'review-delete-all',
            'role-permission-edit'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        };
    }
}
