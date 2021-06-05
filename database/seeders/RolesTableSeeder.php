<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supAdmin = Role::create([
            'name' => 'Super Admin',
        ]);
        
        $admin = Role::create([
            'name' => 'Admin',
        ]);

        $subAdmin = Role::create([
            'name' => 'Sub Admin',
        ]);

        $supUser = Role::create([
            'name' => 'Super User',
        ]);

        $user = Role::create([
            'name' => 'User',
        ]);

        $supadminPermissions = [
            'user-create', 'user-show-self', 'user-show-all', 'user-edit-self', 'user-edit-all', 'user-delete-self', 'user-delete-all', 'user-edit-role',
            'product-create', 'product-show', 'product-edit', 'product-soft-delete', 'product-permanent-delete', 'product-approve',
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

        $adminPermissions = [
            'user-create', 'user-show-self', 'user-show-all', 'user-edit-self', 'user-edit-all', 'user-delete-self', 'user-delete-all',
            'product-create', 'product-show', 'product-edit', 'product-soft-delete', 'product-permanent-delete', 'product-approve', 
            'brand-create', 'brand-show', 'brand-edit', 'brand-delete', 
            'line-create', 'line-show', 'line-edit', 'line-delete', 
            'ingredient-create', 'ingredient-show', 'ingredient-edit', 'ingredient-delete', 
            'form-create', 'form-show', 'form-edit', 'form-delete', 
            'category-create', 'category-show', 'category-edit', 'category-delete', 
            'indication-create', 'indication-show', 'indication-edit', 'indication-delete', 
            'review-create','review-show', 'review-delete-self', 'review-delete-all',
            'country-create', 'country-show', 'country-edit', 'country-delete'
        ];

        $subAdminPermissions = [
            'user-show-self','user-edit-self', 'user-delete-self',
            'product-create', 'product-show', 'product-edit', 'product-soft-delete', 'product-permanent-delete', 'product-approve', 
            'brand-create', 'brand-show', 'brand-edit', 'brand-delete', 
            'line-create', 'line-show', 'line-edit', 'line-delete', 
            'ingredient-create', 'ingredient-show', 'ingredient-edit', 'ingredient-delete', 
            'form-create', 'form-show', 'form-edit', 'form-delete', 
            'category-create', 'category-show', 'category-edit', 'category-delete', 
            'indication-create', 'indication-show', 'indication-edit', 'indication-delete', 
            'review-create','review-show', 'review-delete-self', 'review-delete-all',
            'country-create', 'country-show', 'country-edit', 'country-delete'
        ];

        $superUserPermissions = [
            'user-show-self','user-edit-self', 'user-delete-self',
            'product-create-request', 'product-show', 'product-edit-request', 'product-delete-request',  
            'brand-create', 'brand-show', 
            'line-create', 'line-show', 
            'ingredient-create', 'ingredient-show', 
            'form-create', 'form-show', 
            'category-create', 'category-show', 
            'indication-create', 'indication-show', 
            'country-create', 'country-show',
            'review-create','review-show', 'review-delete-self',
        ];

        $userPermissions = [
            'user-show-self','user-edit-self', 'user-delete-self',
            'product-show', 
            'brand-show', 
            'line-show', 
            'ingredient-show', 
            'form-show', 
            'category-show', 
            'indication-show', 
            'country-show', 
            'review-create','review-show', 'review-delete-self',
        ];

        $supAdmin->givePermissionTo($supadminPermissions);

        $admin->givePermissionTo($adminPermissions);
        
        $subAdmin->givePermissionTo($subAdminPermissions);

        $supUser->givePermissionTo($superUserPermissions);

        $user->givePermissionTo($userPermissions);
    }
}
