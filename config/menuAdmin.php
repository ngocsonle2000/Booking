<?php
return [
    [
        'lable' => 'Dashboard',
        'route' => 'Dasboard.index',
        'icon' => ' fas fa-tachometer-alt',
    ],

    //Account
    // [
    //     'lable' => 'Quản lý tài khoản',
    //     'route' => 'admin.Account.index',
    //     'icon' => 'fa-user',
    //     'items' => [
    //         [
    //             'label' => 'Tất cả tài khoản',
    //             'route' => 'admin.Account.index',
    //         ],
    //         [
    //             'label' => 'Thêm tài khoản admin',
    //             'route' => 'admin.Account.create',
    //         ],
    //         [
    //             'label' => 'Đặt tên quyền',
    //             'route' => 'admin.Permission.create',
    //         ]
    //     ]
    // ],
    [
        'lable' => 'Quản lý blog',
        'route' => 'admin.blog.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'Tất cả bài viết',
                'route' => 'admin.blog.index',
            ],
            [
                'label' => 'Thêm bài viết',
                'route' => 'admin.blog.create',
            ],
        ]
    ],
    [
        'lable' => 'Quản lý banner',
        'route' => 'admin.banner.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'Tất cả banner',
                'route' => 'admin.banner.index',
            ],
            [
                'label' => 'Thêm banner',
                'route' => 'admin.banner.create',
            ],
        ]
    ],
    [
        'lable' => 'Quản lý chỗ ở',
        'route' => 'admin.accommodation.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'Tất cả loại chỗ ở',
                'route' => 'admin.accommodation.index',
            ],
            [
                'label' => 'Thêm loại chỗ ở',
                'route' => 'admin.accommodation.create',
            ],
        ]
    ],
    [
        'lable' => 'Quản lý thành phố',
        'route' => 'admin.city.index',
        'icon' => 'fa-user',
        'items' => [
            [
                'label' => 'Tất cả thành phố',
                'route' => 'admin.city.index',
            ],
            [
                'label' => 'Thêm thành phố',
                'route' => 'admin.city.create',
            ],
        ]
    ],
]
?>
