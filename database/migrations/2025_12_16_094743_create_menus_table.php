<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('menus', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug')->unique();
      $table->string('url')->nullable();
      $table->string('external_link')->nullable();
      $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade');
      $table->integer('order')->default(0);
      $table->boolean('is_active')->default(true);
      $table->string('icon')->nullable();
      $table->string('target')->default('_self');

      // JSON ustun - bir nechta joyda chiqishi mumkin
      $table->jsonb('locations')->nullable(); // ['header', 'footer', 'mobile']
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('menus');
  }
};
