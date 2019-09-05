<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\News;
use yii\db\ActiveQuery;

/**
 * NewsSearch represents the model behind the search form of `app\modules\admin\models\News`.
 */
class NewsSearch extends News
{
    public $username;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'string'],
            [['id', 'author_id', 'category_id', 'status', 'viewed', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = News::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /*$query->with([
            'author' => function(ActiveQuery $query) {
                $query->andFilterWhere(['like', 'username', $this->username]);
            },
            'category'
        ]);*/

        $query->select('{{%news}}.*')
            ->leftJoin('{{%user}}', '`user`.`id` = `news`.`author_id`')
            ->with([
                'author',
                'category'
            ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            '{{%news}}.status' => $this->status,
            'viewed' => $this->viewed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', '{{%user}}.username', $this->username]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
