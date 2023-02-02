<?php

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\Results\UserResult;
use App\Consts\GateConst;

if (!function_exists('isLoggedIn')) {
    function isLoggedIn(): bool
    {
        return auth()->check();
    }
}
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
        $roleNum = is_null($user) ? roleNum(authUser()) : roleNum($user);
        return $roleNum === GateConst::SYSTEM_NUMBER;
    }
}
if (!function_exists('isAdmin')) {
    function isAdmin(User $user = null): bool
    {
        $roleNum = is_null($user) ? roleNum(authUser()) : roleNum($user);
        return $roleNum === GateConst::ADMIN_NUMBER;
    }
}
if (!function_exists('isUser')) {
    function isUser(User $user = null): bool
    {
        $roleNum = is_null($user) ? roleNum(authUser()) : roleNum($user);
        return $roleNum === GateConst::USER_NUMBER;
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
        return authUser()->id;
    }
}
if (!function_exists('authUserName')) {
    function authUserName(): string
    {
        return authUser()->name;
    }
}
if (!function_exists('authUserRole')) {
    function authUserRole(): int
    {
        return authUser()->role;
    }
}
