<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = User::first();

        if (is_null($admin)) {
            $admin = new User();
            $admin->name = "Sabbir Hossain";
            $admin->email = "Sabbir@gmail.com";
            $admin->password = Hash::make('password');
            $admin->save();
        }


        $folders = ['banner', 'career', 'wedo'];

        foreach ($folders as $folder) {
            // This will create directories inside storage/app/public
            Storage::disk('public')->makeDirectory($folder);
        }

        $this->command->info('Image directories created: user, blog, product');
    }
}
