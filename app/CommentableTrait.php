<?php
declare(strict_types=1);

namespace App;


use App\Events\CommentAdded;

trait CommentableTrait
{

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function getCommentsSorted(): array
    {
        $comments = $this->comments()->orderBy('id')->get()->all();
        $comments_sorted = [];

        foreach ($comments as $n => $comment) { // Use ids as keys
            $comment->number = $n + 1; // todo: implement number somewhere else
            $comments_sorted[$comment->id] = $comment;
        }

        foreach ($comments_sorted as $key => $comment) { // Set replies
            if ($comment->reply_to !== null && isset($comments_sorted[$comment->reply_to])) {
                $comments_sorted[$comment->reply_to]->addReply($comment);
                unset($comments_sorted[$key]);
            }
        }

        /*foreach ($comments_sorted as $key => $comment) { // Remove replies from array
            if ($comment->reply_to !== null) {
                unset($comments_sorted[$key]);
            }
        }*/

        return $comments_sorted;

    }


    public function addComment(array $data, User $user): Comment
    {
        $comment = $this->comments()->create([
            'text' => $data['text'],
            'user_id' => $user->id,
            'reply_to' => $data['reply_to'] ?? null,
            'commentable_id' => $this->id,
            'commentable_type' => static::class
        ]);

        event(new CommentAdded($comment));
        return $comment;
    }

}
