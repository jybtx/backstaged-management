<?php

namespace Jybtx\Backstaged\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Jybtx\Backstaged\Services\SiderBarService;

class menuSideBarViewComposer
{
    protected $sidebar;
    /**
     * 创建一个新的属性composer.
     *
     * @param UserRepository $menus
     * @return void
     */
    public function __construct(SiderBarService $sidebar)
    {
        $this->sidebar = $sidebar;
    }
    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sidebarMenu', $this->sidebar->getPermission());
    }
}