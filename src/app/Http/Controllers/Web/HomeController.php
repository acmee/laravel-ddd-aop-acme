<?php

namespace Acme\Http\Controllers\Web;

use Acme\Infrastructure\Aspects\Annotations\Loggable;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

/**
 * Class HomeController
 *
 * @package Acme\Http\Controllers
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/13
 */
class HomeController extends Controller
{
    /**
     * @Loggable
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return \view('web::pages.home.index');
    }
}
