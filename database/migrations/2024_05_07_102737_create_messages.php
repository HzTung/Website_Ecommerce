<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('message_id'); // Tạo khóa chính với tên là `message_id` và tự động tăng
            $table->unsignedBigInteger('room_id'); // Tạo cột `room_id`
            $table->unsignedBigInteger('user_id'); // Tạo cột `user_id`
            $table->text('message_text'); // Tạo cột `message_text` kiểu TEXT
            $table->dateTime('sent_at')->default(DB::raw('CURRENT_TIMESTAMP')); // Cột `sent_at` với mặc định là CURRENT_TIMESTAMP
            $table->timestamps();

            // Thiết lập khóa ngoại cho `room_id` tham chiếu đến cột `room_id` của bảng `rooms`
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            // Thiết lập khóa ngoại cho `user_id` tham chiếu đến cột `user_id` của bảng `users`
            $table->foreign('user_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
