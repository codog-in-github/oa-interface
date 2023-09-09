<?php
namespace Oa\Controller;

use Oa\Model\BankModel;
use Oa\Controller\AuthController;
use Oa\Model\TableConfigModel;
use Oa\Model\SelectModel;
use Oa\Model\CountryModel;
use Oa\Model\BookerModel;
use Oa\Model\DepartmentModel;

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
            'booker', 'tel', 'place', 'staff',
            'staff_tel', 'short_name',
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

    public function getCountryList () {
        $pid = $_POST['pid'] ?: 0;
        $query = $_POST['query'];

        $isPort = boolval($pid);
        $cm = new CountryModel();
        if($query){
            $this->ajaxSuccess($cm->searchPortList($query));
        } elseif ($isPort) {
            $this->ajaxSuccess($cm->getPortList($pid));
        } else {
            $this->ajaxSuccess($cm->getCountryList());
        }

    }

    public function addCountry () {
        $this->_checkParams(['code', 'label'], 'POST');
        $pid = $_POST['pid'] ?: 0;
        $isPort = boolval($pid);
        $cm = new CountryModel();
        if ($isPort) {
            $this->ajaxSuccess($cm->addPort([
                'pid' => $pid,
                'label' => $_POST['label'],
                'code' => $_POST['code'],
            ]));
        } else {
            $this->ajaxSuccess(
                $cm->addCountry([
                    'label' => $_POST['label'],
                    'code' => $_POST['code'],
                ])
            );
        }
    }

    public function editCountry () {
        $this->_checkParams(['id'], 'POST');
        $id = $_POST['id'];
        $cm = new CountryModel();
        $this->ajaxSuccess($cm->editPort($_POST['id'], $_POST['info']));
    }

    public function deleteCountry () {
        $this->_checkParams(['id'], 'POST');
        $cm = new CountryModel();
        $this->ajaxSuccess($cm->deletePort($_POST['id']));
    }

    public function bankList () {
        $bank = new BankModel();
        return $this->ajaxSuccess(
            $bank->listAll()
        );
    }

    public function departmentList () {
        $de = new DepartmentModel();
        return $this->ajaxSuccess(
            $de->listAll()
        );
    }
}
