<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\models\User;
class MakeAdmin extends Command
{
    protected $signature='make:admin';
    protected $description = 'Create a new admin using CLI';
    public function handle()
    {
      $name = $this->ask('Admin Name');
      $email=$this->ask('Admin Email');
      $password = $this->ask('Admin Password');
      $confirmpassword = $this->ask('Confirm Password');

      if($password!=$confirmpassword)
        {
            $this->error('Wrong password');
            return 1;
        }

      if(User::where('email',$email)->exists())
        
        {
              $this->error('Email already exists');
            return 1;
        }

        User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'is_admin'=>true
        ]);

        $this->info("Admin account [{$email}] created successfully!");
        return 0;
    }
}
