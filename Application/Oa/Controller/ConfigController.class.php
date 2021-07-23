<?php
namespace Oa\Controller;

use Oa\Controller\AuthController;
use Oa\Model\TableConfigModel;
use Oa\Model\TableConfigDetailModel;
use Oa\Model\SelectModel;
use Oa\Model\CountryModel;

class ConfigController extends AuthController
{
    public function configVersion(){
        
        $this->ajaxSuccess(C('CONFIG_VERSION'));
    }

    public function initConfig(){
        $tableConf = new TableConfigModel();
        
        $this->ajaxSuccess($tableConf->getAll('bkg'));
    }
    public function getOptions(){
        $id = $_GET['sid'];
        $pid = $_GET['pid'];
        if(!$id){
            $this->ajaxError(4,'no id');
            exit;
        }
        $select = new SelectModel();
        $this->ajaxSuccess($select->getOption($id,$pid));
    }
}
