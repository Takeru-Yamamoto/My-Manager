<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\Profile as Forms;
use App\Models\Profile;
use App\Repositories\Results;
use App\Consts\TextConst;

class ProfileService extends BaseService
{
    public function getLoggedInUserProfile(): Results\ProfileResult
    {
        $profile = self::getProfile(authUserId());

        return $this->ProfileRepository->toResult($profile);
    }

    private function getProfile(int $userId): Profile
    {
        $profile = $this->ProfileRepository->where("created_by", $userId)->findRaw();

        if (is_null($profile)) {
            self::create($userId);
            $profile = self::getProfile($userId);
        }

        return $profile;
    }

    private function create(int $userId): void
    {
        $profile = $this->ProfileRepository->createEntity(
            $userId
        );

        Transaction(
            'プロフィール登録',
            function () use ($profile) {
                $profile->save();
            }
        );
    }

    public function update(Forms\UpdateForm $form): string
    {
        $profile = $this->ProfileRepository->findRawById($form->id);

        if (is_null($profile)) throw $form->exception(TextConst::FORM_ID_INJUSTICE);

        Transaction(
            'プロフィール更新',
            function () use ($profile) {
                $profile->save();
            }
        );

        return TextConst::PROFILE_UPDATED;
    }
}
