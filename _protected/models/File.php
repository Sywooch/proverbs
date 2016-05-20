<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;
use mdm\upload\FileController;

/**
 * Use to show or download uploaded file. Add configuration to your application
 * 
 * ~~~
 * 'controllerMap' => [
 *     'file' => 'mdm\upload\FileController',
 * ],
 * ~~~
 * 
 * Then you can show your file in url `Url::to(['/file','id'=>$file_id])`,
 * and download file in url `Url::to(['/file/download','id'=>$file_id])`
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class File extends FileController
{
    public $defaultAction = 'show';

    /**
     * Show file
     * @param integer $id
     */
    public function actionShow($id)
    {
        if(!Yii::$app->user->isGuest){
            $model = $this->findModel($id);
            $response = Yii::$app->getResponse();
            return $response->sendFile($model->filename, $model->name, [
                    'mimeType' => $model->type,
                    'fileSize' => $model->size,
                    'inline' => true
            ]);
        }
    }

    /**
     * Download file
     * @param integer $id
     * @param mixed $inline
     */
    public function actionDownload($id, $inline = false)
    {
        $model = $this->findModel($id);
        $response = Yii::$app->getResponse();
        return $response->sendFile($model->filename, $model->name, [
                'mimeType' => $model->type,
                'fileSize' => $model->size,
                'inline' => $inline
        ]);
    }

    /**
     * Get model
     * @param integer $id
     * @return \mdm\upload\FileModel
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = \mdm\upload\FileModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findImage($id)
    {
        if (($model = \mdm\upload\FileModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findThumbnail($id)
    {
        if (($model = \mdm\upload\FileModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}