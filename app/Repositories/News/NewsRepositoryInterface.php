<?php

namespace App\Repositories\News;

use App\Repositories\RepositoryInterface;

interface NewsRepositoryInterface extends RepositoryInterface
{
    public function getAllWithPaginate();

    public function searchByKeyWord($keyWord);

    public function getHotNews();

    public function getLatestNews();

    public function searchByKeyWordWithStatus($keyWord, $status = []);

    public function getAllForReview();

    public function getAllOfWriter();

    public function searchNewsOfUser($keyWord, $userId);

    public function getAllOfCurrentWeek();

    public function getAllNewsOfMonth($month, $year);
}
