<?php

namespace App\Providers;

use App\Http\Controllers\Comment;
use App\Models\accommodation;
use App\Models\Accommodation as ModelsAccommodation;
use App\Models\accommodations;
use App\Models\banner;
use App\Models\city;
use App\Models\CommentBlog;
use App\Models\Hotel;
use App\Models\KindRoom;
use App\Models\permission;
use App\Models\Room;
use App\Models\TienNghi;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*',  function($view){
            $view->with([
                'data_KindRoomAll'  => KindRoom::all(),
                'data_TienNghi'     => TienNghi::all(),
                'data_Hotel'        => Hotel::all(),
                'banner'            => banner::all(),
                'citys'             => city::all(),
                'accommodations'    => Accommodation::all(),
                'commentBlog'       => CommentBlog::all(),
            ]);
        });
    }
}
