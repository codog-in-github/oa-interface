<?php
namespace Oa\Controller;

use Oa\Controller\AuthController;
use Oa\Model\TableConfigModel;
use Oa\Model\TableConfigDetailModel;
use Oa\Model\SelectModel;
use Oa\Model\CountryModel;
use Oa\Model\BookerModel;

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

    public function bookerList(){
        $likeField = [
            'booker',
            'tel',
            'place',
            'staff',
            'staff_tel',
            'short_name',
        ];
        $query = [];
        foreach($likeField as $field){
            if(isset($_REQUEST[$field]) && $_REQUEST[$field] !== ''){
                $query[$field] = ['LIKE', "%{$_REQUEST[$field]}%"];
            }
        }
        $current = $_REQUEST['current'];
        $size = $_REQUEST['size'];
        $booker = new BookerModel();
        $this->ajaxSuccess($booker->getList($query, $size, $current));
    }

    public function addBooker(){
        $this->_checkParams(['booker'], 'POST');
        return $this->ajaxSuccess(M('booker')->add($_POST));
    }

    public function editBooker(){
        $this->_checkParams(['booker', 'id'], 'POST');
        return $this->ajaxSuccess(M('booker')->save($_POST));
    }

    public function deleteBooker(){
        $this->_checkParams(['id'], 'POST');
        $id = $_POST['id'];
        $booker = new BookerModel();
        return $this->ajaxSuccess($booker->deleteById($id));
    }

}
