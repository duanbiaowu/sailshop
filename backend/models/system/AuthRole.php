<?php

namespace backend\models\system;

use Yii;

/**
 * This is the model class for table "{{%auth_role}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $route
 * @property integer $operation
 */
class AuthRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'operation'], 'integer'],
            [['parent_id'], 'default', 'value' => 0],
            [['name'], 'string', 'max' => 64],
            [['route'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('System', 'ID'),
            'name' => Yii::t('System', 'Auth Role Name'),
            'parent_id' => Yii::t('System', 'Parent ID'),
            'route' => Yii::t('System', 'Route'),
            'operation' => Yii::t('System', 'Operation'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $roleMenus = $this->initRoleMenu();

        if ($operations = Yii::$app->request->post('operation')) {
            foreach ($operations as $index => $operation) {
                $update = [
                    'operation' => 1,
                ];
                $params = [
                    'id' => $roleMenus[$index]['role_parent_id'],
                ];
                Yii::$app->db->createCommand()->update(self::tableName(), $update, $params)->execute();

                foreach ($operation as $sendIndex => $sendOperation) {
                    $update = [
                        'operation' => 1,
                    ];
                    $params = [
                        'id' => $roleMenus[$sendIndex]['role_parent_id'],
                    ];
                    Yii::$app->db->createCommand()->update(self::tableName(), $update, $params)->execute();

                    foreach ($sendOperation as $thirdIndex => $thirdOperation) {
                        $update = [
                            'operation' => array_sum($thirdOperation),
                        ];
                        $params = [
                            'id' => $roleMenus[$thirdIndex]['role_parent_id'],
                        ];
                        Yii::$app->db->createCommand()->update(self::tableName(), $update, $params)->execute();
                    }
                }
            }
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function initRoleMenu()
    {
        $menus = AuthMenu::find()
            ->indexBy('id')
            ->orderBy(['parent_id' => SORT_ASC])
            ->asArray()
            ->all();

        foreach ($menus as &$menu) {
            $record = [
                'name' => $menu['name'],
                'parent_id' => $menu['parent_id'] == 0 ? $this->id : $menus[$menu['parent_id']]['role_parent_id'],
                'route' => $menu['route'],
            ];

            if (($model = AuthRole::findOne($record)) === null) {
                $record['sort'] = $menu['sort'];
                Yii::$app->db->createCommand()->insert(self::tableName(), $record)->execute();
                $menu['role_parent_id'] = Yii::$app->db->getLastInsertID();
            } else {
                $record['sort'] = $menu['sort'];
                $record['operation'] = 0;
                $menu['role_parent_id'] = $model->id;
                Yii::$app->db->createCommand()->update(self::tableName(), $record, ['id' => $model->id])->execute();
            }
        }

        return $menus;
    }

    public function getRoleMenus()
    {
        $menus = AuthMenu::find()
            ->indexBy('id')
            ->orderBy(['parent_id' => SORT_ASC])
            ->asArray()
            ->all();

        foreach ($menus as &$menu) {
            $params = [
                'name' => $menu['name'],
                'parent_id' => $menu['parent_id'] == 0 ? $this->id : $menus[$menu['parent_id']]['role_id'],
                'route' => $menu['route'],
            ];

            $model = AuthRole::findOne($params);
            $menu['role_id'] = $model->id;
            $menu['operation'] = $model->operation;
        }

        return $menus;
    }

    public function operations()
    {
        return [
            1 => Yii::t('System', 'View'),
            2 => Yii::t('System', 'Create'),
            4 => Yii::t('System', 'Update'),
            8 => Yii::t('System', 'Delete'),
        ];
    }

    public function afterDelete()
    {
        foreach ($this->getRoleMenus() as $menu) {
            Yii::$app->db->createCommand()->delete(self::tableName(), ['id' => $menu['role_id']])->execute();
        }
        parent::afterDelete(); // TODO: Change the autogenerated stub
    }
}
