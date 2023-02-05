<?php 

namespace App\Http\Gates;

use Illuminate\Support\Facades\Gate;
use App\Consts\RoleConst;

class UserGate 
{
    public static function define()
    {
        Gate::define(RoleConst::SYSTEM, function ($user) {
            return ($user->role === RoleConst::SYSTEM_NUMBER);
        });

        Gate::define(RoleConst::ADMIN, function ($user) {
            return ($user->role > RoleConst::SYSTEM_NUMBER && $user->role <= RoleConst::ADMIN_NUMBER);
        });
        Gate::define(RoleConst::ADMIN_HIGHER, function ($user) {
            return ($user->role > 0 && $user->role <= RoleConst::ADMIN_NUMBER);
        });

        Gate::define(RoleConst::USER, function ($user) {
            return ($user->role > RoleConst::ADMIN_NUMBER && $user->role <= RoleConst::USER_NUMBER);
        });
        Gate::define(RoleConst::USER_HIGHER, function ($user) {
            return ($user->role > 0 && $user->role <= RoleConst::USER_NUMBER);
        });
    }
}