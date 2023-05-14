<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->user() != null) {
            $borrowed = \App\Models\IssuedBooks::where('student_matric_number', auth()->user()->matric_no)
                        ->where('borrowed',true)
                        ->where('return_date', '<', date('Y-m-d h:s:ia', time()))
                        ->get();

            if($borrowed->count() > 0) {

                $userExpiration = auth()->user()->banUntil('5 days')->expired_at->format('Y-m-d H:s:i');
                $userBan = auth()->user()->ban();
                
                if(time() < strtotime($userExpiration) && $userBan->bannable_id == auth()->user()->id) {

                    Auth::guard('student')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('/login')->withErrors(['matric_no' => "You've been temporarily suspended from using the library"])->withInput();

                } elseif(time() >= strtotime($userExpiration)) {

                    $book = \App\Models\Book::find($borrowed[0]->book_id);
                    $book->borrowed = false;
                    $book->save();

                    $borrowed[0]->borrowed = false;
                    $borrowed[0]->return_date = now();
                    $borrowed[0]->save();

                    auth()->user()->unban();

                    return $next($request); 
                
                }
            }
        } else {
           return $next($request); 
        }

        return $next($request);
    }
}
