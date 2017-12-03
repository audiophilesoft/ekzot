<?php
/**
 * Created by PhpStorm.
 * User: Audi
 * Date: 20.11.2017
 * Time: 14:48
 */


namespace App\Http\Middleware;

use App\Exceptions\FloodDetectedException;
use Illuminate\Http\Request;

class Antispam
{
    protected $comments_check_date;
    protected $comments_max_for_period;


    public function __construct()
    {
        $this->comments_check_date = self::calcDate();
        $this->comments_max_for_period = config('site.comments.max_for_period');
    }


    public function handle(Request $request, \Closure $next, string $type)
    {
        $this->$type();

        return $next($request);
    }


    protected function comment(): void
    {
        $user = \Auth::user();
        if($user->isAdmin())
        {
            return;
        }

        $count = $user->comments->where('created_at', '>', $this->comments_check_date)->count();

        // todo: check if there were was the same comment added before

        if ($count >= $this->comments_max_for_period) {
            // todo: move string from here
           throw new FloodDetectedException('Нельзя добавлять комментарии так часто.', 403);
        }
    }


    protected static function calcDate(): \DateTime
    {
        $interval = new \DateInterval('PT' . config('site.comments.check_period') . 'M');
        return (new \DateTime())->sub($interval);
    }
}