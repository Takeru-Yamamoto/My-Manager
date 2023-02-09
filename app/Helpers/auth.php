<?php

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\Results\UserResult;
use App\Consts\RoleConst;

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
if (!function_exists('userCan')) {
    function userCan(string $attribute, User $user = null): bool
    {
        if (is_null($user)) $user = authUser();
        return $user->can($attribute);
    }
}
if (!function_exists('isSystem')) {
    function isSystem(User $user = null): bool
    {
        return userCan(RoleConst::SYSTEM, $user);
    }
}
if (!function_exists('isAdmin')) {
    function isAdmin(User $user = null): bool
    {
        return userCan(RoleConst::ADMIN, $user);
    }
}
if (!function_exists('isUser')) {
    function isUser(User $user = null): bool
    {
        return userCan(RoleConst::USER, $user);
    }
}
if (!function_exists('isAdminHigher')) {
    function isAdminHigher(User $user = null): bool
    {
        return userCan(RoleConst::ADMIN_HIGHER, $user);
    }
}
if (!function_exists('isUserHigher')) {
    function isUserHigher(User $user = null): bool
    {
        return userCan(RoleConst::USER_HIGHER, $user);
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
