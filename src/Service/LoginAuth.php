<?php

namespace Phy\Core\Service;

use Phy\Core\Helpers\DateUtil;
use Phy\Core\CoreService;
use Phy\Core\DefaultService;
use Phy\Core\CoreException;
use Phy\Core\Models\User;
use Phy\Core\Models\Role;
use Phy\Core\Models\ApiToken;
use DB;

class LoginAuth extends CoreService implements DefaultService {

    public $transaction = true;

    public function getDescription()
    {
        return "Do Login";
    }

    public function prepare($input)
    {
        
    }

    public function process($input, $originalInput)
    {
        $user = User::where("username", $input["username"])->first();
        if(is_null($user)){
            throw New CoreException("User not found");
        }

        if(!password_verify($input["password"], $user->password)){
            throw New CoreException("User and Password don't match");
        }

        $key = sha1($user->id.microtime().rand(1000,999));

        $api = new ApiToken;
        $api->user_id = $user->id;
        $api->key = $key;
        $api->created_at = DATE_TIME_ACCESS;
        $api->updated_at = DATE_TIME_ACCESS;
        $api->save();

        $user->key = $key;

        $role = Role::find($user->role_default_id);

        $tasks = DB::select(
            "SELECT string_agg(A.task_name, ', ') AS result 
                FROM phy_tasks A 
            INNER JOIN phy_role_task B ON A.id=B.task_id
                WHERE B.role_id=".$role->id);
        
        \Log::debug("SELECT string_agg(A.task_name, ', ') AS result 
        FROM phy_tasks A 
    INNER JOIN phy_role_task B ON A.id=B.task_id
        WHERE B.role_id=".$role->id);
        $session = [
            "user_id" => $user->id,
            "username" => $user->username,
            "key" => $key,
            "role" => $role->id,
            "role" => $role->role_name,
            "tasks" => explode(", ", $tasks[0]->result)
        ];

        return $session;

    }

}