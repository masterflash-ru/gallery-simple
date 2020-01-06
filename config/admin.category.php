<?php
namespace Mf\GallerySimple;

use Admin\Service\JqGrid\ColModelHelper;
use Admin\Service\JqGrid\NavGridHelper;
use Laminas\Json\Expr;



return [
        /*jqgrid - сетка*/
        "type" => "ijqgrid",
        "description"=>"Разделы простых фотогалерей",
        "options" => [
            "container" => "gallerys",
            "caption" => "",
            "podval" => "",
            
            
            /*все что касается чтения в таблицу*/
            "read"=>[
                "db"=>[//плагин выборки из базы
                    "sql"=>"select id as img, gallerys.* from gallerys",
                    "PrimaryKey"=>"id",
                ],
            ],
            /*редактирование*/
            "edit"=>[
                "cache" =>[
                    "tags"=>["gallerys","gallerys_items"],
                    "keys"=>["gallerys","gallerys_items"],
                ],
                "db"=>[ 
                    "sql"=>"select * from gallerys",
                    "PrimaryKey"=>"id",
                ],
            ],
            "add"=>[
                "db"=>[ 
                    "sql"=>"select * from gallerys",
                    "PrimaryKey"=>"id",
                ],
            ],
            //удаление записи
            "del"=>[
                "cache" =>[
                    "tags"=>["gallerys","gallerys_items"],
                    "keys"=>["gallerys","gallerys_items"],
                ],
                "Gallerys"=>[], //удаление слайдов в разделе
                "db"=>[ 
                    "sql"=>"select * from gallerys",
                    "PrimaryKey"=>"id",
                ],
            ],
            /*внешний вид*/
            "layout"=>[
                "caption" => "Разделы простых фотогалерей",
                "height" => "auto",
                "width" => 1000,
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
                    "editOptions"=>NavGridHelper::editOptions(["closeAfterEdit"=>false]),
                    "addOptions"=>NavGridHelper::addOptions(),
                    "delOptions"=>NavGridHelper::delOptions(),
                ],
                "colModel" => [
                    ColModelHelper::text("poz",["label"=>"Порядок"]),
                    ColModelHelper::text("name",["label"=>"Имя","editoptions" => ["size"=>120 ]]),
                    ColModelHelper::text("sysname",["label"=>"Системное имя"]),
                    ColModelHelper::text("url",[
                        "width"=>400,
                        "hidden"=>true,
                        "label"=>"URL (автомат)",
                        "editrules"=>[
                            "edithidden"=>true,
                        ],
                        "plugins"=>[
                            "edit"=>[
                                "translit"=>[
                                    "source"=>"name"
                                ],
                            ],
                            "edit"=>[
                                "translit"=>[
                                    "source"=>"name"
                                ],
                            ],
                            "add"=>[
                                "translit"=>[
                                    "source"=>"name"
                                ],
                            ],
                        ],
                       "editoptions" => ["size"=>120 ],
                    ]),
                    
                    
                    ColModelHelper::checkbox("public",["label"=>"Публ."]),
                    ColModelHelper::select("storage",
                                           [
                                               "label"=>"Хранилище",
                                               "plugins"=>[
                                                   "colModel"=>[//плагин срабатывает при генерации сетки, вызывается в помощнике сетки
                                                       "SelectConfigStorage"=>[],
                                                   ],
                                               ],
                                           ]),
                    ColModelHelper::image("img",
                                          ["label"=>"Титульное фото",
                                           "plugins"=>[
                                               "read"=>[
                                                   "images" =>[
                                                       "image_id"=>"id",                        //имя поля с ID
                                                       "storage_item_name" => "gallerys",
                                                   ],
                                               ],
                                               "edit"=>[
                                                   "images" =>[
                                                       "storage_item_name" => "gallerys",
                                                       "image_id"=>"id",                        //имя поля с ID
                                                   ],
                                               ],
                                               "del"=>[
                                                   "images" =>[
                                                       "storage_item_name" => "gallerys",
                                                       "image_id"=>"id",                        //имя поля с ID
                                                   ],
                                               ],
                                               "add"=>[
                                                   "images" =>[
                                                       "storage_item_name" => "gallerys",
                                                       "image_id"=>"id",                        //имя поля с ID
                                                       "database_table_name"=>"gallerys"
                                                   ],
                                               ],
                                           ],
                                          ]),

                    ColModelHelper::ckeditor("info",[
                        "label"=>"Статья полностью",
                        "plugins"=>[
                            "edit"=>[
                                "ClearContent"=>[],
                            ],
                            "add"=>[
                                "ClearContent"=>[],
                            ],
                        ],
                    ]),
                    ColModelHelper::textarea("title",["label"=>"TITLE","hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::textarea("keywords",["label"=>"KEYWORDS","hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::textarea("description",["label"=>"DESCRIPTION","hidden"=>true,"editrules"=>["edithidden"=>true]]),
                    ColModelHelper::interfaces("id",
                                         [
                                             "label"=>"Галерея",
                                             "width"=>130,
                                             "formatoptions" => [
                                                 "items"=>[
                                                    "button1"=> [
                                                        "label"=>"Слайды",
                                                        "interface"=>"/adm/universal-interface/gallerys_items",
                                                        "get_parameter_name"=>"gallerys",   //ID записи передается через GET["gallerys"]
                                                        "get_parameters_array"=>["storage"],
                                                        "icon"=> "",
                                                        "dialog"=>[
                                                            "title"=>"Фото галерея для направлений",
                                                            "resizable"=>true,
                                                            "closeOnEscape"=>true,
                                                            "width"=>"680",
                                                            "position"=>[
                                                                "my"=>"left top",
                                                                "at"=>"left top",
                                                                "of"=>"#contant-container"
                                                            ],

                                                        ],
                                                     ],
                                                 ],
                                             ]
                                         ]),

                ColModelHelper::cellActions(),
                ],
            ],
        ],
];