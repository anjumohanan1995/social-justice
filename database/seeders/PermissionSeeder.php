<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = $this->getPermissions();

        foreach ($permissions as $val) {
            // Use firstOrCreate to avoid duplicate entries
            Permission::firstOrCreate(
                ['name' => $val['name']], // Attributes to search for
                ['sub_permission' => $val['sub_permission']] // Attributes to set if not found
            );
        }
    }

    public function getPermissions()
    {
        return [
            ['name' => 'user-management', 'sub_permission' => json_encode([
                "users-list",
                "add-user",
                "edit-user",
                "delete-user"
            ])],
            ['name' => 'role-management', 'sub_permission' => json_encode([
                "role-list",
                "add-role",
                "edit-role",
                "delete-role"
            ])],
            ['name' => 'permission-management', 'sub_permission' => json_encode([
                "permission-list",
                "add-permission",
                "edit-permission",
            ])],
            ['name' => 'case-management', 'sub_permission' => json_encode([
                "case-list",
                "add-case",
                "edit-case",
                "delete-case",
                "appeal-case"
            ])],
            ['name' => 'police-station-management', 'sub_permission' => json_encode([
                "police-station-list",
                "add-police-station",
                "edit-police-station",
                "delete-police-station"
            ])],
            ['name' => 'orders-management', 'sub_permission' => json_encode([
                "orders-list",
                "add-orders",
                "edit-orders",
                "delete-orders"
            ])],
            ['name' => 'panchayat-management', 'sub_permission' => json_encode([
                "panchayat-list",
                "add-panchayat",
                "edit-panchayat",
                "delete-panchayat",
                "get-panchayath-list-user"
            ])],
        ];
    }
}
