<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $guarded = [];

    const ACCEPT_REQUEST = 3;
    const DECLINE_REQUEST = 2;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authentications()
    {
        return $this->hasMany(Authentication::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'tutor_subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requests()
    {
        return $this->belongsToMany(Request::class,'tutor_request')->withPivot('sender','status');
    }

    /**
     * @param array $ids
     */
    public function setSubject(array $ids = [])
    {
        $this->subjects()->sync($ids);
    }

    public function createRequest($id, $sender)
    {
        $this->requests()->attach($id, ['sender'=>$sender]);
    }

    public function createExperiences(array $fields = [])
    {
        $this->experiences()->delete();
        foreach ($fields as $exp){
            $exp['start_time'] = $exp['start_time'] ? format_date($exp['start_time']) : NULL;
            $exp['end_time'] = $exp['end_time'] ? format_date($exp['end_time']) : NULL;
            $this->experiences()->create($exp);
        }
    }

    public function createEducations(array $fields = [])
    {
        $this->educations()->delete();
        foreach ($fields as $edu){
            $this->educations()->create($edu);
        }
    }

    public function createCertificates(array $fields = [])
    {
        $this->certificates()->delete();
        foreach ($fields as $cert){
            $this->certificates()->create($cert);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getSpecialities()
    {
        $subjects = $this->subjects;
        $specialities = collect();
        /** @var Subject $subject */
        foreach($subjects as $subject) {
            $speciality = $subject->speciality;
            $specialities = $specialities->add($speciality);
        }

        return $specialities->unique('id');
    }

    public function searchBySpeciality()
    {

    }

    public function createAuthentications(array $fields = [])
    {
        $this->authentications()->delete();
        foreach ($fields as $auth){
            $this->authentications()->create($auth);
        }
    }

    public function updateUserInfo(array $fields = [])
    {
        $this->user()->update($fields);
    }

    public function acceptRequest($requestId)
    {
        $request = $this->requests()->find($requestId);
        if ($request->status!==self::ACCEPT_REQUEST && $request->pivot->sender !==1){
            $request->status= self::ACCEPT_REQUEST;
            $request->save();
            $request->pivot->status = self::ACCEPT_REQUEST;
            $request->pivot->save();
            return true;
        }
        else{
            return false;
        }

    }

    public function declineRequest($requestId)
    {
        $request = $this->requests()->find($requestId);
        if ($request->pivot->status!==self::DECLINE_REQUEST){
            $request->pivot->status = self::DECLINE_REQUEST;
            $request->pivot->save();
            return true;
        }
        else{
            return false;
        }
    }

    public function deleteRequest($requestId)
    {
        $this->requests()->detach($requestId);
    }



}
