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
 * In2it_Model_Collection
 * 
 * This abstract class provides a blue-print of model collection classes that 
 * extends this functionality and allows a certain behaviour to be expected
 * 
 * @category In2it
 * @package In2it_Model
 * @copyright Copyright (c) 2012 in2it vof
 */
abstract class In2it_Model_Collection implements Countable, SeekableIterator
{
    /**
     * @var array A list of model elements
     */
    protected $_elements;
    /**
     * @var int The position in this iterator
     */
    protected $_position;
    /**
     * @var int The count of elements in this iterator
     */
    protected $_count;
    /**
     * Constructor of this collection class
     */
    public function __construct()
    {
        $this->_elements = array ();
        $this->_count = 0;
        $this->rewind();
    }
    /**
     * Adds an element to this collection
     * 
     * @param In2it_Model_Model $model 
     * @return In2it_Model_Collection
     */
    public function addElement(In2it_Model_Model $model)
    {
        $this->_elements[] = $model;
        $this->_count++;
        return $this;
    }
    /**
     * Sets an array as collection
     * 
     * @param array $entries
     * @return In2it_Model_Collection 
     */
    public function setElements($entries)
    {
        $this->_elements = $entries;
        $this->_count = count($entries);
        return $this;
    }
    /**
     * Retrieve all elements of this collection
     * 
     * @return array
     */
    public function getElements()
    {
        return $this->_elements;
    }
    /**
     * The key of this collection
     * 
     * @return int
     * @see Iterator::key()
     */
    public function key()
    {
        return $this->_position;
    }
    /**
     * The current model from this collection
     * 
     * @return In2it_Model_Model 
     * @see Iterator::current()
     */
    public function current()
    {
        return $this->_elements[$this->_position];
    }
    /**
     * Verifies if the iterator is still valid
     * 
     * @return bool
     * @see Iterator::valid()
     */
    public function valid()
    {
        return isset($this->_elements[$this->_position]);
    }
    /**
     * Rewinds this iterator back to it's first position
     * 
     * @return In2it_Model_Collection 
     * @see Iterator::rewind()
     */
    public function rewind()
    {
        $this->_position = 0;
        return $this;
    }
    /**
     * Move to the next item in this collection
     * 
     * @return In2it_Model_Collection 
     * @see Iterator::next()
     */
    public function next()
    {
        $this->_position++;
        return $this;
    }
    /**
     * Seek a specific model at given position in this collection
     * 
     * @param int $position
     * @return In2it_Model_Collection 
     * @see SeekableIterator::seek()
     */
    public function seek($position)
    {
        $this->_position = $position;
        if (!isset ($this->_elements[$this->_position])) {
            throw new OutOfBoundsException('Invalid postion provided');
        }
        return $this;
    }
    /**
     * Returns the current count of elements in this collection
     * 
     * @return int
     * @see Countable::count()
     */
    public function count()
    {
        return $this->_count;
    }
    /**
     * Converts this collection of models into an array map
     * 
     * @return array
     */
    public function toArray()
    {
        $entries = array();
        $this->rewind();
        while ($this->valid()) {
            $entries[] = $this->current()->toArray();
            $this->next();
        }
        return $entries;
    }
}