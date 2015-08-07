<?php
namespace comparison\comparison\storage;

use yii\base\Object;
use comparison\comparison\Comparison;

class SessionStorage extends Object implements StorageInterface
{
    public $key = 'comparison';
    public function load(Comparison $comparison)
    {
        $comparisonData = [];
        if (false !== ($session = ($this->session->get($this->key, false)))) {
            $comparisonData = unserialize($session);
        }
        return $comparisonData;
    }

    public function save(Comparison $comparison)
    {
        $sessionData = serialize($comparison->getItems());
        $this->session->set($this->key, $sessionData);
    }

    public function getSession()
    {
        return \Yii::$app->get('session');
    }
}