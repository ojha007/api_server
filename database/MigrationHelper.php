<?php

namespace Database;

use Illuminate\Database\Schema\Blueprint;

class MigrationHelper
{
    public function setForeignKey(Blueprint $table, $foreignTable, $column, $is_nullable = false)
    {
        if ($is_nullable) {
            $table->unsignedBigInteger($column)->nullable();
        } else {
            $table->unsignedBigInteger($column);
        }
        $table->foreign($column)
            ->references('id')
            ->on($foreignTable);
    }
}
