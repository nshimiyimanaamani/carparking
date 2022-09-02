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
        Schema::create('parking_records', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Vehicle::class,'vehicle_id');
            $table->foreignIdFor(App\Models\parkingslots::class,'splot_id');
            // $table->timestamp('checkin')->nullable()->default(null);
            $table->timestamp('checkout')->nullable;
            $table->integer('fees')->nullable();

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
        Schema::dropIfExists('parking_records');
    }
};
