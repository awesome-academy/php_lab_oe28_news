<?php

namespace Tests\Unit\Http\Models;

use App\Http\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class CommentTest extends TestCase
{
    protected $comment;
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->comment = new Comment();
    }

    public function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        unset($this->comment);
    }

    public function test_table()
    {
        $this->assertEquals('comments', $this->comment->getTable());
    }

    public function test_fillable()
    {
        $this->assertEquals([
            'content',
            'user_id',
            'news_id',
            'parent_id',
        ], $this->comment->getFillable());
    }

    public function test_belongsTo_relation()
    {
        $relation = $this->comment->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
    }

    public function test_hasMany_realtion()
    {
        $relation = $this->comment->children();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }
}
