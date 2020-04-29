<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 12/6/19
 * Time: 9:27 PM
 */

namespace app\components\materialize;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    /**
     * @var string the name of the breadcrumb container tag.
     */
    public $tag = 'div';
    /**
     * @var array the HTML attributes for the breadcrumb container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'col s12'];
    /**
     * @var string the template used to render each inactive item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each inactive item.
     */
    public $itemTemplate = "{link}\n";
    /**
     * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each active item.
     */
    public $activeItemTemplate = "{link}\n";

    /**
     * Renders the widget.
     */
    public function run()
    {
        if ( empty($this->links) ) {
            return;
        }
        $links = [];
        if ( $this->homeLink === null ) {
            $links[] = $this->renderItem([
                'label' => Yii::t('yii', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ( $this->homeLink !== false ) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ( $this->links as $link ) {
            if ( !is_array($link) ) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }

        echo Html::tag('nav',
            Html::tag('div',
                Html::tag($this->tag, implode('', $links), $this->options),
                ['class' => 'nav-wrapper']
            ),
            ['class' => 'transparent']
        );
    }

    /**
     * Renders a single breadcrumb item.
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template the template to be used to rendered the link. The token "{link}" will be replaced by the link.
     * @return string the rendering result
     * @throws InvalidConfigException if `$link` does not have "label" element.
     */
    protected function renderItem($link, $template)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
        if ( array_key_exists('label', $link) ) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if ( isset( $link['template'] ) ) {
            $template = $link['template'];
        }
        if ( isset( $link['url'] ) ) {
            $options = $link;

            // add 'breadcrumb' class to link
            $options['class'] = 'breadcrumb';

            unset($options['template'], $options['label'], $options['url']);
            $link = Html::a($label, $link['url'], $options);
        } else {
//            $link = $label;
            $link = Html::a($label, '#!', ['class' => 'breadcrumb']);
        }

        return strtr($template, ['{link}' =>  $link]);
    }
}