<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    const ACCEPT_REQUEST = 3;
    const DECLINE_REQUEST = 2;
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tutors()
    {
        return $this->belongsToMany(Tutor::class,'tutor_request')->withPivot('sender','status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function addTutor($id, $sender)
    {
        $this->tutors()->attach($id, ['sender'=>$sender]);
    }

    public function acceptTutorRequest($tutorId)
    {
        $tutor = $this->tutors()->find($tutorId);
        if ($this->status!==self::ACCEPT_REQUEST && $tutor->pivot->sender!==0){
            $this->status = self::ACCEPT_REQUEST;
            $this->save();
            $tutor->pivot->status = self::ACCEPT_REQUEST;
            $tutor->pivot->save();
            return true;
        }
        else{
            return false;
        }
    }
}
