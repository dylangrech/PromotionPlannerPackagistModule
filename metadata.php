<?php
/**
 * This file is part of OXID eSales GDPR opt-in module.
 *
 * OXID eSales GDPR opt-in module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales GDPR opt-in module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales GDPR opt-in module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2018
 */

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
        'fc_article_promotion' => \pp\PromotionPlanner\Controller\Admin\ArticlePromotionController::class,
        'fc_category_promotion' => \pp\PromotionPlanner\Controller\Admin\CategoryPromotionController::class,
        'fc_manufacturer_promotion' => \pp\PromotionPlanner\Controller\Admin\ManufacturerPromotionController::class,
    ],
    'templates'   => [
        'fc_article_promotion.tpl'      => 'pp/PromotionPlanner/views/admin/tpl/fc_article_promotion.tpl',
        'fc_category_promotion.tpl'      => 'pp/PromotionPlanner/views/admin/tpl/fc_category_promotion.tpl',
        'fc_manufacturer_promotion.tpl'      => 'pp/PromotionPlanner/views/admin/tpl/fc_manufacturer_promotion.tpl',
    ],
    'extend'      => [
        \OxidEsales\Eshop\Application\Model\Article::class => \pp\PromotionPlanner\Model\Article::class,
        \OxidEsales\Eshop\Core\UtilsFile::class => \pp\PromotionPlanner\Core\UtilsFile::class,
        \OxidEsales\Eshop\Application\Model\Manufacturer::class => \pp\PromotionPlanner\Model\Manufacturer::class,
        \OxidEsales\Eshop\Application\Model\Category::class => \pp\PromotionPlanner\Model\Category::class,
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
        'onActivate'   => '\pp\PromotionPlanner\Core\Setup\Events::onActivate'
    ],
    'settings'    => [],
];
