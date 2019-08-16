<?php
/**
*
*/

namespace Mf\GallerySimple;

return [




    /*плагины для сетки JqGrid*/
    "JqGridPlugin"=>[
        'factories' => [
            Service\Admin\JqGrid\Plugin\Gallerys::class=>Service\Admin\JqGrid\Plugin\FactoryGallerys::class,
        ],
        'aliases' =>[
            "Gallerys"=>Service\Admin\JqGrid\Plugin\Gallerys::class,
        ],
    ],
    /*описатели интерфейсов*/
    "interface"=>[
        "gallerys_category"=>__DIR__."/admin.category.php",
        "gallerys_items"=>__DIR__."/admin.gallerys_items.php",
    ]

];
