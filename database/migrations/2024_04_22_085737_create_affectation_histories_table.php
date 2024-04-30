<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateAffectationHistoriesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('affectation_histories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('affectation_id');
                $table->string('action');
                $table->string('code_matricule');
                $table->string('nom');
                $table->foreignId('telephone_N');
                $table->string('department_name'); // Nom du département associé à l'affectation
                $table->string('application1')->nullable();
                $table->string('application2')->nullable();
                $table->string('application3')->nullable();
                $table->string('application4')->nullable();
                $table->date('date_debut');
                $table->date('date_fin')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('affectation_histories');
        }
    }


