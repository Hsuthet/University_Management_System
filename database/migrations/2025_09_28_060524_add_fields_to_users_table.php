<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->tinyInteger('role')->default(1)->comment('0=Admin, 1=Student, 2=Teacher');
        $table->foreignId('department_id')->nullable()->constrained('departments');
        $table->foreignId('academic_year_id')->nullable()->constrained('academic_years');
        $table->string('phone_number', 20)->nullable();
        $table->integer('age')->nullable();
        $table->text('address')->nullable();
        $table->string('roll_number', 50)->nullable();
        $table->string('father_name', 100)->nullable();
        $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
        $table->string('nrc', 100)->nullable();
        $table->string('profile_image')->nullable();
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
             $table->dropColumn([
            'role','department_id','academic_year_id','phone_number','age',
            'address','roll_number','father_name','gender','nrc','profile_image'
        ]);
        });
    }
}
