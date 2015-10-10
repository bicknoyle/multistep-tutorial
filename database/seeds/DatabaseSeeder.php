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

        Question::create(['step' => 1, 'name' => 'name', 'template' => 'survey.question.name', 'rule' => 'required|min:2|max:50']);
        Question::create(['step' => 2, 'name' => 'color', 'template' => 'survey.question.color', 'rule' => 'required|min:3']);
        Question::create(['step' => 3, 'name' => 'pet', 'template' => 'survey.question.pet', 'rule' => 'required|in:Cats,Dogs']);

        // More questions...
        Question::create(['step' => 1, 'name' => 'nickname', 'template' => 'survey.question.nickname', 'rule' => 'sometimes|min:2|max:50']);
        Question::create(['step' => 2, 'name' => 'shape', 'template' => 'survey.question.shape', 'rule' => 'required']);
        Question::create(['step' => 3, 'name' => 'pet_count', 'template' => 'survey.question.pet_count', 'rule' => 'required']);

        Model::reguard();
    }
}
