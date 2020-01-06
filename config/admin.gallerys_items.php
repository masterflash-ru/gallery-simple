<?php
namespace Mf\GallerySimple;

use Admin\Service\JqGrid\ColModelHelper;
use Admin\Service\JqGrid\NavGridHelper;
use Laminas\Json\Expr;

if (empty($_GET["storage"])){
    $_GET["storage"]=0;
}

return [
        /*jqgrid - сетка*/
        "type" => "ijqgrid",
        //"description"=>"Разделы простых фотогалерей",
        "options" => [
            "container" => "gallerys_items",
            "caption" => "",
            "podval" => "",
            
            
            /*все что касается чтения в таблицу*/
            "read"=>[
                "db"=>[//плагин выборки из базы
                    "sql"=>"select id as img, gallerys_items.* from gallerys_items where gallerys=:gallerys",
                    "PrimaryKey"=>"id",
                ],
            ],
            /*редактирование*/
            "edit"=>[
                "cache" =>[
                    "tags"=>["gallerys_items"],
                    "keys"=>["gallerys_items"],
                ],
                "db"=>[ 
                    "sql"=>"select * from gallerys_items",
                    "PrimaryKey"=>"id",
                ],
            ],
            "add"=>[
                "db"=>[ 
                    "sql"=>"select * from gallerys_items",
                    "PrimaryKey"=>"id",
                ],
            ],
            //удаление записи
            "del"=>[
                "cache" =>[
                    "tags"=>["gallerys_items"],
                    "keys"=>["gallerys_items"],
                ],
                "db"=>[ 
                    "sql"=>"select * from gallerys_items",
                    "PrimaryKey"=>"id",
                ],
            ],
            /*внешний вид*/
            "layout"=>[
                "caption" => "Собственно фотогалерея",
                "height" => "auto",
                "width" => "auto",
                "rowNum" => 10,
                "rowList" => [20,50,100],
                "sortname" => "poz",
                "sortorder" => "asc",
                "viewrecords" => true,
                "autoencode" => false,
                "hidegrid" => false,
                //"toppager" => true,
                
                /*дает доп строку в конце сетки, из данных туда можно ставить итоги какие-либо*/
                //"footerrow"=> true, 
                //"userDataOnFooter"=> true,
               
                // "multiselect" => true,
                //"onSelectRow"=> new Expr("editRow"), //клик на строке вызов строчного редактора
        
                
                "rownumbers" => false,
                "navgrid" => [
                    "button" => NavGridHelper::Button(["search"=>false]),
                    "editOptions"=>NavGridHelper::editOptions(["closeAfterEdit"=>true]),
                    "addOptions"=>NavGridHelper::addOptions(),
                    "delOptions"=>NavGridHelper::delOptions(),
                ],
                "colModel" => [
                    ColModelHelper::text("poz",["label"=>"Порядок"]),
                    ColModelHelper::text("alt",["label"=>"Подпись фото","editoptions" => ["size"=>100 ],"hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::image("img",
                                          ["label"=>"Слайд",
                                           "plugins"=>[
                                               "read"=>[
                                                   "images" =>[
                                                       "image_id"=>"id",                        //имя поля с ID
                                                       "storage_item_name" => $_GET["storage"],
                                                   ],
                                               ],
                                               "edit"=>[
                                                   "images" =>[
                                                       "storage_item_name" =>$_GET["storage"],
                                                       "image_id"=>"id",                        //имя поля с ID
                                                   ],
                                               ],
                                               "del"=>[
                                                   "images" =>[
                                                       "storage_item_name" => $_GET["storage"],
                                                       "image_id"=>"id",                        //имя поля с ID
                                                   ],
                                               ],
                                               "add"=>[
                                                   "images" =>[
                                                       "storage_item_name" => $_GET["storage"],
                                                       "image_id"=>"id",                        //имя поля с ID
                                                       "database_table_name"=>"gallerys_items",
                                                   ],
                                               ],
                                           ],
                                          ]),

                ColModelHelper::cellActions("my",["formatoptions"=>["editformbutton"=>false]]),
                ],
            ],
        ],
];