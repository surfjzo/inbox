<?php

namespace app\controllers;

use app\models\CartSearch;
use app\models\Currency;
use app\models\Users;
use Yii;
use app\models\Checkout;
use app\models\CheckoutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CheckoutController implements the CRUD actions for Checkout model.
 */
class CheckoutController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Checkout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CheckoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Checkout model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Checkout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Checkout();
        $value = CartSearch::find()->select(['c.id as cId', 'c.userId as cUserId', 'c.productId as cProductId', 'p.*'])->from(['cart as c'])->where(['c.userId' => Yii::$app->user->id])->join('LEFT JOIN', 'products as p', 'p.id = c.productId')->asArray()->all();
        $total = 0;
        foreach ($value as $item) {
            $total += floatval($item['price']);
        }
        $model->userId = Yii::$app->user->id;
        $model->value = $total * Currency::getCurrency();
        if ($model->save()) {
            CartSearch::deleteAll(['userId' => Yii::$app->user->id]);
            $user = Users::findOne(['id' => Yii::$app->user->id]);
            Yii::$app->mailer->compose()
                ->setFrom('surfjzo@gmail.com')
                ->setTo($user->username)
                ->setSubject('Billing information')
                ->setTextBody("Thanks for buying with us, the total price is {$total}.")
                ->setHtmlBody("<b>Thanks for buying with us, the total price is {$total}, you can pay with credit card. Thanks again, INBOX Team.</b>")
                ->send();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Updates an existing Checkout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Checkout model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Checkout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Checkout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Checkout::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
