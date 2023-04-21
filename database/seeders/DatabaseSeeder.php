<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PassengerOnBoard;
use App\Models\UserGroup;
use App\Models\Operator;
use App\Models\Vessel;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Create the 2 unique user groups (Admin, Harbour Masters)
        UserGroup::factory(2)
            ->state(new Sequence(
                ['name' => 'admin'],
                ['name' => 'harbour_master'],
            ))
            ->hasUsers(1, [
                'active' => true
            ])
            ->create();
        
        //Create the last unique user group (Operators)
        UserGroup::factory()->create(['name' => 'operator']);

        // For each the operator we create 2 domains, 5 vessels and 2 users
        $opeartor = Operator::factory(5)
            ->hasDomains(2)
            // ->hasVessels(5)
            // ->hasUsers(2, [
            //     'user_group_id' => $userGroup->id,
            //     'active' => true    
            // ])
            ->create([
                'api_active' => true,
            ]);


        $opeartor->each(function ($instance) {
            PassengerOnBoard::factory()
                ->for(User::factory()->create([
                    'user_group_id' => 3,
                    'operator_id' => $instance,
                    'active' => true
                ]))
                ->for(Vessel::factory()->for($instance)->create())
                ->for($instance)
                ->create();
        });
        //Alternative approach
        /**
         *        $operator = Operator::factory()->create();
         *        $vessel = Vessel::factory()
         *          ->for($operator)
         *          ->create();
         *
         *      $user = User::factory()
         *          ->for(UserGroup::factory()->create(['name' => 'operator']))    
         *          ->for($operator)
         *          ->create();
         *
         *      $pod = PassengerOnBoard::factory()
         *          ->for($operator)
         *          ->for($vessel)
         *          ->for($user)
         *          ->create();
         */
         
            
    }
}
