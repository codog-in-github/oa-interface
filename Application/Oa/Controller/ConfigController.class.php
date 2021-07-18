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
    
    public function traderConfig(){
        $tableConf = new TableConfigModel();
        
        $this->ajaxSuccess($tableConf->getAll('trader'));
    }
    
    public function shipperConfig(){
        $tableConf = new TableConfigModel();
        $configs = [
            'shipper' => $tableConf->getAll('shipper'),
            'port_of_loading' => $tableConf->getAll('port_of_loading'),
            'port_of_delovery' => $tableConf->getAll('port_of_delovery'),
        ];
        $this->ajaxSuccess($configs);
    }

    public function getPortAsync(){
        $countryId = $_GET['pid'];
        if(!$countryId){
            $this->ajaxSuccess([]);
            exit;
        }
        $country = new CountryModel();
        $this->ajaxSuccess($country->getPort($countryId));
    }

    public function containerConfig(){
        $tableConf = new TableConfigModel();
        $configs = [
            'container'=>$tableConf->getAll('container'),
            'containerType'=>$tableConf->getAll('container_type'),
        ];
        $this->ajaxSuccess($configs);
    }

    public function containerDetailConfig(){
        $tableConf = new TableConfigModel();
        
        $this->ajaxSuccess($tableConf->getAll('container_detail'));
    }
    
}
