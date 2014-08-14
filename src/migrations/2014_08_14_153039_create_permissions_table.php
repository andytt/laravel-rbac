<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('rbac_permissions')) {

            Schema::create('rbac_permissions', function ($t) {

                $t->engine = 'InnoDB';

                $t->increments('id');

                $t->string('role_id', 36);
                $t->string('resource_id', 36);

                $t->softDeletes();
                $t->timestamps();

                $t->unique(['role_id', 'resource_id'], 'role_resource_id_unique');

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

        if (Schema::hasTable('rbac_permissions')) {

            Schema::drop('rbac_permissions');

        }

    }

}
