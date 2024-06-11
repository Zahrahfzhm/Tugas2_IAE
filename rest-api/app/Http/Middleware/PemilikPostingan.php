<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PemilikPostingan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentuser = Auth::user();
        $post = Post::findOrFail($request->id);

        if($post->author != $currentuser->id){
            return response()->json(['message'=> 'Data tidak ditemukan'], 404);
        }

        //return response()->json($currentuser->id);
        return $next($request);
    }
}
