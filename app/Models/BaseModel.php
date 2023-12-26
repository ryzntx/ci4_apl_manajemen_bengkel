<?php

namespace App\Models;

use CI4Extensions\Database\RelationshipsTrait;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class BaseModel extends Model
{
    // use ModelTrait;
    use RelationshipsTrait;
}
