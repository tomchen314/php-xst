<?php
/**
 * Created by PhpStorm.
 * User: tang
 * Date: 2015/07/20
 * Time: 15:11
 */

namespace Xst\Modules\Skeleton\Forms\Product;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Xst\Models\ProductTypes;
use Xst\Core\FormBase;

class NewProductForm extends FormBase {

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array()) {
        $name = new Text("name");
        $name->setLabel("Name");
        $name->setAttribute("class", "form-control");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => 'Name is required with form'
                    )
                )
            )
        );
        $this->add($name);
        $type = new Select('product_types_id', ProductTypes::find(),
            array(
                'using'      => array('id', 'name'),
                'useEmpty'   => true,
                'emptyText'  => '...',
                'emptyValue' => ''
            )
        );
        $type->setLabel('Type');
        $type->setAttribute("class", "form-control");
        $this->add($type);
        $price = new Text("price");
        $price->setLabel("Price");
        $price->setAttribute("class", "form-control");
        $price->setFilters(array('float'));
        $price->addValidators(
            array(
                new PresenceOf(
                    array(
                        'message' => 'Price is required with form'
                    )
                )
//            ,
//            new Numericality(array(
//                'message' => 'Price is required'
//            ))
            )
        );
        $this->add($price);

        $test = new Text("test");
        $test->setLabel("test");
        $test->setAttribute("class", "form-control");
        $this->add($test);
        //array_splice($this->_elements, count($this->_elements) - 1, 1);

        $save = new Submit("Save");
        $save->setLabel(" ");
        $save->setAttribute("onclick", "__doPostBack('save', '');return false;");
        $save->setAttribute("class", "btn btn-default");
        $this->add($save);

        if (isset($entity)) {
            $delete = new Submit("Delete");
            $delete->setLabel(" ");
            $delete->setAttribute("onclick", "__doPostBack('delete', '');return false;");
            $delete->setAttribute("class", "btn btn-warning");
            $this->add($delete);
            $name->setDefault($entity->getName());
            $type->setDefault($entity->getProductTypesId());
            $price->setDefault($entity->getPrice());
            if ($entity->getProductTypesId() == 6) {
                $test->setDefault("5");
            }
        }
    }
}