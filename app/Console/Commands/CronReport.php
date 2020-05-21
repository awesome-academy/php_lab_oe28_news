<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Mail\ReportMail;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CronReport extends Command
{
    protected $newsRepo;

    protected $userRepo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report to admin';

    /**
     * Create a new command instance.
     *
     * @param NewsRepositoryInterface $newsRepo
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(
        NewsRepositoryInterface $newsRepo,
        UserRepositoryInterface $userRepo
    ) {
        parent::__construct();
        $this->newsRepo = $newsRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $listNews = $this->newsRepo->getAllOfCurrentWeek();
        $listAdmin = $this->userRepo->findByAttributes(['role_id' => UserRole::Admin]);
        Mail::to($listAdmin)->send(new ReportMail($listNews));
    }
}
