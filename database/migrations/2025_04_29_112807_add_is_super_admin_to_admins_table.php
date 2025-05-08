<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSuperAdminToAdminsTable extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'is_super_admin')) {
                // Menambah kolom 'is_super_admin' dengan default 0
                $table->boolean('is_super_admin')->default(0)->after('password');
            }
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            if (Schema::hasColumn('admins', 'is_super_admin')) {
                // Menghapus kolom 'is_super_admin'
                $table->dropColumn('is_super_admin');
            }
        });
    }
}
