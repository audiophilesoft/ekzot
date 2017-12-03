<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Comment;
use App\Commentable;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Commentable $commentable)
    {

        $user = \Auth::user();

        $this->validate($request, static::getChecks(), static::getMessages());

        $comment = $commentable->addComment($request->all(), $user);

        // todo: trigger event for emailing admin

        $comment->number = \count($commentable->comments);

        if ($request->ajax()) {
            return view('comments.comment', compact('comment'));
        }

        return back();
    }


    public function edit(Comment $comment)
    {
        return view('comments.edit_form', compact('comment'));
    }


    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, static::getChecks(), static::getMessages());

        $comment->text = $request->input('text');
        $comment->save();

        if ($request->ajax()) {
            return view('comments.comment', compact('comment'));
        }

        return back();
    }


    public function delete(Request $request, Comment $comment)
    {
        $comment->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        return back();
    }


    public function like(Request $request, Comment $comment)
    {
        $comment->addLike(\Auth::user());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'likes' => \count($comment->likes()),
            ]);
        }

        return back();
    }


    protected static function getChecks(bool $update_mode = false): array
    {
        return [
            'text' => 'required|min:2|max:4096',
            'reply_to' => 'exists:comments,id'
        ];
    }


    protected static function getMessages(bool $update_mode = false): array
    {
        return [
            'text.required' => 'Вы не ввели текст комментария.',
            'text.min' => 'Минимальная длина текста комментария — '.config('site.comments.min_size').' символов',
            'text.max' => 'Максимальная длина текста комментария — '.config('site.comments.max_size').' символов',
        ];
    }

}
