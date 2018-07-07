<?php
/**
 * Created by PhpStorm.
 * User: yyk
 * Date: 18-7-7
 * Time: 下午5:50
 */
namespace app\models\job;

use yii;
use yii\queue\Job;
use yii\base\BaseObject;

class BaseJob  extends BaseObject  implements Job
{
    public $url;
    public $file;

    public function execute($queue)
    {
        file_put_contents($this->file, file_get_contents($this->url));
    }
}