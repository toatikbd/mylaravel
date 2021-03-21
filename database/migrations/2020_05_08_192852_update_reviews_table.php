<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('job_title')->after('name');
            $table->string('image')->default('default.png')->after('job_title');
            $table->integer('review_count')->default(0)->after('image');
            $table->string('review_text')->after('review_count');
            $table->boolean('status')->default(false)->after('review_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('name', 'job_title', 'image', 'review_count', 'review_text', 'status');
        });
    }
}
