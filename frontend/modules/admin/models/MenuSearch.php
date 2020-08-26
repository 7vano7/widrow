<?php

namespace frontend\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MenuSearch represents the model behind the search form of `frontend\modules\admin\models\Menu`.
 */
class MenuSearch extends Menu
{
    public $lang;
    public $menu_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['status', 'lang', 'menu_name', 'parent_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Menu::find()->joinWith(['menuLang'])->orderBy(['menu.id'=>SORT_DESC]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query->distinct(),
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'status',
                'parent_name',
                'menu_name',
                'lang',
                'news_lang' => [
                    'asc' => ['news_lang.news_id' => SORT_ASC],
                    'desc' => ['news_lang.news_id' => SORT_DESC]
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'parent_name'=>$this->parent_name,
            'lang'=>$this->lang,
            'menu_lang.lang'=>$this->lang,
            'menu_lang.menu_name'=>$this->menu_name,
            'is_menu'=>Menu::MENU_TRUE,
        ]);
        return $dataProvider;
    }
}
