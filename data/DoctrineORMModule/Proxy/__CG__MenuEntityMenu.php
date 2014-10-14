<?php

namespace DoctrineORMModule\Proxy\__CG__\Menu\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Menu extends \Menu\Entity\Menu implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'id', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'ten', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'dinhTuyen', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'thamSo', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'loai', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'cha');
        }

        return array('__isInitialized__', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'id', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'ten', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'dinhTuyen', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'thamSo', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'loai', '' . "\0" . 'Menu\\Entity\\Menu' . "\0" . 'cha');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Menu $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setTen($ten)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTen', array($ten));

        return parent::setTen($ten);
    }

    /**
     * {@inheritDoc}
     */
    public function getTen()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTen', array());

        return parent::getTen();
    }

    /**
     * {@inheritDoc}
     */
    public function setDinhTuyen($dinhTuyen)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDinhTuyen', array($dinhTuyen));

        return parent::setDinhTuyen($dinhTuyen);
    }

    /**
     * {@inheritDoc}
     */
    public function getDinhTuyen()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDinhTuyen', array());

        return parent::getDinhTuyen();
    }

    /**
     * {@inheritDoc}
     */
    public function setThamSo($thamSo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setThamSo', array($thamSo));

        return parent::setThamSo($thamSo);
    }

    /**
     * {@inheritDoc}
     */
    public function getThamSo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getThamSo', array());

        return parent::getThamSo();
    }

    /**
     * {@inheritDoc}
     */
    public function setCha($cha)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCha', array($cha));

        return parent::setCha($cha);
    }

    /**
     * {@inheritDoc}
     */
    public function getCha()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCha', array());

        return parent::getCha();
    }

    /**
     * {@inheritDoc}
     */
    public function setLoai($loai)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLoai', array($loai));

        return parent::setLoai($loai);
    }

    /**
     * {@inheritDoc}
     */
    public function getLoai()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLoai', array());

        return parent::getLoai();
    }

    /**
     * {@inheritDoc}
     */
    public function getTenCha()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTenCha', array());

        return parent::getTenCha();
    }

}
