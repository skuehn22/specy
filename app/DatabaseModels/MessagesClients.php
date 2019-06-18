<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 27.02.2019
 * Time: 17:56
 */

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

class MessagesClients extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages_clients';
    protected $primaryKey = 'id';

}