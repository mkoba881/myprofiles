<?php

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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_name'); // プロフィール名を保存するカラム
            $table->string('introduction');  // 自己紹介本文を保存するカラム
            $table->string('career');  // 経歴本文を保存するカラム
            $table->string('achievement');  // 実績本文を保存するカラム
            $table->string('skill_qualification');  // スキル・資格を保存するカラム
            $table->string('image_path')->nullable();  // 画像のパスを保存するカラム
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
