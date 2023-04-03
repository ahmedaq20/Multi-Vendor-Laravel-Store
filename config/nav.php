<?php


return [

    [
         'title' => 'dashboard',
         'icone'=>'nav-icon fas fa-th',
         'route'=>'dashboard.dashboard',
         'active' =>'dashboard.dashboard',

    ],

    [
         'title' => 'Categories',
         'icone'=>'far fa-circle nav-icon',
         'route'=>'dashboard.Categories.index',
         'badge'=>'New',
         'active' =>'dashboard.Categories.*',

    ],
    [
        'title' => 'Products',
        'icone'=>'nav-icon fas fa-th',
        'route'=>'dashboard.Products.index',
        'active' =>'dashboard.Products.*',

   ],
   [
    'title' => 'Order',
    'icone'=>'nav-icon fas fa-tachometer-alt',
    'route'=>'dashboard.dashboard',
    'active' =>'dashboard.order.*',

],




];
