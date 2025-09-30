<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventViewModel extends Model
{
    public $id;
    public $type;
    public $event;

    public function __construct($id, $type, $event)
    {
        $this->id = $id;
        $this->type = $type;
        $this->event = $event;
    }
}
