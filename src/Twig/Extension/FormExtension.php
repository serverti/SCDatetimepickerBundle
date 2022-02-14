<?php

/*
 * This file is part of the GenemuFormBundle package.
 *
 * (c) Olivier Chauvel <olivier@generation-multiple.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\STI\DatetimepickerBundle\Twig\Extension;

use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\FormView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode;

/**
 * FormExtension extends Twig with form capabilities.
 *
 * @author Olivier Chauvel <olivier@generation-multiple.com>
 */
class FormExtension extends AbstractExtension
{
    /**
     * This property is public so that it can be accessed directly from compiled
     * templates without having to call a getter, which slightly decreases performance.
     *
     * @var FormRenderer
     */
    public $renderer;

    public function __construct(FormRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('form_javascript', array($this, 'renderJavascript'), array('is_safe' => array('html'))),
            new TwigFunction('form_stylesheet', null, array('node_class' => SearchAndRenderBlockNode::class, 'is_safe' => array('html'))),
        );
    }

    /**
     * Render Function Form Javascript
     *
     * @param FormView $view
     * @param bool $prototype
     *
     * @return string
     */
    public function renderJavascript(FormView $view, $prototype = false)
    {
        $block = $prototype ? 'javascript_prototype' : 'javascript';

        return $this->renderer->searchAndRenderBlock($view, $block);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'collot.twig.extension.form';
    }
}

