<?php

use App\Models\Admin;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Admin::class)->nullable();
            $table->foreignIdFor(Division::class)->nullable();
            $table->foreignIdFor(District::class)->nullable();
            $table->foreignIdFor(Upazila::class)->nullable();
            $table->foreignIdFor(Union::class)->nullable();
            $table->mediumText('address')->nullable();
            $table->string('contact_number');
            $table->boolean('status')->default(1)->comment("0=permanentsuspended 1=active 2=renewalsuspended");
            $table->string('current_package')->default(1)->comment("1=test 2=free 3=premium");
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_sms')->default(1)->comment("0=disable 1=enable");
            $table->commonFields();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
