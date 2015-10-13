<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Question::create(['step' => 1, 'name' => 'name', 'type' => 'text', 'text' => 'What is your name?', 'rule' => 'required|min:2|max:50']);
        Question::create(['step' => 2, 'name' => 'color', 'type' => 'text', 'text' => 'What is your favorite color?', 'rule' => 'required|min:3']);
        Question::create(['step' => 3, 'name' => 'pet', 'type' => 'radio', 'text' => 'Which type of pet is best?', 'values' => ['Cats', 'Dogs', 'Lizards'], 'rule' => 'required|in:Cats,Dogs']);

        // More questions...
        Question::create(['step' => 1, 'name' => 'nickname', 'type' => 'text', 'text' => 'What is your nickname? (optional)', 'rule' => 'sometimes|min:2|max:50']);
        Question::create(['step' => 2, 'name' => 'shape', 'type' => 'text', 'text' => 'What is your favorite shape?', 'rule' => 'required']);
        Question::create(['step' => 3, 'name' => 'pet_count', 'type' => 'text', 'text' => 'How many pets do you have?', 'rule' => 'integer']);

        Question::create(['step' => 4, 'name' => 'opt_in', 'type' => 'radio', 'text' => 'Can we send you email?', 'values' => ['Yes', 'No'], 'rule' => 'required|in:Yes,No']);
        Question::create(['step' => 4, 'name' => 'how_hear', 'type' => 'text', 'text' => 'How did you hear about us? (optional)']);

        Model::reguard();
    }
}
