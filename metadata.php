<?php
/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id'          => 'promotionplanner',
    'title'       => [
        'de' => 'Promotion Planner',
        'en' => 'Promotion Planner',
    ],
    'description' => [
        'de' => 'Hilft dem Benutzer, eine Werbeaktion zu planen',
        'en' => 'Lets the admin plan a promotion from a specific date till another specific date',
    ],
    'thumbnail'   => '',
    'version'     => '1.0',
    'author'      => 'Dylan Grech',
    'url'         => 'https://www.oxid-esales.com/',
    'email'       => 'dylan.grech@fatchip.de',
    'controllers' => [
        'fc_article_promotion' => \Fatchip\PromotionPlanner\Controller\Admin\ArticlePromotionController::class,
        'fc_category_promotion' => \Fatchip\PromotionPlanner\Controller\Admin\CategoryPromotionController::class,
        'fc_manufacturer_promotion' => \Fatchip\PromotionPlanner\Controller\Admin\ManufacturerPromotionController::class,
    ],
    'templates'   => [
        'fc_article_promotion.tpl'      => 'fc/promotionplanner/views/admin/tpl/fc_article_promotion.tpl',
        'fc_category_promotion.tpl'      => 'fc/promotionplanner/views/admin/tpl/fc_category_promotion.tpl',
        'fc_manufacturer_promotion.tpl'      => 'fc/promotionplanner/views/admin/tpl/fc_manufacturer_promotion.tpl',
    ],
    'extend'      => [
        \OxidEsales\Eshop\Application\Model\Article::class => \Fatchip\PromotionPlanner\Model\Article::class,
        \OxidEsales\Eshop\Core\UtilsFile::class => \Fatchip\PromotionPlanner\Core\UtilsFile::class,
        \OxidEsales\Eshop\Application\Model\Manufacturer::class => \Fatchip\PromotionPlanner\Model\Manufacturer::class,
        \OxidEsales\Eshop\Application\Model\Category::class => \Fatchip\PromotionPlanner\Model\Category::class,
    ],
    'blocks'      => [
        [
            'template' => 'layout/page.tpl',
            'block'    => 'content_main',
            'file'     => 'promotion_planner.tpl'
        ],
        [
            'template' => 'page/details/inc/productmain.tpl',
            'block' => 'details_productmain_manufacturersicon',
            'file' => 'manufacturer_promotion_planner.tpl'
        ],
        [
            'template' => 'page/list/list.tpl',
            'block' => 'page_list_listhead',
            'file' => 'category_promotion_planner.tpl'
        ],
    ],
    'events'       => [
        'onActivate'   => '\Fatchip\PromotionPlanner\Core\Setup\Events::onActivate'
    ],
    'settings'    => [],
];
