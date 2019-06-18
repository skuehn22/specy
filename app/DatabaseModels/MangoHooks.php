<?php


namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

class MangoHooks extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mango_hooks';
    protected $primaryKey = 'id';
}