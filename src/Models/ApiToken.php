<?php

namespace Phy\Core\Models;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    public $table      = "phy_api_token";
    public $timestamps = false;
}
