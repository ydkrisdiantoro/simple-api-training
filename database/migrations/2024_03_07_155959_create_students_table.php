<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;
use Brokenice\LaravelMysqlPartition\Models\Partition;
use Brokenice\LaravelMysqlPartition\Schema\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('name');
            $table->string('birth_date');
            $table->string('address');
            $table->string('phone');
            $table->integer('year_in')->index();
            $table->timestamps();
            $table->primary(['id', 'year_in']);
        });

        // Force autoincrement of one field in composite primary key
        Schema::forceAutoIncrement('students', 'id');

  		// Make partition by LIST
        Schema::partitionByList('students', 'year_in', [
            new Partition('year2020', Partition::LIST_TYPE, [2020]),
            new Partition('year2021', Partition::LIST_TYPE, [2021]),
            new Partition('year2022', Partition::LIST_TYPE, [2022]),
            new Partition('year2023', Partition::LIST_TYPE, [2023]),
            new Partition('year2024', Partition::LIST_TYPE, [2024]),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
