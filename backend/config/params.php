<?php
return [
    'adminEmail' => 'admin@example.com',

    'adminMenus' => [
        'goods' => [
            'label' => '商品中心',
            'url' => ['goods/goods/index'],
            'items' => [
                [
                    'label' => '商品管理',
                    'items' => [
                        ['label' => '商品管理', 'url' => 'goods/goods'],
                    ],
                ],
                [
                    'label' => '商品配置',
                    'items' => [
                        ['label' => '分类管理', 'url' => 'goods/category'],
                        ['label' => '属性管理', 'url' => 'goods/attribute'],
                        ['label' => '规格管理', 'url' => 'goods/specifications'],
                        ['label' => '品牌管理', 'url' => 'goods/brand'],
//                        ['label' => '类型管理', 'url' => 'goods/type'],
                    ],
                ],
            ],
        ],

        'order' => [
            'label' => '订单中心',
            'url' => ['order/order/index'],
            'items' => [
                [
                    'label' => '订单管理',
                    'items' => [
                        ['label' => '订单概况', 'url' => 'order/order/index'],
                        ['label' => '订单列表', 'url' => 'order/order/list'],
                    ],
                ],
                [
                    'label' => '单据管理',
                    'items' => [
                        ['label' => '收款单', 'url' => 'order/order/index'],
                        ['label' => '发货单', 'url' => 'order/site/index'],
                    ],
                ],
                [
                    'label' => '快递配置',
                    'items' => [
                        ['label' => '快递单模板', 'url' => 'order/order/index'],
                        ['label' => '发货点管理', 'url' => 'order/order/index'],
                    ],
                ],
            ],
        ],

        'member' => [
            'label' => '会员中心',
            'url' => ['member/member/index'],
            'items' => [
                [
                    'label' => '会员管理',
                    'items' => [
                        ['label' => '会员列表', 'url' => 'member/member/index'],
                        ['label' => '会员等级', 'url' => 'member/grade/index'],
                        ['label' => '创建会员', 'url' => 'member/member/create'],
                    ],
                ],
                [
                    'label' => '会员资金',
                    'items' => [
                        ['label' => '资金管理', 'url' => 'member/fund/index'],
                        ['label' => '积分管理', 'url' => 'member/member/index'],
                        ['label' => '积分日志', 'url' => 'member/member/index'],
                    ],
                ],
                [
                    'label' => '信息管理',
                    'items' => [
                        ['label' => '字段管理', 'url' => 'member/field/index'],
                        ['label' => '商品评价', 'url' => 'member/member/index'],
                        ['label' => '通知中心', 'url' => 'member/member/index'],
                    ],
                ],
            ],
        ],

        'marketing' => [
            'label' => '营销推广',
            'url' => ['marketing/site/index4'],
            'items' => [
                [
                    'label' => '促销活动',
                    'items' => [
                        ['label' => '商品促销', 'url' => 'marketing/goods/index'],
                        ['label' => '订单促销', 'url' => 'marketing/order/index'],
                        ['label' => '团购', 'url' => 'marketing/goods/index'],
                        ['label' => '秒杀', 'url' => 'marketing/goods/index'],
                    ],
                ],
                [
                    'label' => '折扣管理',
                    'items' => [
                        ['label' => '折扣券模板', 'url' => 'marketing/coupon-theme/index'],
                        ['label' => '折扣券管理', 'url' => 'marketing/coupon/index'],
                        ['label' => '代金券模板', 'url' => 'marketing/coupon-theme/index'],
                        ['label' => '代金券管理', 'url' => 'marketing/coupon/index'],
                    ],
                ],
            ],
        ],

        'statistics' => [
            'label' => '统计中心',
            'url' => ['statistics/site/index5'],
            'items' => [
                [
                    'label' => '销售统计',
                    'items' => [
                        ['label' => '订单概况', 'url' => 'statistics/order/index'],
                        ['label' => '订单统计', 'url' => 'statistics/order/index'],
                        ['label' => '订单报表', 'url' => 'statistics/order/index'],
                    ],
                ],
                [
                    'label' => '客户统计',
                    'items' => [
                        ['label' => '会员概况', 'url' => 'statistics/member/index'],
                        ['label' => '会员排行', 'url' => 'statistics/member/index'],
                        ['label' => '会员分布统计', 'url' => 'statistics/member/index'],
                    ],
                ],
            ],
        ],

        'content' => [
            'label' => '内容管理',
            'url' => ['content/site/index6'],
            'items' => [
                [
                    'label' => '文章管理',
                    'items' => [
                        ['label' => '文章列表', 'url' => 'content/article/index'],
                        ['label' => '文章分类', 'url' => 'content/category/index'],
                    ],
                ],
                [
                    'label' => '内容管理',
                    'items' => [
                        ['label' => '广告管理', 'url' => 'content/advertisement/index'],
                        ['label' => '标签管理', 'url' => 'content/label/index'],
                        ['label' => '导航管理', 'url' => 'content/navigation/index'],
                    ],
                ],
            ],
        ],

        'system' => [
            'label' => '系统设置',
            'url' => ['system/index'],
            'items' => [
                [
                    'label' => '参数设置',
                    'items' => [
                        ['label' => '系统信息', 'url' => 'system/index'],
                        ['label' => '在线升级', 'url' => 'system/version'],
                        ['label' => '主题设置', 'url' => 'system/theme'],
                        ['label' => '站点设置', 'url' => 'system/system'],
                        ['label' => '信息模板', 'url' => 'system/info/index'],
                        ['label' => '开放登录', 'url' => 'system/oauth/index'],
                    ],
                ],
                [
                    'label' => '支付配送设置',
                    'items' => [
                        ['label' => '支付方式', 'url' => 'system/pay'],
                        ['label' => '区域划分', 'url' => 'system/region'],
                        ['label' => '地区管理', 'url' => 'system/area'],
                        ['label' => '运费模板', 'url' => 'system/freight'],
                        ['label' => '快递公司', 'url' => 'system/express-company'],
                    ],
                ],
                [
                    'label' => '权限管理',
                    'items' => [
                        ['label' => '角色列表', 'url' => 'system/role/index'],
                        ['label' => '菜单列表', 'url' => 'system/menu/index'],
                        ['label' => '权限列表', 'url' => 'system/permission/index'],
                    ],
                ],
                [
                    'label' => '数据管理',
                    'items' => [
                        ['label' => '操作日志', 'url' => 'system/operation'],
                        ['label' => '缓存管理', 'url' => 'system/cache'],
                        ['label' => '数据库管理', 'url' => 'system/database'],
                    ],
                ],
            ],
        ],
    ],

];
