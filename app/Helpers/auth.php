<?php

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\Results\UserResult;
use App\Consts\GateConst;

if (!function_exists('authUser')) {
    function authUser(): User
    {
        return auth()->user();
    }
}

if (!function_exists('authUserResult')) {
    function authUserResult(): UserResult
    {
        $UserRepository = new UserRepository();
        return $UserRepository->toResult(authUser());
    }
}

if (!function_exists('isSystem')) {
    function isSystem(User $user = null): bool
    {
        $role = is_null($user) ? authUserRole() : $user->role;
        return $role === GateConst::SYSTEM_NUMBER;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin(User $user = null): bool
    {
        $role = is_null($user) ? authUserRole() : $user->role;
        return $role > GateConst::SYSTEM_NUMBER && $role <= GateConst::ADMIN_NUMBER;
    }
}

if (!function_exists('isUser')) {
    function isUser(User $user = null): bool
    {
        $role = is_null($user) ? authUserRole() : $user->role;
        return $role > GateConst::ADMIN_NUMBER && $role <= GateConst::USER_NUMBER;
    }
}

if (!function_exists('isAdminHigher')) {
    function isAdminHigher(User $user = null): bool
    {
        if (is_null($user)) $user = authUser();
        return isSystem($user) || isAdmin($user);
    }
}

if (!function_exists('authUserId')) {
    function authUserId(): int
    {
        return auth()->user()->id;
    }
}

if (!function_exists('authUserName')) {
    function authUserName(): string
    {
        return auth()->user()->name;
    }
}

if (!function_exists('authUserRole')) {
    function authUserRole(): int
    {
        return auth()->user()->role;
    }
}
