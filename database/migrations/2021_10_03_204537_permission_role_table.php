<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { Schema::create('permission_role', function (Blueprint $table) {
        $table->id();
        $table->foreignId("role_id")->constrained();
        $table->foreignId("permission_id")->constrained();
        $table->timestamps();
    });
    
    Schema::enableForeignKeyConstraints();;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropForeign("role_id")->constrained();
            $table->dropForeign("permission_id")->constrained();
        });
        Schema::dropIfExists('permission_role');
    }
}
