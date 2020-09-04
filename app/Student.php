<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const TYPE_STUDENT = 0;
    const TYPE_TEACHER = 1;
    const TYPE_BOTH = 3;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    const GENDER_BOTH = 3;
    const HOME_LEARNING = 1;
    const ONLINE_LEARNING = 2;
    const BOTH_LEARNING = 3;
    protected $guarded = [];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param array $fields
     */
    public function updateUserInfo(array $fields = [])
    {
        $this->user()->update($fields);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function createRequest(array $fields=[])
    {

        $fields = $this->checkArrayFields($fields);
        return $this->requests()->create($fields);
    }

    private function checkArrayFields($fields){
        if ( $fields['tutor_gender'] && count($fields['tutor_gender']) === 2 ){
            $fields['tutor_gender'] = self::GENDER_BOTH;
        } else {
            if ( array_key_exists('male',$fields['tutor_gender'])){
                $fields['tutor_gender'] = self::GENDER_MALE;
            } else if ( array_key_exists('female',$fields['tutor_gender'])){
                $fields['tutor_gender'] = self::GENDER_FEMALE;
            }
        }
        if ( $fields['type_of_tutor'] && count($fields['type_of_tutor']) === 2 ){
            $fields['type_of_tutor'] = self::TYPE_BOTH;
        } else {
            if ( array_key_exists('student',$fields['type_of_tutor'])){
                $fields['type_of_tutor'] = self::TYPE_STUDENT;
            } else if ( array_key_exists('teacher',$fields['type_of_tutor'])){
                $fields['type_of_tutor'] = self::TYPE_TEACHER;
            }
        }

        return $fields;
    }
}
