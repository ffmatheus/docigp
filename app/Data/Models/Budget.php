<?php

namespace App\Data\Models;

class Budget extends Base
{
    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'federal_value',
        'percentage',
        'value',
        'created_by_id',
        'updated_by_id',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (blank($this->value)) {
            $this->value = ($this->federal_value * $this->percentage) / 100;
        }

        return parent::save();
    }
}
