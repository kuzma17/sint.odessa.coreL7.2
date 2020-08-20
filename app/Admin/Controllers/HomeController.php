<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('Description...');

            $content->row(function ($row) {
                $row->column(3, new InfoBox('Новых клиентов', 'users', 'aqua', '/admin/users', \App\Http\Controllers\UserProfileController::count_users()));
                $row->column(3, new InfoBox('Новых заказов', 'shopping-cart', 'green', '/admin/orders',  \App\Http\Controllers\OrderController::count_new_orders()));
                $row->column(3, new InfoBox('Всего клиентов', 'users', 'yellow', '/admin/users', \App\User::count() ));
                $row->column(3, new InfoBox('Всего заказов', 'shopping-cart', 'red', '/admin/orders', \App\Order::count()));
            });

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {

                    $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(30));
                    $arr_ = json_decode($analyticsData);
                    $arr_date = [];
                    $arr_visitors = [];
                    $arr_views = [];

                    foreach ($arr_ as $data){
                        $arr_date[] = Carbon::parse($data->date)->format('m.d');
                        $arr_visitors[] = $data->visitors;
                        $arr_views[] = $data->pageViews;
                    }
                    $arr = [
                        'labelArray' => json_encode( $arr_date, JSON_UNESCAPED_UNICODE),
                        'dataArray' => json_encode( $arr_visitors, JSON_UNESCAPED_UNICODE),
                        'data1Array' => json_encode( $arr_views, JSON_UNESCAPED_UNICODE),
                    ];
                    $chart = view('admin.charts.line', ['data' => $arr]);

                    $column->append((new Box('Визиты за последние 30 дней', $chart))->removable()->collapsable()->style('danger'));

                });

                $row->column(6, function (Column $column) {

                    $analyticsData = Analytics::fetchTopReferrers(Period::days(30), 50);
                    //dd($analyticsData);
                    $arr_ = json_decode($analyticsData);
                    $arr_url = [];
                    $arr_views = [];
                    $_2gis_views = 0;

                    foreach ($arr_ as $data){
                        if($data->url == '(direct)'){
                            continue;
                        }
                        if(strpos($data->url, '2gis.ru')){
                            $_2gis_views += $data->pageViews;
                            continue;
                        }
                        if(strpos($data->url, '/')){
                            $url = explode('/', $data->url);
                            $arr_url[] = $url[0];
                            $arr_views[] = $data->pageViews;
                            continue;
                        }
                        $arr_url[] = $data->url;
                        $arr_views[] = $data->pageViews;
                    }
                    $arr_url[] = '2gis.ru';
                    $arr_views[] = $_2gis_views;
                    $arr = [
                        'labelArray' => json_encode( $arr_url, JSON_UNESCAPED_UNICODE),
                        'dataArray' => json_encode( $arr_views, JSON_UNESCAPED_UNICODE),
                    ];
                    $chart = view('admin.charts.pie', ['data' => $arr]);

                    $column->append((new Box('Refer', $chart))->removable()->collapsable()->style('danger'));

                });

            });

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column){
                    $analyticsData = Analytics::fetchMostVisitedPages(Period::days(30), 5);

                    $arr_ = json_decode($analyticsData);
                    $arr_url = [];
                    $arr_views = [];

                    foreach ($arr_ as $data){
                        $arr_url[] = $data->url;
                        $arr_views[] = $data->pageViews;
                    }
                    $arr = [
                        'labelArray' => json_encode( $arr_url, JSON_UNESCAPED_UNICODE),
                        'dataArray' => json_encode( $arr_views, JSON_UNESCAPED_UNICODE),
                    ];

                    $chart = view('admin.charts.bar', ['data' => $arr]);

                    $column->append((new Box('Наиболее посещаемые страницы', $chart))->removable()->collapsable()->style('info'));
                });

                $row->column(6, function (Column $column){
                    $arr = \App\Http\Controllers\OrderController::count_day_orders(10);

                    $chart = view('admin.charts.bar', ['data' => $arr]);

                    $column->append((new Box('Заказы за 30 дней', $chart))->removable()->collapsable()->style('info'));
                });

            });

            $content->row(Dashboard::title());

            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
        });
    }
}
