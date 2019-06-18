<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 01.02.2019
 * Time: 20:13
 */

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

class PlansTypes extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plan_types';
    protected $primaryKey = 'id';
}