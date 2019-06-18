<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 14.08.2018
 * Time: 20:13
 */

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id';
}