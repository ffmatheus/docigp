<?php

use App\Data\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsernameField extends Migration
{
    private function populate()
    {
        User::create([
            'name' => 'SISTEMA DOCIGP',
            'email' => ($email = 'system@docigp.alerj.rj.gov.br'),
            'username' => $email,
            'password' => Hash::make(Str::random(100)),
        ]);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username');
        });

        $this->populate();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
}
