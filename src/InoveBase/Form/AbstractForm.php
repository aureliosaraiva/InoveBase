<?php
namespace InoveBase\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
 
class ExtendedFormValidator extends InputFilter {
 
    public function __construct($elements) {
        foreach ($elements as $element) {
            if (is_array($element)) {
                if (isset($element['type'])) {
                    unset($element['type']);
                }
                $this -> add($element);
            }
        }
    }
 
}

abstract class AbstractForm extends Form {
    
    protected $_rawElements = array();

    public function isValid($request = null) {
        $this->__addValidator();
        if ($request -> isPost()) {
            $this -> setData($request -> getPost());
            return parent::isValid();
        } else {
            return false;
        }
    }
    
    public function add($elementOrFieldset, array $flags = array()) {
        $form = parent::add($elementOrFieldset, $flags);
        $this->_rawElements[] = $elementOrFieldset;
        return $form;
    }
    
    private function __addValidator() {
        $this -> setInputFilter(new ExtendedFormValidator($this->_rawElements));
    }
}
