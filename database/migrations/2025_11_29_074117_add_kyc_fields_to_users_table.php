<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // KYC tracking
            $table->enum('kyc_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('kyc_document')->nullable();
            $table->timestamp('kyc_submitted_at')->nullable();
            $table->timestamp('kyc_reviewed_at')->nullable(); // <-- add this

            // Billing address
            $table->string('Home_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'kyc_status',
                'kyc_document',
                'kyc_submitted_at',
                'kyc_reviewed_at', // <-- add this
                'Home_address'
            ]);
        });
    }
};
