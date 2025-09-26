<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->integer('age')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->text('address')->nullable();
            $table->boolean('status')->default(1);
            $table->softDeletes(); // adds deleted_at column
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'image',
                'gender',
                'age',
                'role_id',
                'address',
                'status',
                'deleted_at',
                'deleted_by'
            ]);
        });
    }
};
