<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-25
 */

namespace backend\models\system;

use Yii;
use yii\base\Model;

class Database extends Model
{
    public function getStatus()
    {
        $sql = 'SHOW TABLE STATUS LIKE ' . Yii::$app->db->tablePrefix . "'%'";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function optimize()
    {
        foreach ($this->getStatus() as $table) {
            Yii::$app->db->createCommand('OPTIMIZE TABLE ' . $table['Name']);
        }
    }

    public function backup()
    {
        $backupFile = Yii::getAlias('@backend/assets/' . date('YmdHis_') . uniqid() . '.bak');

        foreach ($this->getStatus() as $table) {
            $content = Yii::$app->db->createCommand('SHOW CREATE TABLE `' . $table['Name'] . '`')->queryOne();
            $result = Yii::$app->db->createCommand('SELECT * FROM `' . $table['Name'] . '`')->queryAll();

            $content =  $content['Create Table'] . ";\r\n\r\n";
            $content .= 'LOCK TABLES `' . $table['Name'] . "` WRITE;\r\n";
            $content .= 'INSERT INTO ' . $table['Name'] . ' VALUES ';

            foreach ($result as $row) {
                $content .= '(';

                $row = array_map(function($value) {
                    return is_numeric($value) ? $value : "'" . $value . "'";
                }, $row);

                $content .= implode(',', $row) . '),';
            }

            $content = rtrim($content, ',') . ";\r\n";
            $content .= "UNLOCK TABLES;\r\n\r\n";
            $content = 'DROP TABLE IF EXISTS ' . $table['Name'] . ";\r\n\r\n" . $content;

            file_put_contents($backupFile, $content, FILE_APPEND);
        }
    }

    public function getBackupFiles()
    {
        return glob(Yii::getAlias('@backend/assets/*.bak'));
    }

    public function restore($file)
    {
        if (!is_file($file)) {
            return false;
        }
        $sql = file_get_contents($file);
        return Yii::$app->db->createCommand($sql)->query();
    }

    public function download($file)
    {
        if (!is_file($file)) {
            return false;
        }
        header('Content-type : application/bak');
        header('Content-Disposition: attachment; filename="' . date('Y-m-d-H:i:s') . '.bak"');
        return readfile($file);
    }

    public function format($size)
    {
        if ($size >= 1073741824) {
            $size = round($size / 1073741824 * 100) / 100 . ' GB';
        } elseif ($size >= 1048576) {
            $size = round($size / 1048576 * 100) / 100 . ' MB';
        } elseif ($size >= 1024) {
            $size = round($size / 1024 * 100) / 100 . ' KB';
        } else {
            $size = $size . ' Bytes';
        }
        return $size;
    }
}