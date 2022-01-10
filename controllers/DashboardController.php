<?php

namespace app\controllers;

use app\models\MessageOperation;
use app\models\AcceptForm;
use app\models\Employee;
use app\models\Message;
use app\models\MessageSearch;
use app\models\MessageForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UnauthorizedHttpException;

class DashboardController extends Controller
{

    const INBOX = 1;
    const SENT = 2;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','create','inbox','sent','reject','accept'],
                        'allow' => true,
                        'roles' => ['employee'],
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
        return $this->render('dashboard');
    }

    public function actionSent(){
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get(),self::SENT);
 
        return $this->render('/dashboard/sent', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }

    public function actionInbox(){
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get(),self::INBOX);
 
        return $this->render('/dashboard/inbox', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }
  
    public function actionCreate(){
        $messageForm = new MessageForm();
        if ($messageForm->load(Yii::$app->request->post())) {
           $messageForm->save(Yii::$app->request->post());
        }
        $employeeType = Employee::getType(Yii::$app->user->identity->id);
        if($employeeType == Employee::TYPE_MANAGER){
            throw new UnauthorizedHttpException('Manager is not able to send messages');
        }
        return $this->render('create', [
            'model' => $messageForm 
        ]);
    }

    public function actionAccept(){
        $id = Yii::$app->request->get('id');
        $acceptForm = new AcceptForm();
        if($acceptForm->load(Yii::$app->request->post())){
            if($acceptForm->save(Yii::$app->request->post(), $id)){
                return $this->redirect(['dashboard/inbox']);
            }
        }
        return $this->render('/dashboard/accept', [
            'acceptForm' => $acceptForm 
        ]);
    }


    public function actionReject(){
        $id = Yii::$app->request->get('id');
        Message::changeStatus($id,Message::STATUS_REJECTED);
        MessageOperation::saveMessageOperation($id);
        return $this->redirect(Yii::$app->request->referrer);
    }
}
