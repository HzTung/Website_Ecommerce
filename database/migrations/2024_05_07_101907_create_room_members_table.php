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
        Schema::create('room_members', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');

            // Thiết lập PRIMARY KEY là cặp (room_id, user_id)
            $table->primary(['room_id', 'user_id']);

            // Thiết lập FOREIGN KEY cho room_id tham chiếu đến bảng rooms
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            // Thiết lập FOREIGN KEY cho user_id tham chiếu đến bảng users
            $table->foreign('user_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('room_members');
    }
};
