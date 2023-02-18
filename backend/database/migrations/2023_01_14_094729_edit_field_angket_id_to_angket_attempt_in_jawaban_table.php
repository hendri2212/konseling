<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFieldAngketIdToAngketAttemptInJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jawaban', function (Blueprint $table) {
            $table->dropForeign('jawaban_siswa_id_foreign');
            $table->dropColumn('siswa_id');
            $table->dropForeign('jawaban_angket_id_foreign');
            $table->dropColumn('angket_id');
            $table->uuid('angket_attempt_id')->after('jawaban');

            $table->foreign('angket_attempt_id')->references('id')->on('angket_attempts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jawaban', function (Blueprint $table) {
            $table->uuid('siswa_id')->after('jawaban');
            $table->uuid('angket_id')->after('siswa_id');
            $table->dropForeign('jawaban_angket_attempt_id_foreign');
            $table->dropColumn('angket_attempt_id');
            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('angket_id')->references('id')->on('angket');
        });
    }
}
