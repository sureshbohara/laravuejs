<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $role_id = 1; 
        $permission = [
            'user' => ['add' => '1', 'edit' => '1', 'view' => '1', 'delete' => '1'],
            'role' => ['add' => '1', 'edit' => '1', 'view' => '1', 'delete' => '1'],
            'permission' => ['add' => '1', 'edit' => '1', 'view' => '1', 'delete' => '1'],
        ];

        DB::table('permissions')->insert([
            'role_id' => $role_id,
            'permission' => json_encode($permission),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
