<?php
namespace comparison\comparison;

use yii\base\Component;
use yii\base\InvalidParamException;
use yii\web\Session;
use comparison\comparison\models\ComparisonItemInterface;

class Comparison extends Component
{
    const ITEM_PRODUCT = '\comparison\comparison\models\ComparisonItemInterface';
    protected $items;
    private $storage = null;
    public $storageClass = '\comparison\comparison\storage\SessionStorage';

    public function init()
    {
        $this->clear(false);
        $this->setStorage(\Yii::createObject($this->storageClass));
        $this->items = $this->storage->load($this);
    }

    public function reassign($sessionId, $userId)
    {
        if (get_class($this->getStorage()) === 'comparison\comparison\storage\DatabaseStorage') {
            if (!empty($this->items)) {
                $storage = $this->getStorage();
                $storage->reassign($sessionId, $userId);
                self::init();
            }
        }
    }

    public function clear($save = true)
    {
        $this->items = [];
        $save && $this->storage->save($this);
        return $this;
    }

    public function setStorage($storage)
    {
        $this->storage = $storage;
        return $this;
    }

    public function add(ComparisonItemInterface $element, $save = true)
    {
        $this->addItem($element);
        $save && $this->storage->save($this);
        return $this;
    }

    protected function addItem(ComparisonItemInterface $item)
    {
        $uniqueId = $item->getUniqueId();
        $this->items[$uniqueId] = $item;
    }

    public function remove($uniqueId, $save = true)
    {
        if (!isset($this->items[$uniqueId])) {
            throw new InvalidParamException('Item not found');
        }
        unset($this->items[$uniqueId]);

        $save && $this->storage->save($this);
        return $this;
    }

    public function getCount($itemType = null)
    {
        return count($this->getItems($itemType));
    }

    public function getItems($itemType = null)
    {
        $items = $this->items;
        if (!is_null($itemType)) {
            $items = array_filter($items,
                function ($item) use ($itemType) {
                    return is_subclass_of($item, $itemType);
                });
        }
        return $items;
    }
	
    public function getAttributeTotal($attribute, $itemType = null)
    {
        $sum = 0;
        foreach ($this->getItems($itemType) as $model) {
            $sum += $model->{$attribute};
        }
        return $sum;
    }

    protected function getStorage()
    {
        return $this->storage;
    }
}