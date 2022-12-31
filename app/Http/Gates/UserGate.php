<?php 

namespace App\Http\Gates;

use Illuminate\Support\Facades\Gate;
use App\Consts\GateConst;

class UserGate 
{
    public static function define()
    {
        Gate::define(GateConst::SYSTEM, function ($user) {
            return ($user->role === GateConst::SYSTEM_NUMBER);
        });

        Gate::define(GateConst::ADMIN, function ($user) {
            return ($user->role > GateConst::SYSTEM_NUMBER && $user->role <= GateConst::ADMIN_NUMBER);
        });
        Gate::define(GateConst::ADMIN_HIGHER, function ($user) {
            return ($user->role > 0 && $user->role <= GateConst::ADMIN_NUMBER);
        });

        Gate::define(GateConst::USER, function ($user) {
            return ($user->role > GateConst::ADMIN_NUMBER && $user->role <= GateConst::USER_NUMBER);
        });
        Gate::define(GateConst::USER_HIGHER, function ($user) {
            return ($user->role > 0 && $user->role <= GateConst::USER_NUMBER);
        });
    }
}