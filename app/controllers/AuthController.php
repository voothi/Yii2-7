<?php
/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.02.2019
 * Time: 19:21
 */

namespace app\controllers;


use app\components\UsersAuthComponent;
use yii\web\Controller;

class AuthController extends Controller
{

    public function actionSignIn(){
        /** @var UsersAuthComponent $comp */
        $comp=\Yii::$app->auth;

        $model=$comp->getModel(\Yii::$app->request->post());

        if(\Yii::$app->request->isPost){
            if($comp->loginUser($model)){
                return $this->redirect(['/activity/create'],200);
            }
        }

        return $this->render('signin',['model'=>$model]);
    }

    public function actionSignUp(){
        /** @var UsersAuthComponent $comp */
        $comp=\Yii::$app->auth;

        $model=$comp->getModel(\Yii::$app->request->post());

        if(\Yii::$app->request->isPost){
            if($comp->createNewUser($model)){
                \Yii::$app->session->addFlash('success','Пользователь успешно добавлен ID '.$model->id);
                return $this->redirect(['/']);
            }
        }

        return $this->render('signup',['model'=>$model]);
    }
}