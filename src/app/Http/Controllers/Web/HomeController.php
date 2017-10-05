<?php

namespace Acme\Http\Controllers\Web;

use Acme\Domain\Contract\ClientRepository;
use Acme\Domain\Contract\ProjectRepository;
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
    private $projectRepository;

    /**
     * @param \Acme\Domain\Contract\ProjectRepository $projectRepository
     */
    public function __construct(ClientRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Loggable
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $this->projectRepository->findAll();

        return \view('web::pages.home.index');
    }
}
