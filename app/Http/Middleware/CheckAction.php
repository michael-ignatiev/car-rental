<?php

namespace App\Http\Middleware;

use Closure;
use App\UserAction;

class CheckAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $action
     * @return mixed
     */
    public function handle($request, Closure $next, $action)
    {
        $userAction = UserAction::where('name', $action)->first();
        $isAllowed = $this->checkActionPermission($request->user()->role->name, $userAction->roles);
        if($isAllowed){
            return $next($request);
        }else{
            return response()->json(['message' => 'You don\'t have permission to perform this action.'], 401);
        }
    }
    
    /**
     * Check if action allowed by comparing user role with the allowed ones for this action.
     * 
     * @param type $userRole
     * @param type $allowedRoles
     * @return boolean
     */
    private function checkActionPermission($userRole, $allowedRoles)
    {
        foreach ($allowedRoles as $allowedRole) 
        {
            if($userRole == $allowedRole->name)
            {
                return TRUE;
            }
        }
        return FALSE;
    }
}
