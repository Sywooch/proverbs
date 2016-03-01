<?php

namespace app\controllers;

use app\models\NurseryForm;
use app\models\NurseryFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ViewGradeController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    	return $this->render('index');
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = NurseryForm::findOne($id)) !== null) {
            return $model;
        } elseif (($model = KinderOneForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = KinderTwoForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeOneForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeTwoForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeThreeForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeFourForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeFiveForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeSixForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeSevenForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeEightForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeNineForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeTenForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeElevenFirstSemForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeElevenSecondSemForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeTwelveFirstSemForm::findOne($id)) !== null) {
        	return $model;
        } elseif (($model = GradeTwelveSecondSemForm::findOne($id)) !== null) {
        	return $model;
        } else
            throw new NotFoundHttpException('The requested page does not exist.');
    }
}
