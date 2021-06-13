<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TicketUser extends Pivot
{
    protected $table='ticket_user';

    protected $primaryKey = 'marchent_id';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;



    protected $fillable = [
        'marchent_id',
        'count',
        'paid',
        'used_at',
        'init_response',
        'order_response'
    ];
}