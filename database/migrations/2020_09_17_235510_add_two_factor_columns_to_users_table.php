<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFactorColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->table('users', function (Blueprint $table) {
            
            $table->foreign('role_id')->references('id')->on('roles')->after('id');
            $table->foreign('persona_id')->references('id')->on('personas')->after('id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->after('id');
            $table->text('two_factor_secret')
                    ->after('password')
                    ->nullable();

            $table->text('two_factor_recovery_codes')
                    ->after('two_factor_secret')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('two_factor_secret');
            $table->dropColumn('two_factor_recovery_codes');
        });
    }
}
