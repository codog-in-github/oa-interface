<?php
namespace Oa\Controller;

use Oa\Controller\AuthController;
use Oa\Model\TableConfigModel;
use Oa\Model\TableConfigDetailModel;

class ConfigController extends AuthController
{
    public function initConfig(){
        $tableConf = new TableConfigModel();
        
        $this->ajaxSuccess($tableConf->getAll('bkg'));
    }
    
    public function traderConfig(){
        $tableConf = new TableConfigModel();
        
        $this->ajaxSuccess($tableConf->getAll('trader'));
    }

    
}
