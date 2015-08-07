<?php
namespace comparison\comparison\storage;

use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\db\Connection;
use yii\db\Query;
use yii\web\User;
use comparison\comparison\Comparison;

class DatabaseStorage extends Object implements StorageInterface
{
    /**
     * @var string Name of the user component
     */
    public $userComponent = 'user';
    /**
     * @var string Name of the database component
     */
    public $dbComponent = 'db';

    /**
     * @var string Name of the cart table
     */
    public $table = 'Comparison';

    /**
     * @var string Name of the
     */
    public $idField = 'sessionId';

    /**
     * @var string Name of the field holding serialized session data
     */
    public $dataField = 'comparisonData';

    /**
     * @var bool If set to true, empty cart entries will be deleted
     */
    public $deleteIfEmpty = false;

    /**
     * @var Connection
     */
    private $db;
    /**
     * @var User
     */
    private $user;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->db = \Yii::$app->get($this->dbComponent);

        if (isset($this->userComponent)) {
            $this->user = \Yii::$app->get($this->userComponent);
        }

        if (!isset($this->table)) {
            throw new InvalidConfigException('Please specify "table" in comparison configuration');
        }
    }

    public function load(Comparison $comparison)
    {
        $session = $comparison->getSession();
        $identifier = $this->getIdentifier($session->getId());

        $query = new Query();
        $query->select($this->dataField)
            ->from($this->table)
            ->where([$this->idField => $identifier]);

        $items = [];

        if ($data = $query->createCommand($this->db)->queryScalar()) {
            $items = unserialize($data);
        }

        return $items;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    protected function getIdentifier($default)
    {
        $id = $default;
        if ($this->user instanceof User && !$this->user->getIsGuest()) {
            $id = $this->user->getId();
        }
        return $id;
    }

    public function save(Comparison $comparison)
    {
        $session = $comparison->getSession();
        $identifier = $this->getIdentifier($session->getId());

        $items = $comparison->getItems();
        $sessionData = serialize($items);

        $command = $this->db->createCommand();

        if (empty($items) && true === $this->deleteIfEmpty) {
            $command->delete($this->table, [$this->idField => $identifier]);
        } else {
            $command->setSql("
                REPLACE {{{$this->table}}}
                SET
                    {{{$this->dataField}}} = :val,
                    {{{$this->idField}}} = :id
            ")->bindValues([
                ':id' => $identifier,
                ':val' => $sessionData,
            ]);
        }
        $command->execute();
    }

    /**
     * @param $sourceId
     * @param $destinationId
     */
    public function reassign($sourceId, $destinationId)
    {
        $command = $this->db->createCommand();
        $command->delete($this->table, [$this->idField => $destinationId])->execute();
        $command->setSql("
                UPDATE {{{$this->table}}}
                SET
                    {{{$this->idField}}} = :userId
                WHERE
                    {{{$this->idField}}} = :sessionId
            ")->bindValues([
            ':userId' => $destinationId,
            ':sessionId' => $sourceId
        ])->execute();
    }
}