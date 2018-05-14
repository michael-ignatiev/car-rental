<?php

namespace App\Http\Traits;

trait UserRolesTrait {
    
    /**
     * Compare users role with the allowed ones.
     * 
     * @param string $userRole
     * @param array $allowedRoles
     * @return type string
     */
    public function allowActionForRoles($userRole, array $allowedRoles) {
        if(!in_array($userRole, $allowedRoles)){
            return response()->json(['message' => 'You don\'t have permission to perform this action.'], 401);
        }
    }
}