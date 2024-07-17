<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\PseudoTypes\True_;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->uuid('wallet_id');
            $table->string('admin_id');
            $table->string('wallet_name');
            $table->string('balance')->nullable()->default(0);
            $table->string('total_credit')->nullable()->default(0);
            $table->string('total_debit')->nullable()->default(0);
            $table->string('balance_limit')->nullable()->default(0);
            $table->boolean('isactive')->default(TRUE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
