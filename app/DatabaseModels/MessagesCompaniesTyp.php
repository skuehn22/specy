<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 09.10.2018
 * Time: 17:56
 */

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

class MessagesCompaniesTyp extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages_companies_typ';
    protected $primaryKey = 'id';
}