<?php

namespace App\Models;


use CodeIgniter\Shield\Models\GroupModel as ModelsGroupModel;
use CodeIgniter\Shield\Exceptions\InvalidArgumentException;

class GroupModel extends ModelsGroupModel
{
    public function changeGroupByUserId($id, $group)
    {
        $allowedGroups = array_keys(setting('AuthGroups.groups'));
        if (empty($group) || !in_array($group, $allowedGroups, true)) {
            throw new InvalidArgumentException(lang('Auth.unknownGroup', [$defaultGroup ?? '--not found--']));
        }

        return $this->db->table($this->table)->update(['group' => $group], ['user_id', $id]);
    }
}
