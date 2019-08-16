# gallery-simple  простейшая фотогалерея 

старт работ





В конфиге вашего приложения должны быть указаны правила обработки и записи в хранилище файлов, например:
```php
    "storage"=>[
        'data_folder'=>"data/datastorage",
        'file_storage'=>[
            'default'=>[
                'base_url'=>"media/pics/",
            ],
        ],

        'items'=>[


            "gallerys"=>[
                "description"=>"Анонсы фотогалерей",
                'file_storage'=>'default',
                'file_rules'=>[
                            'admin_img'=>[
                                'filters'=>[
                                        CopyToStorage::class => [
                                                    'folder_level'=>0,
                                                    'folder_name_size'=>3,
                                                    'strategy_new_name'=>'md5'
                                        ],
                                        ImgResize::class=>[
                                                    "method"=>2,
                                                    "width"=>250,
                                                    "height"=>150,
                                                    'adapter'=>ImgAdapter::class,
                                        ],
    
                                ],
                            ],
                            'img'=>[
                                'filters'=>[
                                        CopyToStorage::class => [
                                                    'folder_level'=>0,
                                                    'folder_name_size'=>3,
                                                    'strategy_new_name'=>'md5'
                                        ],
                                        ImgResize::class=>[
                                                    "method"=>1,
                                                    "width"=>222,
                                                    "height"=>166,
                                                    'adapter'=>ImgAdapter::class,
                                        ],
                                ],
                            ],
                ],
            ],//gallerys

        ],
    ],
```