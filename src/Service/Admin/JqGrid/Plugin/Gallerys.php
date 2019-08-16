<?php


namespace Mf\GallerySimple\Service\Admin\JqGrid\Plugin;

use Admin\Service\JqGrid\Plugin\AbstractPlugin;


class Gallerys extends AbstractPlugin
{
    protected $connection;
    
    public function __construct($connection)
    {
        $this->connection=$connection;
    }

/**
* удаление в контексте интерфейса
*/
    public function idel(array $postParameters)
    {
        //обновить записи в хранилище на удаление
        $id=(int)$postParameters["id"];
        $this->connection->Execute("update storage set todelete=1 where razdel in(select storage from gallerys where id=$id)");

    }

}