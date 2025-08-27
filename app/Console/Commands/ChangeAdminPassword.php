<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class ChangeAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:pass {id} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $id = $this->argument('id');
        $password = $this->argument('password');

        $admin = Admin::find($id);

        if(!$admin){
            $this->error("User not found");
            return 1;
        }

        $admin->password = Hash::make($password);
        $admin->save();

        $this->info("Password successfuly changed!");
        return 0;
    }
}
