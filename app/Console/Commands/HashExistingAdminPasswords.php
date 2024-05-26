<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class HashExistingAdminPasswords extends Command
{
    protected $signature = 'hash:existing-admin-passwords';
    protected $description = 'Hash existing plain text passwords in the admin table';

    public function handle()
    {
        $admins = Admin::all();

        foreach ($admins as $admin) {
            $admin->password = Hash::make($admin->password);
            $admin->save();
        }

        $this->info('Admin passwords hashed successfully.');
    }
}
