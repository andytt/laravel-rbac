<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('rbac_roles')) {

            Schema::create('rbac_roles', function ($t) {

                $t->engine = 'InnoDB';

                $t->increments('id');

                $t->string('role_id', 36);
                $t->string('role_name', 100);

                $t->softDeletes();
                $t->timestamps();

                $t->unique('role_id', 'role_id_unique');
                $t->unique('role_name', 'role_name_unique');

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

        if (Schema::hasTable('rbac_roles')) {

            Schema::drop('rbac_roles');

        }

    }

}
