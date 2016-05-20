<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'garden_id',
        'room',
        'phone',
        'img_url',
        'invite_code',
        'bonus_code',
        'bonus_status'
    ];

    /**
     * A profile belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function inviter($bonus_code)
    {
        $profile = $this->where('invite_code',$bonus_code)->first();

        $user = $profile->user;

        return $user;
    }

    /**
     * A user has a garden
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function garden()
    {
        return $this->belongsTo('App\Garden');
    }

    /**
     * Create a invite code
     */
    public function setInviteCodeAttribute()
    {
        $this->attributes['invite_code'] = strtoupper(bin2hex(openssl_random_pseudo_bytes(3)));
    }

    /**
     * The bonus code is not my code
     *
     * @param $invitecode
     * @return bool
     */
    public function notMyInviteCode($invitecode)
    {
        return $invitecode != $this->attributes['invite_code'];
    }

    /**
     * The bonus code is exist
     *
     * @param $invitecode
     * @return int
     */
    public function isInviteCode($invitecode)
    {
        return count($this->where('invite_code',$invitecode)->get());
    }


    /**
     * Is user have get the bonus
     *
     * @return bool
     */
    public function isGetBonus()
    {
        return $this->attributes['bonus_status'] != '已被邀请';
    }

    /**
     * Is user can ge bonus
     *
     * @param $invitecode
     * @return bool
     */
    public function isCanGetBouns($invitecode)
    {
        return $this->notMyInviteCode($invitecode) && $this->isInviteCode($invitecode) && $this->isGetBonus();
    }


}
