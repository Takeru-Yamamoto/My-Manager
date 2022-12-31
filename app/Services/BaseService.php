<?php

namespace App\Services;

use App\Repositories\EmailResetRepository;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\AttendanceRepository;

abstract class BaseService
{
    public EmailResetRepository $EmailResetRepository;
    public PasswordResetRepository $PasswordResetRepository;
    public UserRepository $UserRepository;
    public ProfileRepository $ProfileRepository;
    public AttendanceRepository $AttendanceRepository;

    public function __construct()
    {
        $this->EmailResetRepository    = new EmailResetRepository();
        $this->PasswordResetRepository = new PasswordResetRepository();
        $this->UserRepository          = new UserRepository();
        $this->ProfileRepository       = new ProfileRepository();
        $this->AttendanceRepository    = new AttendanceRepository();
    }
}
