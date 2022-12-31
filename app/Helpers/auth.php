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
        return $UserRepository->toResult(auth()->user());
    }
}

if (!function_exists('isSystem')) {
    function isSystem(): bool
    {
        return authUserRole() === GateConst::SYSTEM_NUMBER;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return authUserRole() > GateConst::SYSTEM_NUMBER && authUserRole() <= GateConst::ADMIN_NUMBER;
    }
}

if (!function_exists('isUser')) {
    function isUser(): bool
    {
        return authUserRole() > GateConst::ADMIN_NUMBER && authUserRole() <= GateConst::USER_NUMBER;
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
