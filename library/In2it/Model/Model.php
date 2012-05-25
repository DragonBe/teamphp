<?php
/**
 * In2it
 * 
 * This is an extension of Zend Framework containing custom extensions for
 * the Zend Framework build by in2it vof team members.
 *
 * @category   In2it 
 * @package    In2it_Model
 * @copyright  Copyright (c) 2012 in2it vof (http://in2it.be)
 */
/**
 * In2it_Model_Model
 * 
 * This abstract class provides a blue-print of model classes that extends
 * this functionality and allows a certain behaviour to be expected
 * 
 * @category In2it
 * @package In2it_Model
 * @copyright Copyright (c) 2012 in2it vof
 */
abstract class In2it_Model_Model implements In2it_Model_Interface
{
    /**
     * Constructor for this class populating the model with optional row data.
     * 
     * @param null|array|Zend_Db_Row $params 
     */
    public function __construct($params = null)
    {
        if (null !== $params) {
            $this->populate($params);
        }
    }
    /**
     * Sets the identifier for this Model
     * 
     * @param int $id The ID for the Model
     * @return In2it_Model_Model
     */
    public function setId($id)
    {
        $this->_setId = (int) $id;
        return $this;
    }
    /**
     * Retrieves the identifier from this Model
     * 
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }
    
    protected function _validateProperties($row, $properties)
    {
        if (!is_array($properties)) {
            throw new DomainException('Please provide an array of properties');
        }
        foreach ($properties as $property) {
            if (!isset ($row->$property)) {
                throw new DomainException(
                    sprintf('Property \'%s\' is missing', $property)
                );
            }
        }
    }
    
}