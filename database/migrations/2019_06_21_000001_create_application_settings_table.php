<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateApplicationSettingsTable.
 */
class CreateApplicationSettingsTable extends Migration
{
    const TABLE = 'application_settings';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function(Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();

            // A human friendly version of the key. Used to describe what the setting value
            // is for.
            $table->string('name')->nullable();

            // Longer description of the setting key, human readable.
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
