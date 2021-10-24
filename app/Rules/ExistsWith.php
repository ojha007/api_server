<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExistsWith implements Rule
{

    private $column;
    private $table;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $column
     */
    public function __construct(string $table, string $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $column = explode('.', $this->column);
        if (count($column) > 1) {
            $inputs = request()->get($column[0]);
            $input = $inputs[end($column)];
        } else {
            $input = request()->get($column[0]);
        }
        $exists = DB::table($this->table)
            ->where(end($column), '=', $input)
            ->where('id', '=', $value)
            ->count();
        if (!$exists) return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "The :attribute doesn't exists with given " . $this->column;
    }
}
