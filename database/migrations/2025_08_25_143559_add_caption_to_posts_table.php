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
    Schema::table('posts', function (Blueprint $table) {
        // Add caption field AFTER img_url for logical order
        $table->text('caption')->nullable()->after('img_url');
    });
}

public function down()
{
    Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn('caption');
    });
}
};
