<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{

    public static $requested_status = 0;
    public static $accepted_status = 1;
    public static $declined_status = 2;


    protected $fillable=['user_id','event_id','status'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function StatusName($id)
    {
        switch ($id){
            case static::$requested_status: return 'requested';
            case static::$accepted_status: return 'accepted';
            case static::$declined_status: return 'declined';
        }
    }
}
