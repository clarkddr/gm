<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Route;
use App\Models\Unit;
use App\Models\GasPrice;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->datetime('departure');
            $table->datetime('return')->nullable();
            $table->integer('passengers');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Unit::class);
            $table->foreignIdFor(GasPrice::class);
            $table->foreignIdFor(Route::class,'departure_route');
            $table->foreignIdFor(Route::class,'return_route')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
