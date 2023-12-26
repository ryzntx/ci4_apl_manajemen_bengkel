<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Shield\Models\UserModel as ModelsUserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\InvalidArgumentException;
use Tatter\Relations\Traits\BaseTrait;
use Tatter\Relations\Traits\ModelTrait;

class UserModel extends ModelsUserModel
{

    protected $allowedFields  = [
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'deleted_at',
        'name',
        'no_telp',
        'alamat'
    ];

    public function addToGroup(User $user, $group): void
    {
        $defaultGroup  = $group;
        $allowedGroups = array_keys(setting('AuthGroups.groups'));

        if (empty($defaultGroup) || !in_array($defaultGroup, $allowedGroups, true)) {
            throw new InvalidArgumentException(lang('Auth.unknownGroup', [$defaultGroup ?? '--not found--']));
        }

        $user->addGroup($defaultGroup);
    }
}
