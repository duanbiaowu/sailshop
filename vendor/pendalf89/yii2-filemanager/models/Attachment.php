<?php

namespace pendalf89\filemanager\models;

use Yii;
use yii\base\InvalidValueException;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Inflector;
use pendalf89\filemanager\Module;
use pendalf89\filemanager\models\Owners;
use Imagine\Image\ImageInterface;
use yii\base\InvalidParamException;

/**
 * This is the model class for table "attachment".
 *
 * @property integer $id
 * @property string $filename
 * @property integer $year
 * @property integer $month
 * @property integer $day
 * @property string $size
 * @property string $path
 * @property string $thumbs
 */
class Attachment extends ActiveRecord
{
    public $file;

    public static $imageFileTypes = ['image/gif', 'image/jpeg', 'image/png'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['filename', 'year', 'month', 'day', 'size', 'path'], 'required'],
//            [['year', 'month', 'day', 'size'], 'integer'],
//            [['filename'], 'string', 'max' => 255],
//            [['size', 'path'], 'string', 'max' => 64],
//            [['thumbs'], 'string', 'max' => 1024],
//            [['file'], 'file', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('main', 'ID'),
            'filename' => Module::t('main', 'filename'),
            'type' => Module::t('main', 'Type'),
            'url' => Module::t('main', 'Url'),
            'alt' => Module::t('main', 'Alt attribute'),
            'size' => Module::t('main', 'Size'),
            'description' => Module::t('main', 'Description'),
            'thumbs' => Module::t('main', 'Thumbnails'),
            'created_at' => Module::t('main', 'Created'),
            'updated_at' => Module::t('main', 'Updated'),
        ];
    }

    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'timestamp' => [
//                'class' => TimestampBehavior::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
//                ],
//            ]
//        ];
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwners()
    {
        return $this->hasMany(Owners::className(), ['mediafile_id' => 'id']);
    }

//    public function beforeDelete()
//    {
//        if (parent::beforeDelete()) {
//            var_dump($this->owners);exit;
//            foreach ($this->owners as $owner) {
//                $owner->delete();
//            }
//
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function saveUploadedFile()
    {
        $this->year = date('Y');
        $this->month = date('m');
        $this->day = date('d');

        $routes = Yii::$app->controller->module->routes;
        $relativePath = $routes['uploadPath'] . $this->year . $this->month . '/' . $this->day . '/';
        $absolutePath = Yii::getAlias($routes['basePath']) . $relativePath;

        if (!is_dir($absolutePath)) {
            mkdir($absolutePath, 0770, true);
        }

        $this->file = UploadedFile::getInstance($this, 'file');
        if (!$this->isImage()) {
            throw new InvalidValueException(Module::t('main', 'file_type_invalid'));
        }

        $this->filename = str_replace('.', '', microtime(true)) . '_' . uniqid() . '.png';
        if (!$this->file->saveAs($absolutePath . $this->filename)) {
            throw new InvalidParamException(Module::t('main', 'file_upload_failed'));
        }

        $this->size = $this->file->size;
        $this->path = $relativePath . $this->filename;

//        $this->filename = $filename;
//        $this->size = $this->file->size;
//        $this->path = $structure . $filename;

        return $this->save();
    }

    /**
     * Create thumbs for this image
     *
     * @param array $routes see routes in module config
     * @param array $presets thumbs presets. See in module config
     * @return bool
     */
    public function createThumbs(array $routes, array $presets)
    {
        $thumbs = [];
        $basePath = $basePath = Yii::getAlias($routes['basePath']);
        $originalFile = pathinfo($this->url);
        $dirname = $originalFile['dirname'];
        $filename = $originalFile['filename'];
        $extension = $originalFile['extension'];

        Image::$driver = [Image::DRIVER_GD2, Image::DRIVER_GMAGICK, Image::DRIVER_IMAGICK];

        foreach ($presets as $alias => $preset) {
            $width = $preset['size'][0];
            $height = $preset['size'][1];
            $mode = (isset($preset['mode']) ? $preset['mode'] : ImageInterface::THUMBNAIL_OUTBOUND);

            $thumbUrl = "$dirname/$filename-{$width}x{$height}.$extension";

            Image::thumbnail("$basePath/{$this->url}", $width, $height, $mode)->save("$basePath/$thumbUrl");

            $thumbs[$alias] = $thumbUrl;
        }

        $this->thumbs = serialize($thumbs);
        $this->detachBehavior('timestamp');

        // create default thumbnail
        $this->createDefaultThumb($routes);

        return $this->save();
    }

    /**
     * Create default thumbnail
     *
     * @param array $routes see routes in module config
     */
    public function createDefaultThumb(array $routes)
    {
        $originalFile = pathinfo($this->url);
        $dirname = $originalFile['dirname'];
        $filename = $originalFile['filename'];
        $extension = $originalFile['extension'];

        Image::$driver = [Image::DRIVER_GD2, Image::DRIVER_GMAGICK, Image::DRIVER_IMAGICK];

        $size = Module::getDefaultThumbSize();
        $width = $size[0];
        $height = $size[1];
        $thumbUrl = "$dirname/$filename-{$width}x{$height}.$extension";
        $basePath = Yii::getAlias($routes['basePath']);
        Image::thumbnail("$basePath/{$this->url}", $width, $height)->save("$basePath/$thumbUrl");
    }

    /**
     * Add owner to mediafiles table
     *
     * @param int $owner_id owner id
     * @param string $owner owner identification name
     * @param string $owner_attribute owner identification attribute
     * @return bool save result
     */
    public function addOwner($owner_id, $owner, $owner_attribute)
    {
        $mediafiles = new Owners();
        $mediafiles->mediafile_id = $this->id;
        $mediafiles->owner = $owner;
        $mediafiles->owner_id = $owner_id;
        $mediafiles->owner_attribute = $owner_attribute;

        return $mediafiles->save();
    }

    /**
     * Remove this mediafile owner
     *
     * @param int $owner_id owner id
     * @param string $owner owner identification name
     * @param string $owner_attribute owner identification attribute
     * @return bool delete result
     */
    public static function removeOwner($owner_id, $owner, $owner_attribute)
    {
        $mediafiles = Owners::findOne([
            'owner_id' => $owner_id,
            'owner' => $owner,
            'owner_attribute' => $owner_attribute,
        ]);

        if ($mediafiles) {
            return $mediafiles->delete();
        }

        return false;
    }

    /**
     * @return bool if type of this media file is image, return true;
     */
    public function isImage()
    {
        if ($this->file) {
            return in_array($this->file->type, self::$imageFileTypes);
        }
        return false;
    }

    /**
     * @param $baseUrl
     * @return string default thumbnail for image
     */
    public function getDefaultThumbUrl($baseUrl = '')
    {
        if ($this->isImage()) {
            $size = Module::getDefaultThumbSize();
            $originalFile = pathinfo($this->path);
            $dirname = $originalFile['dirname'];
            $filename = $originalFile['filename'];
            $extension = $originalFile['extension'];
            $width = $size[0];
            $height = $size[1];
            return "$dirname/$filename-{$width}x{$height}.$extension";
        }
        return "$baseUrl/images/file.png";
    }
    /**
     * @param $baseUrl
     * @return string default thumbnail for image
     */
    public function getDefaultUploadThumbUrl($baseUrl = '')
    {
        $size = Module::getDefaultThumbSize();
        $originalFile = pathinfo($this->url);
        $dirname = $originalFile['dirname'];
        $filename = $originalFile['filename'];
        $extension = $originalFile['extension'];
        $width = $size[0];
        $height = $size[1];
        return "$dirname/$filename-{$width}x{$height}.$extension";
    }
    /**
     * @return array thumbnails
     */
    public function getThumbs()
    {
        return unserialize($this->thumbs);
    }

    /**
     * @param string $alias thumb alias
     * @return string thumb url
     */
    public function getThumbUrl($alias)
    {
        $thumbs = $this->getThumbs();

        if ($alias === 'original') {
            return $this->path;
        }

        return !empty($thumbs[$alias]) ? $thumbs[$alias] : '';
    }

    /**
     * Thumbnail image html tag
     *
     * @param string $alias thumbnail alias
     * @param array $options html options
     * @return string Html image tag
     */
    public function getThumbImage($alias, $options=[])
    {
        $url = $this->getThumbUrl($alias);

        if (empty($url)) {
            return '';
        }

        if (empty($options['alt'])) {
            $options['alt'] = $this->alt;
        }

        return Html::img($url, $options);
    }

    /**
     * @param Module $module
     * @return array images list
     */
    public function getImagesList(Module $module)
    {
        $thumbs = $this->getThumbs();
        $list = [];
        $originalImageSize = $this->getOriginalImageSize($module->routes);
        $list[$this->path] = Module::t('main', 'Original') . ' ' . $originalImageSize;

        if ($thumbs) {
            foreach ($thumbs as $alias => $url) {
                $preset = $module->thumbs[$alias];
                $list[$url] = $preset['name'] . ' ' . $preset['size'][0] . ' × ' . $preset['size'][1];
            }
        }
        return $list;
    }

    /**
     * Delete thumbnails for current image
     * @param array $routes see routes in module config
     */
    public function deleteThumbs(array $routes)
    {
        $basePath = Yii::getAlias($routes['basePath']);

        foreach ($this->getThumbs() as $thumbUrl) {
            unlink("$basePath/$thumbUrl");
        }

        unlink("$basePath/{$this->getDefaultThumbUrl()}");
    }

    public function deleteFile()
    {
        return unlink(Yii::getAlias(Yii::$app->controller->module->routes['basePath']) . $this->path);
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = self::find()->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

    /**
     * @return int last changes timestamp
     */
    public function getLastChanges()
    {
        return !empty($this->updated_at) ? $this->updated_at : $this->created_at;
    }

    /**
     * This method wrap getimagesize() function
     * @param array $routes see routes in module config
     * @param string $delimiter delimiter between width and height
     * @return string image size like '1366x768'
     */
    public function getOriginalImageSize(array $routes, $delimiter = ' × ')
    {
        $imageSizes = $this->getOriginalImageSizes($routes);
        return "$imageSizes[0]$delimiter$imageSizes[1]";
    }

    /**
     * This method wrap getimagesize() function
     * @param array $routes see routes in module config
     * @return array
     */
    public function getOriginalImageSizes(array $routes)
    {
        $basePath = Yii::getAlias($routes['basePath']);
        return getimagesize("$basePath/{$this->path}");
    }

    /**
     * @return string file size
     */
    public function getFileSize()
    {
        Yii::$app->formatter->sizeFormatBase = 1000;
        return Yii::$app->formatter->asShortSize($this->size, 0);
    }

    /**
     * Find model by url
     *
     * @param $url
     * @return static
     */
    public static function findByUrl($url)
    {
        return self::findOne(['url' => $url]);
    }

    /**
     * Search models by file types
     * @param array $types file types
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findByTypes(array $types)
    {
        return self::find()->filterWhere(['in', 'type', $types])->all();
    }

    public static function loadOneByOwner($owner, $owner_id, $owner_attribute)
    {
        $owner = Owners::findOne([
            'owner' => $owner,
            'owner_id' => $owner_id,
            'owner_attribute' => $owner_attribute,
        ]);

        if ($owner) {
            return $owner->mediafile;
        }

        return false;
    }
}
