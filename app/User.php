<?php

namespace App;

use App\Mail\ResetPassword as ResetPasswordMail;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;
    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id', 'activation_code', 'country'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verified()
    {
        $this->activated = true;
        $this->activation_code = null;
        $this->save();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function addspaces()
    {
        return $this->hasMany(Addspace::class,'editor_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    // Role Handling Methods
    public function isManager()
    {
        return $this->role()->first()->name == 'Manager';
    }

    public function isEditor()
    {
        return $this->role()->first()->name == 'Editor';

    }

    public function isAdvertiser()
    {
        return $this->role()->first()->name == 'Advertiser';
    }

    public function getRole()
    {
        return $this->role()->first()->name;
    }

    public function getWallet(){
        return $this->wallet()->first();
    }

    public function getPendingThreadCount()
    {
        if($this->isManager())
            return 0;

        return $this->getWallet()->getTransactions()
                    ->filter(function($transaction){
                        $event = $transaction->getEvent();
                        return $event != null && $event->pending();
                    })
                    ->groupBy('event_id')
                    ->count();
    }

    public function getUsableAddspaces()
    {
        return $this->addspaces()
                    ->where('status', '<>', 'CLOSED')
                    ->get();
    }

    public function sendPasswordResetNotification($token)
    {
        $email = new ResetPasswordMail($token, $this->email);

        Mail::to($this->email)->send($email);

    }
}
