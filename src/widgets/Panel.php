<?php

namespace portalium\theme\widgets;

use yii\helpers\Html;

/**
 * ```php
 * // Simple Panel
 * Panel::begin([
 *   'icon' => 'fa fa-bell-o',
 *   'title' => 'Title Panel',
 * ]);
 * echo 'Body portlet';
 * Panel::end();
 */
class Panel extends \yii\bootstrap\Widget {

    /**
     * Types
     */
    const TYPE_DEFAULT = 'panel-default';

    /**
     * @var string The portlet title
     */
    public $title;

    /**
     * @var string The portlet title
     */
    public $footerContent;

    /**
     * @var string The portlet icon
     */
    public $icon;

    /**
     * @var string The portlet type
     * Valid values are 'box', 'solid', ''
     */
    public $type = self::TYPE_DEFAULT;

    /**
     * @var array List of actions, where each element must be specified as a string.
     */
    public $actions = [];

    /**
     * @var string The portlet color
     * Valid values are 'light-blue', 'blue', 'red', 'yellow', 'green', 'purple', 'light-grey', 'grey'
     */
    public $color = '';

    /**
     * @var array The HTML attributes for the widget container
     */
    public $options = [];

    /**
     * @var array The HTML attributes for the widget body container
     */
    public $bodyOptions = [];

    /**
     * @var array The HTML attributes for the widget body container
     */
    public $headerOptions = [];


    /**
     * @var array The HTML attributes for the widget body container
     */
    public $footerOptions = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->options, trim(sprintf('panel %s', $this->type)));
        echo Html::beginTag('div', $this->options);

        $this->_renderHeader();

        Html::addCssClass($this->bodyOptions, 'panel-body');
        echo Html::beginTag('div', $this->bodyOptions);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::endTag('div'); // End panel body

        $this->_renderFooter();
        echo Html::endTag('div'); // End panel div
    }

    /**
     * Renders portlet title
     */
    private function _renderHeader()
    {
        if (false !== $this->title)
        {
            Html::addCssClass($this->headerOptions, 'panel-heading');

            echo Html::beginTag('div', $this->headerOptions);

            echo Html::beginTag('div', ['class' => $this->pushFontColor('panel-title')]);

            if ($this->icon)
            {
                echo Html::tag('i', '', ['class' => $this->icon]);
            }

            echo Html::tag('span', $this->title);

            $this->_renderActions();

            echo Html::endTag('div');

            echo Html::endTag('div');
        }
    }

    /**
     * Renders portlet title
     */
    private function _renderFooter()
    {
        if (false !== $this->footerContent)
        {
            Html::addCssClass($this->footerOptions, 'panel-footer');

            echo Html::beginTag('div', $this->footerOptions);

            echo Html::tag('span', $this->footerContent);

            $this->_renderActions();

            echo Html::endTag('div');
        }
    }

    /**
     * Retrieves font color
     */
    protected function getFontColor()
    {
        if ($this->color)
        {
            return sprintf('font-%s', $this->color);
        }

        return '';
    }

    /**
     * Pushes font color to given string
     */
    protected function pushFontColor($string)
    {
        $color = $this->getFontColor();

        if ($color)
        {
            return sprintf('%s %s', $string, $color);
        }

        return $string;
    }

    /**
     * Renders portlet actions
     */
    private function _renderActions()
    {
        if (!empty($this->actions))
        {
            if(isset($this->actions['header'])){
                echo Html::tag('div', implode("\n", $this->actions['header']), ['class' => 'actions', 'style' => 'float:right;margin-top:-2px;']);
                unset($this->actions['header']);
            } else if(isset($this->actions['footer'])) {
                echo Html::tag('div', implode("\n", $this->actions['footer']), ['class' => 'actions', 'style' => 'float:right;margin-top:-2px;']);
                unset($this->actions['footer']);
            }else{
                echo Html::tag('div', implode("\n", $this->actions), ['class' => 'actions', 'style' => 'float:right;margin-top:-2px;']);
                unset($this->actions);
            }
        }
    }

}

