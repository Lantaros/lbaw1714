<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    public $timestamps  = false;

    protected $primaryKey = 'idtickettype';
    protected $table = 'tickettype';

}
