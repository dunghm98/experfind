<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    protected $guarded = [];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request()
    {
        return $this->belongsTo(Request::class);
    }
    public function checkSchedule($day, $time)
    {
        $day = $this->getAttribute($day);
        if( strpos($day, $time) !== false) {
            return true;
        }
        return false;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

}
