<?php

namespace Tests\Unit\Http\Models;

use App\Http\Models\News;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class NewsTest extends TestCase
{
    protected $news;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->news = new News();
    }

    public function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        unset($this->news);
    }

    public function test_fillable()
    {
        $this->assertEquals([
            'title',
            'description',
            'content',
            'hot',
            'category_id',
            'user_id',
            'status',
            'image',
            'slug',
        ], $this->news->getFillable());
    }

    public function test_table()
    {
        $this->assertEquals('news', $this->news->getTable());
    }

    public function test_relation()
    {
        $relationComments = $this->news->comments();
        $relationLikes = $this->news->likes();
        $relationCategory = $this->news->category();

        $this->assertInstanceOf(HasMany::class, $relationComments);
        $this->assertEquals('news_id', $relationComments->getForeignKeyName());

        $this->assertInstanceOf(BelongsToMany::class, $relationLikes);
        $this->assertEquals('user_id', $relationLikes->getRelatedPivotKeyName());
        $this->assertEquals('news_id', $relationLikes->getForeignPivotKeyName());

        $this->assertInstanceOf(BelongsTo::class, $relationCategory);
        $this->assertEquals('category_id', $relationCategory->getForeignKeyName());
    }
}
