<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class UpdateUserLastActiveAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user= $request->user();
        if($user){
            // fillable لانو ما ضفنا العمود الجديد في ال forceFillاستخدمنا ال
            $user->forceFill([
                'last_active_at' => Carbon::now(),
            ])
            // لعمل تحديث لحالة المستخدم
            ->save();
        }
        return $next($request);
    }
}
