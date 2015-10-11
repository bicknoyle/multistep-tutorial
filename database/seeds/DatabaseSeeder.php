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
        #Question::create(['step' => 1, 'name' => 'nickname', 'template' => 'survey.question.nickname', 'rule' => 'sometimes|min:2|max:50']);
        #Question::create(['step' => 2, 'name' => 'shape', 'template' => 'survey.question.shape', 'rule' => 'required']);
        #Question::create(['step' => 3, 'name' => 'pet_count', 'template' => 'survey.question.pet_count', 'rule' => 'required']);

        Model::reguard();
    }
}
