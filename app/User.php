<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Cart;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function carts()
    {
       return $this->hasMany(Cart::class);
    }

    /*acceso para el campo cart_id, que es el que llamaremos en CartDetailController
    para ver cual es el usuario del carrito, esto va asr un método calculado*/
    public function getCartAttribute()
    {
      $cart = $this->carts()->where('status', 'Active')->first();
      if($cart)
      // {
        return $cart;
      // } else {
      $cart = new Cart();
      $cart->status = 'Active';
      $cart->user_id = $this->id;
      $cart->save();
      // }
      return $cart;
    }
}
