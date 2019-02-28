<?php
/**Автономный класс**/

namespace app\controllers\actions;

use app\models\Activity;
use yii\base\Action;
use app\components\ActivityComponent;
use yii\widgets\ActiveForm;
use yii\web\Response;


class ActivityCreateAction extends Action
{
	public function run(){
		
		/**@var ActivityComponent $comp*/
			//1 вариант
			$comp=\Yii::$app->activity;
			/**$comp=\Yii::createObject([
			'class'=>ActivityComponent::class,
			'activity_class'=>Activity::class
		]);*/

		//проверка на post запрос
		if(\Yii::$app->request->isPost){
			
			//значения из запроса
			$activity = $comp->getModel(\Yii::$app->request->post());
		//проверка на Ajax запрос	
			if(\Yii::$app->request->isAjax){
				\Yii::$app->response->format=Response::FORMAT_JSON;

				return ActiveForm::validate($activity);
			}

			if($comp->createActivity($activity)){
				
				return $this->controller->render('create-derivation', ['activity' => $activity]);
			}
			
		}else{
			//с пустыми значениями
			$activity = $comp->getModel();
		}
		
		return $this->controller->render('create', ['activity'=>$activity]);

	}
}