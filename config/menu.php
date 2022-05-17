<?php
return [
    [
        'lable' => 'Dashboard',
        'route' => 'Dasboard.index',
        'icon' => ' fas fa-tachometer-alt',
    ],

    [
        'lable' => 'Quản Lý Phòng',
        'route' => 'KindRoom.index',
        'icon' => 'fa-home',
        'items' => [
            [
                'label' => 'Tất Cả Loại Phòng',
                'route' => 'KindRoom.index',
            ],
            [
                'label' => 'Thêm Loại Phòng',
                'route' => 'KindRoom.create',
            ]
        ]
    ],

    [
        'lable' => 'Khách Sạn',
        'route' => 'Hotel.index',
        'icon' => 'fa-list',
        'items' => [
            [
                'label' => 'Tất Cả Chi Nhanh',
                'route' => 'Hotel.index',
            ],
            [
                'label' => 'Thêm Chi Nhánh',
                'route' => 'Hotel.create',
            ]
        ]
    ],

    [
        'lable' => 'Quản Lý Đặt Phòng',
        'route' => 'Booking.index',
        'icon' => 'fa fa-users',

    ],

    [
        'lable' => 'Mã Giảm Gía',
        'route' => 'Promo.index',
        'icon' => 'fa fa-gift',
        'items' => [
            [
                'label' => 'Tất cả mã giảm giá',
                'route' => 'Promo.index',
            ],
            [
                'label' => 'Thêm mã giảm giá',
                'route' => 'Promo.create',
            ]
        ]
    ],

    [
        'lable' => 'Các Bài Viết',
        'route' => 'Post.index',
        'icon' => 'fa fa-newspaper-o',
        'items' => [
            [
                'label' => 'Tất cả bài viết',
                'route' => 'Post.index',
            ],
            [
                'label' => 'Thêm vài viết',
                'route' => 'Post.create',
            ]
        ]
    ],

    [
        'lable' => 'Đánh Giá',
        'route' => 'Comment.index',
        'icon' => 'fa fa-comments-o',
        // 'items' => [
        //     [
        //         'label' => 'Tất cả bài viết',
        //         'route' => 'Post.index',
        //     ],
        //     [
        //         'label' => 'Thêm vài viết',
        //         'route' => 'Post.create',
        //     ]
        // ]
    ],
]
?>
