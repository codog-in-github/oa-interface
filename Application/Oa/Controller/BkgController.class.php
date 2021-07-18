<?php
namespace Oa\Controller;

use Oa\Model\BkgModel;

class BkgController extends AuthController{
    public function saveData(){
        $bkg = new BkgModel();
        $bkg->saveData($_POST['header']);
    }
}
