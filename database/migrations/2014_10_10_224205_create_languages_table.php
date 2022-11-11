<?php

use App\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

         $languages = [
             'English', 'Zulu', 'Afrikaans', 'Xhosa', 'Northern Sotho', 'Southern Sotho',
             'Venda', 'Ndebele', 'Swati', 'Tswana', 'Tsonga', 'Sign Language', 'Other'];

        foreach($languages as $language){
            Language::create(['name' => $language]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
