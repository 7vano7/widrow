<?php
namespace common\components\behaviors;

use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\base\Event;
use yii\base\NotSupportedException;
use common\models\History;
use common\models\User;
use common\components\Date;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class HistoryBehavior extends Behavior
{
    /**
     * Event types of history to the AR object: when create model.
     */
    const EVENT_INSERT = 1;
    /**
     * Event types of history to the AR object: when update model.
     */
    const EVENT_UPDATE = 2;
    /**
     * Event types of history to the AR object: when delete model.
     */
    const EVENT_DELETE = 3;

    /**
     * @var array Allowed events list than are monitored and saved in storage.
     */
    public $allowEvents = [
        self::EVENT_INSERT,
        self::EVENT_UPDATE,
        self::EVENT_DELETE,
    ];
    /**
     * @var array List of attributes which not need track at updating. Apply only for `self::EVENT_UPDATE`.
     */
    public $skipAttributes = [];

    private $defaultSkipAttributes = ['created_at', 'updated_at'];

    /**
     * @var array List of custom attributes which which are a pair of `key`=>`value` where `key` is attribute name and
     * `value` it anonymous callback function of attribute. Function will be apply for old and value information data.
     * Example:
     * ```php
     * [
     *      'attribute_1' => function($event, $isNewValue) {
     *          if ($isNewValue) {
     *              return $event->sender->attribute_1;
     *          }
     *          return $event->changedAttributes['attribute_1'];
     *      },
     * ]
     * ```
     *  Apply only for `self::EVENT_UPDATE`.
     */
    public $customAttributes = [];
    /**
     * @var array Mapping events between behavior and active record model.
     */
    protected $eventMap = [
        self::EVENT_INSERT => BaseActiveRecord::EVENT_AFTER_INSERT,
        self::EVENT_UPDATE => BaseActiveRecord::EVENT_AFTER_UPDATE,
        self::EVENT_DELETE => BaseActiveRecord::EVENT_AFTER_DELETE,
    ];

    /**
     * @inhertidoc
     */
    public function init()
    {
        parent::init();
        $this->skipAttributes = array_fill_keys($this->skipAttributes, true);
    }

    /**
     * @inheritdoc
     */
    public function events():array
    {
        $events = [];
        foreach ($this->allowEvents as $name) {
            $events[$this->eventMap[$name]] = 'saveHistory';
        }
        return $events;
    }

    /**
     * Process of saving history to storage.
     * @param Event $event
     * @throws NotSupportedException
     */
    public function saveHistory(Event $event)
    {
        $created_at = $this->getDate();
        $ip = $this->getIp();
        $user_id = $this->getUserId();
        $user_role = $this->getUserRole($user_id);

        if( $event->name === BaseActiveRecord::EVENT_AFTER_INSERT ){
            $action = History::ACTION_INSERT;
        }elseif( $event->name === BaseActiveRecord::EVENT_AFTER_UPDATE ){
            $action = History::ACTION_UPDATE;
        }elseif( $event->name === BaseActiveRecord::EVENT_AFTER_DELETE ){
            $action = History::ACTION_DELETE;
        }else{
            $action = History::ACTION_UNKNOWN;
        }

        $model = $this->getModel($event->sender);
        $object_id = $this->getObjectId();
        $change_data = $this->getChangeData($event);

        $history = new History();
        $history->created_at = $created_at;
        $history->ip = $ip;
        $history->user_id = $user_id;
        $history->user_role = $user_role;
        $history->action = $action;
        $history->model = $model;
        $history->object_id = $object_id;
        $history->change_data = $change_data;
        $history->save();
    }

    private function getDate(){
        return (new Date())->now();
    }

    private function getIp(){
        return empty(\Yii::$app->request->userIP) ? null : \Yii::$app->request->userIP;
    }

    private function getUserId(){
        if( \Yii::$app->has('user') === false ){
            return null;
        }

        return  \Yii::$app->user->isGuest ? null : \Yii::$app->user->id;
    }

    private function getUserRole($user_id){
        return empty($user_id) ? null : User::findOne($user_id)->role;
    }

    private function getModel($model):string {
        return \get_class($model);
    }

    /**
     * Return primary key of attached model.
     * @return integer
     * @throws NotSupportedException
     */

    private function getObjectId():int
    {
        $primaryKey = $this->getPrimaryKey();
        return $this->owner->$primaryKey;
    }

    /**
     * Return primary key of attached model.
     * @return string
     * @throws NotSupportedException
     */
    private function getPrimaryKey():string
    {
        $primaryKey = $this->owner->primaryKey();
        if (\count($primaryKey) === 1) {
            $primaryKey = array_shift($primaryKey);
        } else {
            throw new NotSupportedException('Composite primary key not supported.');
        }
        return $primaryKey;
    }

    private function getChangeData($event):string {
        $data = [];
        
        if( !empty($event->changedAttributes) ){
            $changedAttributes = $event->changedAttributes;

            if( !empty($changedAttributes) ){
                //Ignore default attributes
                foreach ($this->defaultSkipAttributes as $defaultSkipAttribute){
                    if( isset($changedAttributes[$defaultSkipAttribute]) ){
                        unset($changedAttributes[$defaultSkipAttribute]);
                    }
                }

                //Ignore user attributes
                if( !empty($changedAttributes) && !empty($this->skipAttributes) ){
                    foreach ($this->skipAttributes as $skipAttributes){
                        if( isset($changedAttributes[$skipAttributes]) ){
                            unset($changedAttributes[$skipAttributes]);
                        }
                    }
                }
            }

            if( !empty($changedAttributes) ){

                $attributes = ArrayHelper::toArray($event->sender);

                foreach ($changedAttributes as $key => $value){
                    $data[$key] = [
                        'from' => $value,
                        'to' => isset($attributes[$key]) ? $attributes[$key] : null,
                    ];
                }
            }
        }

        return Json::encode($data);
    }
}