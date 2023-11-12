<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testCreateComment()
    {
        $comment = new Comment();
        $comment->email = "sample@gmail.com";
        $comment->title = "Sample Title";
        $comment->comment = "Sample Comment";

        $comment->save();

        $this->assertNotNull($comment->id);
    }

    public function testDefaultAttributeValues()
    {
        $comment = new Comment();
        $comment->email = "sample@gmail.com";

        $comment->save();

        $this->assertNotNull($comment->id);
        $this->assertNotNull($comment->title);
        $this->assertNotNull($comment->comment);
    }
}
