<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('rbac_resources')) {

            Schema::create('rbac_resources', function ($t) {

                $t->engine = 'InnoDB';

                $t->increments('id');

                $t->string('resource_id', 36);
                $t->string('resource_name', 100);
                $t->string('resource_action', 100);

                $t->softDeletes();
                $t->timestamps();

                $t->unique('resource_id', 'resource_id_unique');
                $t->unique(['resource_name', 'resource_action'], 'resource_name_action_unique');

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

        if (Schema::hasTable('rbac_resources')) {

            Schema::drop('rbac_resources');

        }

    }

}
