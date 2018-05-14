<?php

namespace App\Http\Traits;

trait UserRolesTrait {
    
    /**
     * Compare user's role with the allowed ones.
     * 
     * @param string $userRole
     * @param array $allowedRoles
     * @return type string
     */
    public function checkActionPermission($userRole, $allowedRoles) {
        $actionIsAllowed = FALSE;
        foreach ($allowedRoles as $allowedRole) {
            if($userRole == $allowedRole->name){
                $actionIsAllowed = TRUE;
                break;
            }
        }
        if(!$actionIsAllowed){
            return response()->json(['message' => 'You don\'t have permission to perform this action.'], 401);
        }
    }
}