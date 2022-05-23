<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Boolean;

class Doings extends Model
{
    use HasFactory;

    /**
     * @var string[] fillable
     */
    protected $fillable = [
        'title',
        'finished',
        'urgent',
    ];

    /**
     * @var string[] validation rules
     */
    protected $rules = [
        'title' => 'string|min:3',
        'urgent' => 'bool',
        'finished' => 'bool',
    ];

    /**
     * Validation of parameters
     *
     * @param $data array
     *
     * @return bool
     */
    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);
        return $v->passes();
    }

    /**
     * Set Urgent status
     *
     * @param Boolean $urgent
     * @return void
     */
    public function setUrgent(bool $urgent)
    {
        $this->urgent = $urgent ? 1 : 0;
    }

    /**
     * Set finished status
     *
     * @param Boolean $finished
     * @return void
     */
    public function setDone(bool $finished)
    {
        $this->finished = $finished ? 1 : 0;
    }
}
