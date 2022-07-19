<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultWeaponImage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('weapons')) {
            Schema::table('weapons', function (Blueprint $table) {
                if (Schema::hasColumn('weapons', 'image_url')) {
                    $table->string('image_url')->nullable()->default(null)->change();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
