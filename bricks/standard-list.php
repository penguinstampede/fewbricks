<?php

namespace fewbricks\bricks;

use fewbricks\acf\fields as acf_fields;

/**
 * Class text_and_content
 * @package fewbricks\bricks
 */
class standard_list extends project_brick {

    /**
     * @var string This will be the default label showing up in the editor area for the administrator.
     * It can be overridden by passing an item with the key "label" in the array that is the second argument when
     * creating a brick.
     */
    protected $label = 'List';

    /**
     * This is where all the fields for the brick will be set-
     */
    public function set_fields()
    {

        $this->add_field(new acf_fields\text('Headline', 'headline', '1509052105r'));

        $this->add_repeater((new acf_fields\repeater('Items', 'items', '1509052105s'))
            ->add_sub_field(new acf_fields\text('Item text', 'item_text', '1509052124u')));

    }

    /**
     * @param array $args
     * @return string
     */
    public function get_html($args = [])
    {

        return '';

    }

}