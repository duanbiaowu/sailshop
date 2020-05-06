<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\widgets;


use yii\bootstrap\Button;
use yii\helpers\Html;

class LinkPager extends \yii\widgets\LinkPager
{
    /**
     * @var string the CSS class for the active (currently selected) page button.
     */
    public $activePageCssClass = 'current';

    /**
     * Renders the page buttons.
     * @return string the rendering result
     */
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton($firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
        }

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
        }

        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton($lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        return Html::tag('div', implode("\n", $buttons) . $this->renderPageCountText() . $this->renderLocationButton(), $this->options);
    }

    /**
     * Renders a page button.
     * You may override this method to customize the generation of page buttons.
     * @param string $label the text label for the button
     * @param integer $page the page number
     * @param string $class the CSS class for the page button.
     * @param boolean $disabled whether this page button is disabled
     * @param boolean $active whether this page button is active
     * @return string the rendering result
     */
    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => $class === '' ? null : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            return '';
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        return Html::a($label, $this->pagination->createUrl($page), array_merge($linkOptions, $options));
    }

    protected function renderPageCountText()
    {
        return '&nbsp;&nbsp;&nbsp;&nbsp;共' . $this->pagination->pageCount . ' 页&nbsp;&nbsp;&nbsp;&nbsp;';
    }

    protected function getLocationInputId()
    {
        return $this->getId() . '-pagination-location-input';
    }

    protected function getLocationButtonId()
    {
        return $this->getId() . '-pagination-location-btn';
    }

    protected function renderLocationButton()
    {
        $inputId = $this->getLocationInputId();
        $buttonId = $this->getLocationButtonId();
        $html = '跳到第 ' .
            '<input id="' . $inputId .
            '" style="width:24px;text-align:center" value="' .
            ($this->pagination->page + 1) .'" max="' .
            $this->pagination->pageCount .'">  页  ' .
            '<a href="javascript:;" id="' . $buttonId . '">确定</a>';

        $js = "
                $('#" . $buttonId . "').on('click', function() {
                    var page = parseInt($('#" . $inputId . "').val());
                    var lastPage = parseInt($('#" . $inputId . "').attr('max'));
                    if (page > lastPage) {
                        page = lastPage;
                    }
                    var result = window.location.href.match(/page=(\d+)/);
                    if (result == null) {
                        if (page !== 1) {
                            if (window.location.href.match(/\?/) == null) {
                                window.location.href = window.location.href + '?page=' + page;
                            } else {
                                window.location.href = window.location.href + '&page=' + page;
                            }
                        }
                    } else {
                        if (page !== parseInt(result[1])) {
                            window.location.href = window.location.href.replace(/page=(\d+)/, 'page=' + page)
                        }
                    }
                });
            ";
        $js = '<script>' . $js .'</script>';

        return $html . $js;
    }
}