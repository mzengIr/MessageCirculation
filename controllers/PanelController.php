<?php

namespace app\controllers;

use app\models\DepartmentForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class PanelController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $departmentForm = new DepartmentForm();
        if ($departmentForm->load(Yii::$app->request->post())) {
           $departmentForm->save(Yii::$app->request->post());
        }
        return $this->render('panel', [
            'model' => $departmentForm,
        ]);

    }
  

}
