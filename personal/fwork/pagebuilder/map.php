<?php
/**
 * The custom map for Visual Page Builder Plugin
 *
 * @author    masbaf
 * @package   Erosion
 * @version   1.0
 */

$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;

$colors_arr = array(
    __("Default", 'erika') => "color",
    __("Green", 'erika') => "green",
    __("Red", 'erika') => "red",
    __("Orange", 'erika') => "orange",
    __("Yellow", 'erika') => "yellow",
    __("Blue", 'erika') => "blue",
    __("Black", 'erika') => "black",
    __("Gray", 'erika') => "gray",
    __("White", 'erika') => "white",
    __("Color", 'erika') => "color"
);

$animation_list = array(
    __('none','erika') => 'none',
    __('bounce','erika') => 'bounce',
    __('flash','erika') => 'flash',
    __('pulse','erika') => 'pulse',
    __('rubberBand','erika') => 'rubberBand',
    __('shake','erika') => 'shake',
    __('swing','erika') => 'swing',
    __('tada','erika') => 'tada',
    __('wobble','erika') => 'wobble',
    __('bounceIn','erika') => 'bounceIn',
    __('bounceInDown','erika') => 'bounceInDown',
    __('bounceInLeft','erika') => 'bounceInLeft',
    __('bounceInRight','erika') => 'bounceInRight',
    __('bounceInUp','erika') => 'bounceInUp',
    __('bounceOut','erika') => 'bounceOut',
    __('bounceOutDown','erika') => 'bounceOutDown',
    __('bounceOutLeft','erika') => 'bounceOutLeft',
    __('bounceOutRight','erika') => 'bounceOutRight',
    __('bounceOutUp','erika') => 'bounceOutUp',
    __('fadeIn','erika') => 'fadeIn',
    __('fadeInDown','erika') => 'fadeInDown',
    __('fadeInDownBig','erika') => 'fadeInDownBig',
    __('fadeInLeft','erika') => 'fadeInLeft',
    __('fadeInLeftBig','erika') => 'fadeInLeftBig',
    __('fadeInRight','erika') => 'fadeInRight',
    __('fadeInRightBig','erika') => 'fadeInRightBig',
    __('fadeInUp','erika') => 'fadeInUp',
    __('fadeInUpBig','erika') => 'fadeInUpBig',
    __('fadeOut','erika') => 'fadeOut',
    __('fadeOutDown','erika') => 'fadeOutDown',
    __('fadeOutDownBig','erika') => 'fadeOutDownBig',
    __('fadeOutLeft','erika') => 'fadeOutLeft',
    __('fadeOutLeftBig','erika') => 'fadeOutLeftBig',
    __('fadeOutRight','erika') => 'fadeOutRight',
    __('fadeOutRightBig','erika') => 'fadeOutRightBig',
    __('fadeOutUp','erika') => 'fadeOutUp',
    __('fadeOutUpBig','erika') => 'fadeOutUpBig',
    __('flip','erika') => 'flip',
    __('flipInX','erika') => 'flipInX',
    __('flipInY','erika') => 'flipInY',
    __('flipOutX','erika') => 'flipOutX',
    __('flipOutY','erika') => 'flipOutY',
    __('lightSpeedIn','erika') => 'lightSpeedIn',
    __('lightSpeedOut','erika') => 'lightSpeedOut',
    __('rotateIn','erika') => 'rotateIn',
    __('rotateInDownLeft','erika') => 'rotateInDownLeft',
    __('rotateInDownRight','erika') => 'rotateInDownRight',
    __('rotateInUpLeft','erika') => 'rotateInUpLeft',
    __('rotateInUpRight','erika') => 'rotateInUpRight',
    __('rotateOut','erika') => 'rotateOut',
    __('rotateOutDownLeft','erika') => 'rotateOutDownLeft',
    __('rotateOutDownRight','erika') => 'rotateOutDownRight',
    __('rotateOutUpLeft','erika') => 'rotateOutUpLeft',
    __('rotateOutUpRight','erika') => 'rotateOutUpRight',
    __('hinge','erika') => 'hinge',
    __('rollIn','erika') => 'rollIn',
    __('rollOut','erika') => 'rollOut',
    __('zoomIn','erika') => 'zoomIn',
    __('zoomInDown','erika') => 'zoomInDown',
    __('zoomInLeft','erika') => 'zoomInLeft',
    __('zoomInRight','erika') => 'zoomInRight',
    __('zoomInUp','erika') => 'zoomInUp',
    __('zoomOut','erika') => 'zoomOut',
    __('zoomOutDown','erika') => 'zoomOutDown',
    __('zoomOutLeft','erika') => 'zoomOutLeft',
    __('zoomOutRight','erika') => 'zoomOutRight',
    __('zoomOutUp','erika') => 'zoomOutUp'
);

// List all define sidebar
$sidebarposition = array();
$sidebarposition['default-sidebar']      = 'Default Sidebar';
$sidebar_setting = erika_option_data('multi_sidebar');
if ($sidebar_setting) {

    foreach ($sidebar_setting as $sidebar => $name) {
        
        if($name) {
            $sidebarposition[strtolower($name)]  = $name;
        }
    
    }

}


// Used in "Button" and "Call to Action" blocks
$size_arr = array(
    __("Regular size", 'erika') => "normal",
    __("Medium", 'erika') => "medium",
    __("Small", 'erika') => "small",
    __("Large", 'erika') => "large",
);

$target_arr = array(
    __("Same window", 'erika') => "_self",
    __("New window", 'erika') => "_blank"
);

$categories = get_categories(); 
$categories_arr = array();
$categories_arr[] = 'All';
foreach ($categories as $category) {
   $categories_arr[] = $category->cat_name;
}


vc_map(array(
    "name" => __("Row", 'erika'),
    "base" => "vc_row",
    "is_container" => true,
    "show_settings_on_create" => false,
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "nornal",
                __("One Pixel", 'erika') => "onepixel",
                __("No Space", 'erika') => "nospace"
            ),
            "description" => __("Select row style", 'erika')
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Background Images', 'erika'),
            "param_name" => "bg",
        ),
        array(
            "type" => "colorpicker",
            "heading" => __('Background Color', 'erika'),
            "param_name" => "bg_color",
        ),
        array(
            "type" => "colorpicker",
            "heading" => __('Background Mark Color', 'erika'),
            "param_name" => "bg_mark",
        ),
        array(
            "type" => "textfield",
            "heading" => __('Background Mark Opacity', 'erika'),
            "param_name" => "bg_opacity",
            "description" => __("Use number from 0 to 1. Example: 0.6", 'erika'),
        ),
        array(
            "type" => "textfield",
            "heading" => __('Padding', 'erika'),
            "param_name" => "padding",
            "description" => __("You can use px, em, %, etc. or enter just number and it will use pixels. ", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Margin', 'erika'),
            "param_name" => "margin",
            "description" => __("You can use px, em, %, etc. or enter just number and it will use pixels. ", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    ),
    "js_view" => 'VcRowView'
));
vc_map(array(
    "name" => __("Row", 'erika'), //Inner Row
    "base" => "vc_row_inner",
    "content_element" => false,
    "is_container" => true,
    "weight" => 1000,
    "show_settings_on_create" => false,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "nornal",
                __("One Pixel", 'erika') => "onepixel",
                __("No Space", 'erika') => "nospace"
            ),
            "description" => __("Select row style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    ),
    "js_view" => 'VcRowView'
));
vc_map(array(
    "name" => __("Column", 'erika'),
    "base" => "vc_column",
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Animation Style", 'erika'),
            "param_name" => "animation",
            "value" => $animation_list,
            "description" => __("Select animation style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Animation Time", 'erika'),
            "param_name" => "animation_time",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Animation Delay", 'erika'),
            "param_name" => "animation_delay",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Inner Class", 'erika'),
            "param_name" => "inner_class",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Inner Padding", 'erika'),
            "param_name" => "inner_padding",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Inner Margin", 'erika'),
            "param_name" => "inner_margin",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    ),
    "js_view" => 'VcColumnView'
));
vc_map(array(
    "name" => __("Column", 'erika'),
    "base" => "vc_column_inner",
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Inner Class", 'erika'),
            "param_name" => "inner_class",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Inner Padding", 'erika'),
            "param_name" => "inner_padding",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Inner Margin", 'erika'),
            "param_name" => "inner_margin",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    ),
    "js_view" => 'VcColumnView'
));

/* Text Block
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Text Block", 'erika'),
    "base" => "vc_column_text",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am text block. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));


/* Divider
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Divider", 'erika'),
    "base" => "divider",
    "show_settings_on_create" => false,
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Testimonial
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Testimonial", 'erika'),
    "base" => "testimonial",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Name", 'erika'),
            "param_name" => "name"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Company", 'erika'),
            "param_name" => "company"
        ),
        array(
            "type" => "textarea",
            "heading" => __("Content", 'erika'),
            "param_name" => "content",
            "value" => "Edit testimonail content here"
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Avatar", 'erika'),
            "param_name" => "avatar",
            "value" => "",
            "description" => __("Select image from media library.", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Element
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Element", "erika"),
    "base" => "element",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Margin", "erika"),
            "param_name" => "margin"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Padding", "erika"),
            "param_name" => "padding"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Content", "erika"),
            "param_name" => "content",
            "value" => __("<p>Click edit button to change this text.</p>", "erika")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "erika"),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "erika")
        )
    )
));

/* Message box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Message Box", 'erika'),
    "base" => "alert",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Message box type", 'erika'),
            "param_name" => "style",
            "value" => array(
                __('Informational', 'erika') => "info",
                __('Warning', 'erika') => "warning",
                __('Success', 'erika') => "success",
                __('Error', 'erika') => "error"
            ),
            "description" => __("Select message type.", 'erika')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Close", 'erika'),
            "param_name" => "close",
            "value" => array(
                __('Yes', 'erika') => "yes",
                __('No', 'erika') => "no"
            ),
            "description" => __("Select", 'erika')
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Job box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Job Box", 'erika'),
    "base" => "jobbox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "href",
            "heading" => __("Link", 'erika'),
            "param_name" => "link"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link Name", 'erika'),
            "param_name" => "link_name"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Job Content", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Message box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("List", 'erika'),
    "base" => "list",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<ul><li>List Item</li><li>List Item</li><li>List Item</li><li>List Item</li><li>List Item</li></ul>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Single image */
vc_map(array(
    "name" => __("Single Image", 'erika'),
    "base" => "vc_single_image",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget title", 'erika'),
            "param_name" => "title",
            "description" => __("What text use as a widget title. Leave blank if no title is needed.", 'erika')
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Image", 'erika'),
            "param_name" => "image",
            "value" => "",
            "description" => __("Select image from media library.", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Image size", 'erika'),
            "param_name" => "img_size",
            "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", 'erika')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Image alignment", 'erika'),
            "param_name" => "alignment",
            "value" => array(
                __("Align left", 'erika') => "",
                __("Align right", 'erika') => "right",
                __("Align center", 'erika') => "center"
            ),
            "description" => __("Select image alignment.", 'erika')
        ),
        array(
            "type" => 'checkbox',
            "heading" => __("Link to large image?", 'erika'),
            "param_name" => "img_link_large",
            "description" => __("If selected, image will be linked to the bigger image.", 'erika'),
            "value" => Array(
                __("Yes, please", 'erika') => 'yes'
            )
        ),
        array(
            'type' => 'href',
            "heading" => __("Image link", 'erika'),
            "param_name" => "img_link",
            "description" => __("Enter url if you want this image to have link.", 'erika'),
            "dependency" => Array(
                'element' => "img_link_large",
                'is_empty' => true,
                'callback' => 'wpb_single_image_img_link_dependency_callback'
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Link Target", 'erika'),
            "param_name" => "img_link_target",
            "value" => $target_arr,
            "dependency" => Array(
                'element' => "img_link",
                'not_empty' => true
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Tabs
---------------------------------------------------------- */
$tab_id_1 = time() . '-1-' . rand(0, 100);
$tab_id_2 = time() . '-2-' . rand(0, 100);
vc_map(array(
    "name" => __("Tabs", 'erika'),
    "base" => "vc_tabs",
    "show_settings_on_create" => false,
    "is_container" => true,
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "description" => __("Choose your tab style", 'erika'),
            "value" => array(
                __("Normal", 'erika') => 'main',
                __("Left Side", 'erika') => 'left',
                __("Right Side", 'erika') => 'right',
                __("Center", 'erika') => 'center',
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    ),
    "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>',
    'default_content' => '
  [vc_tab title="' . __('Tab 1', 'erika') . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
  [vc_tab title="' . __('Tab 2', 'erika') . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
  ',
    "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
));

vc_map(array(
    "name" => __("Tab", 'erika'),
    "base" => "vc_tab",
    "allowed_container_element" => 'vc_row',
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title",
            "description" => __("Tab title.", 'erika')
        ),
        array(
            "type" => "erika_font_awesome",
            "heading" => __("Icon", 'erika'),
            "param_name" => "icon",
        ),
    ),
    'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
));

/* Accordion block
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Accordion", 'erika'),
    "base" => "vc_accordion",
    "show_settings_on_create" => false,
    "is_container" => true,
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            'admin_label' => true,
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Accordion", 'erika') => "accordion",
                __("Toggle", 'erika') => "toggle"
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    ),
    "custom_markup" => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
<button class="add_tab" title="' . __("Add accordion section", 'erika') . '">' . __("Add accordion section", 'erika') . '</button>
</div>
',
    'default_content' => '
[vc_accordion_tab title="' . __('Section 1', 'erika') . '"][/vc_accordion_tab]
[vc_accordion_tab title="' . __('Section 2', 'erika') . '"][/vc_accordion_tab]
',
    'js_view' => 'VcAccordionView'
));
vc_map(array(
    "name" => __("Accordion Section", 'erika'),
    "base" => "vc_accordion_tab",
    "allowed_container_element" => 'vc_row',
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title",
            "description" => __("Accordion section title.", 'erika')
        ),
        array(
            "type" => 'checkbox',
            "heading" => __("Open", 'erika'),
            "param_name" => "open",
            "description" => __("If selected, the toggle will be open.", 'erika'),
            "value" => Array(
                __("Yes, please", 'erika') => true
            )
        )
    ),
    'js_view' => 'VcAccordionTabView'
));

/* Button
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Button", 'erika'),
    "base" => "button",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            'type' => 'href',
            "heading" => __("URL (Link)", 'erika'),
            "param_name" => "link",
            "description" => __("Button link.", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "content",
            "description" => __("Button Title", 'erika')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Color", 'erika'),
            "param_name" => "color",
            "value" => $colors_arr,
            "description" => __("Button color.", 'erika')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Size", 'erika'),
            "param_name" => "style",
            "value" => $size_arr,
            "description" => __("Button size.", 'erika')
        ),
        array(
            "type" => "erika_font_awesome",
            "heading" => __("Icon", 'erika'),
            "param_name" => "icon"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    ),
    "js_view" => 'VcButtonView'
));

/* Video element
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Video Player", 'erika'),
    "base" => "vc_video",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget title", 'erika'),
            "param_name" => "title",
            "description" => __("What text use as a widget title. Leave blank if no title is needed.", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Video link", 'erika'),
            "param_name" => "link",
            "admin_label" => true,
            "description" => sprintf(__('Link to the video. More about supported formats at %s.', 'erika'), '<a href="http://softmediabd.com" target="_blank">WordPress codex page</a>')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Image Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Heading Title", 'erika'),
    "base" => "heading",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Description", 'erika'),
            "param_name" => "desc"
        ),
        array(
            "type" => "dropdown",
            'admin_label' => true,
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "normal",
                __("Large", 'erika') => "large"
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Google maps element
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Google Maps", 'erika'),
    "base" => "map",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Address", 'erika'),
            "param_name" => "address",
            "description" => __('Enter your map address', 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Map width", 'erika'),
            "param_name" => "w",
            "description" => __('Enter map width in pixels or percent. Example: 100%.', 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Map height", 'erika'),
            "param_name" => "h",
            "description" => __('Enter map height in pixels. Example: 200.', 'erika')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Zoom", 'erika'),
            "param_name" => "zoom",
            "value" => array(
                __("14 - Default", 'erika') => 14,
                1,
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9,
                10,
                11,
                12,
                13,
                15,
                16,
                17,
                18,
                19,
                20
            )
        ),
        array(
            "type" => 'checkbox',
            "heading" => __("Show Marker", 'erika'),
            "param_name" => "marker",
            "description" => __("If selected, the marker will be show.", 'erika'),
            "value" => Array(
                __("Yes, please", 'erika') => true
            )
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Custom Market Image", 'erika'),
            "param_name" => "markerimage",
            "description" => __("Upload marker image", 'erika'),
        )
    )
));

/* Raw HTML
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Raw HTML", 'erika'),
    "base" => "vc_raw_html",
    "category" => __('Structure', 'erika'),
    "wrapper_class" => "clearfix",
    "params" => array(
        array(
            "type" => "textarea_raw_html",
            "holder" => "div",
            "heading" => __("Raw HTML", 'erika'),
            "param_name" => "content",
            "value" => base64_encode("<p>I am raw html block.<br/>Click edit button to change this html</p>"),
            "description" => __("Enter your HTML content.", 'erika')
        )
    )
));

/* Raw JS
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Raw JS", 'erika'),
    "base" => "vc_raw_js",
    "category" => __('Structure', 'erika'),
    "wrapper_class" => "clearfix",
    "params" => array(
        array(
            "type" => "textarea_raw_html",
            "holder" => "div",
            "heading" => __("Raw js", 'erika'),
            "param_name" => "content",
            "value" => __(base64_encode("<script type='text/javascript'> alert('Enter your js here!'); </script>"), 'erika'),
            "description" => __("Enter your JS code.", 'erika')
        )
    )
));

/* Progress Bar
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Progress Bar", 'erika'),
    "base" => "skillbar",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title",
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Percent", 'erika'),
            "param_name" => "percent",
            "admin_label" => true
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Bar custom color", 'erika'),
            "param_name" => "color",
            "description" => __("Select custom background color for bars.", 'erika'),
            "dependency" => Array(
                'element' => "bgcolor",
                'value' => array(
                    'custom'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "nornal",
                __("Strip", 'erika') => "progress-striped",
                __("Active", 'erika') => "progress-striped active"
            ),
            "description" => __("Select skillbar stype.", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        )
    )
));

/* Service Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Service Box", 'erika'),
    "base" => "servicebox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "erika_font_awesome",
            "heading" => __("Icon Class", 'erika'),
            "param_name" => "icon"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            'type' => 'href',
            "heading" => __("Link", 'erika'),
            "param_name" => "link"
        ),
         array(
            "type" => "textfield",
            "heading" => __("Link Name", 'erika'),
            "param_name" => "link_name"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Icon Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Icon Box", 'erika'),
    "base" => "iconbox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "nornal",
                __("Alt", 'erika') => "alt",
                __("Top", 'erika') => "top"
            ),
            "description" => __("Select iconbox style.", 'erika')
        ),
        array(
            "type" => "erika_font_awesome",
            "heading" => __("Icon", 'erika'),
            "param_name" => "icon"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Pro Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Pro Box", 'erika'),
    "base" => "probox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Image", 'erika'),
            "param_name" => "img",
            "value" => "",
            "description" => __("Select image from media library.", 'erika')
        ),
        array(
            'type' => 'href',
            "heading" => __("Link", 'erika'),
            "param_name" => "link"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Image Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Image Box", 'erika'),
    "base" => "imagebox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Image", 'erika'),
            "param_name" => "img",
            "value" => "",
            "description" => __("Select image from media library.", 'erika')
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Team
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Member", 'erika'),
    "base" => "member",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Name", 'erika'),
            "param_name" => "name"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Position", 'erika'),
            "param_name" => "position"
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Avatar", 'erika'),
            "param_name" => "avatar",
            "value" => "",
            "description" => __("Select image from media library.", 'erika')
        ),
        array(
            'type' => 'href',
            "heading" => __("Facebook", 'erika'),
            "param_name" => "facebook"
        ),
        array(
            'type' => 'href',
            "heading" => __("Twitter", 'erika'),
            "param_name" => "twitter"
        ),
        array(
            'type' => 'href',
            "heading" => __("Google Plus", 'erika'),
            "param_name" => "googleplus"
        ),
        array(
            'type' => 'href',
            "heading" => __("LinkedIn", 'erika'),
            "param_name" => "linkedin"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Callout
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Call to action", 'erika'),
    "base" => "callout",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "nornal",
                __("Action", 'erika') => "action",
                __("Strip", 'erika') => "strip"
            ),
            "description" => __("Select call to action style.", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textarea",
            "heading" => __("Description", 'erika'),
            "param_name" => "desc"
        ),
        array(
            'type' => 'href',
            "heading" => __("Button URL", 'erika'),
            "param_name" => "link"
        ),
        array(
            'type' => 'textfield',
            "heading" => __("Button Name", 'erika'),
            "param_name" => "button_name"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Button Color", 'erika'),
            "param_name" => "button_color",
            "value" => $colors_arr,
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Button Style", 'erika'),
            "param_name" => "button_style",
            "value" => array(
                __("Normal", 'erika') => "nornal",
                __("Border", 'erika') => "stroke",
            ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Pricing Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Pricing Box", 'erika'),
    "base" => "pricingbox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textarea",
            "heading" => __("Description", 'erika'),
            "param_name" => "desc"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Price", 'erika'),
            "param_name" => "price"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Currency", 'erika'),
            "param_name" => "currency"
        ),
        array(
            'type' => 'href',
            "heading" => __("Button URL", 'erika'),
            "param_name" => "button_url"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Button Name", 'erika'),
            "param_name" => "button_name"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<ul><li>Pricing Feature 1</li><li>Pricing Feature 2</li><li>Pricing Feature 3</li><li>Pricing Feature 4</li></ul>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Pricing Table
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Pricing Table", 'erika'),
    "base" => "pricingtable",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "pad",
                __("Information", 'erika') => "slab",
                __("Feature", 'erika') => "pad border"
            ),
            "description" => __("Select pricing style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Description", 'erika'),
            "param_name" => "desc"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Price", 'erika'),
            "param_name" => "price"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Currency", 'erika'),
            "param_name" => "currency"
        ),
        array(
           'type' => 'href',
            "heading" => __("Button URL", 'erika'),
            "param_name" => "button_url"
        ),
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __("<p>I am message box. Click edit button to change this text.</p>", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Color Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Color Box", 'erika'),
    "base" => "colorbox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Intro", 'erika') => "heading",
                __("Information", 'erika') => "information",
            ),
            "description" => __("Select colorbox style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textarea",
            "heading" => __("Description", 'erika'),
            "param_name" => "desc"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link", 'erika'),
            "param_name" => "link"
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Background Images", 'erika'),
            "param_name" => "img",
            "value" => "",
            "description" => __("Select image from media library.", 'erika')
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Background Mark Color', 'wpb' ),
            'param_name' => 'bg_mark',
            'description' => __( 'Select your background color', 'wpb' ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Background Mark Color Opacity", 'erika'),
            "param_name" => "bg_opacity"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Step Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Step Box", 'erika'),
    "base" => "stepbox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Number", 'erika'),
            "param_name" => "number"
        ),
        array(
            "type" => "textarea",
            "heading" => __("Description", 'erika'),
            "param_name" => "desc"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("White", 'erika') => "white",
                __("Gray", 'erika') => "gray",
            ),
            "description" => __("Select colorbox style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Count Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Counter Box", 'erika'),
    "base" => "counterbox",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "erika_font_awesome",
            "heading" => __("Icon", 'erika'),
            "param_name" => "icon"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", 'erika'),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Number", 'erika'),
            "param_name" => "number"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("White", 'erika') => "white",
                __("Gray", 'erika') => "gray",
            ),
            "description" => __("Select counterbox style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Chart
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Chart", 'erika'),
    "base" => "chart",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Percent", 'erika'),
            "param_name" => "percent"
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Background Color', 'wpb' ),
            'param_name' => 'bgcolor',
            'description' => __( 'Select your background color', 'wpb' ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => __( 'Bar Color', 'wpb' ),
            'param_name' => 'barcolor',
            'description' => __( 'Select bar color of chart', 'wpb' ),
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));


/* Testimonial Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Testimonial Group", 'erika'),
    "base" => "testimonial_group_area",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __('[testimonial_group]<br>[testimonial_item avatar="" name="" position=""][/testimonial_item]<br>[/testimonial_group]', 'erika')
        ),
    )
));

/* Testimonial Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Carousel", 'erika'),
    "base" => "carousel",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Carousel Content", 'erika'),
            "param_name" => "content",
            "value" => __('[carousel_item]Your carousel content[/carousel_item]', 'erika')
        ),
    )
));

/* Testimonial Box
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Timeline", 'erika'),
    "base" => "timeline",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __('[timeline-item]Your timeline content[/timeline-item]', 'erika')
        ),
    )
));

/* Posts Lists
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Posts List", 'erika'),
    "base" => "posts",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", 'erika'),
            "param_name" => "style",
            "value" => array(
                __("Normal", 'erika') => "normal",
                __("Timeline", 'erika') => "timeline",
            ),
            "description" => __("Select colorbox style", 'erika')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Columns", 'erika'),
            "param_name" => "column",
            "value" => array(
                __("4 Columns", 'erika') => "3",
                __("3 Columns", 'erika') => "4",
            ),
            "description" => __("Select colorbox style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Category", 'erika'),
            "param_name" => "cat"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Tags", 'erika'),
            "param_name" => "tag"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Number", 'erika'),
            "param_name" => "number"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Portfolio
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Portfolio", 'erika'),
    "base" => "portfolio",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Category", 'erika'),
            "param_name" => "cat"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Tags", 'erika'),
            "param_name" => "tag"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Number", 'erika'),
            "param_name" => "number"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Columns", 'erika'),
            "param_name" => "column",
            "value" => array(
                __("4 Columns", 'erika') => "3",
                __("3 Columns", 'erika') => "4",
            ),
            "description" => __("Select colorbox style", 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/* Promo Slider
---------------------------------------------------------- */
vc_map(array(
    "name" => __("Promo Slider", 'erika'),
    "base" => "slider",
    "wrapper_class" => "clearfix",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "messagebox_text",
            "heading" => __("Message text", 'erika'),
            "param_name" => "content",
            "value" => __('[slider-item]Your timeline content[/slider-item]<br>[slider-item]Your timeline content[/slider-item]', 'erika')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra Class Name", 'erika'),
            "param_name" => "class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
        ),
    )
));

/**
 * Sidebar
 */
vc_map(array(
    "name" => __("Sidebar", 'erika'),
    "base" => "sidebar_area",
    "class" => "",
    "category" => __('Content', 'erika'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Name", 'erika'),
            "param_name" => "name",
            'value' => $sidebarposition,
            "admin_label" => true
        ),
    )
));

/* Support for 3rd Party plugins
---------------------------------------------------------- */

include_once(ABSPATH . 'wp-admin/includes/plugin.php'); // Require plugin.php to use is_plugin_active() below

// Contact LayerSlider plugin

if (is_plugin_active('LayerSlider/layerslider.php')) {
    global $wpdb;
    $ls            = $wpdb->get_results("
    SELECT id, name, date_c
    FROM " . $wpdb->prefix . "layerslider
    WHERE flag_hidden = '0' AND flag_deleted = '0'
    ORDER BY date_c ASC LIMIT 999
    ");
    $layer_sliders = array();
    if ($ls) {
        foreach ($ls as $slider) {
            $layer_sliders[$slider->name] = $slider->id;
        }
    } else {
        $layer_sliders["No sliders found"] = 0;
    }
    vc_map(array(
        "base" => "layerslider_vc",
        "name" => __("Layer Slider", 'erika'),
        "icon" => "icon-wpb-layerslider",
        "category" => __('Content', 'erika'),
        "description" => __('Place LayerSlider', 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Widget title", 'erika'),
                "param_name" => "title",
                "description" => __("What text use as a widget title. Leave blank if no title is needed.", 'erika')
            ),
            array(
                "type" => "dropdown",
                "heading" => __("LayerSlider ID", 'erika'),
                "param_name" => "id",
                "admin_label" => true,
                "value" => $layer_sliders,
                "description" => __("Select your LayerSlider.", 'erika')
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'erika'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
            )
        )
    ));
} // if layer slider plugin active

// Contact revslider plugin
if (is_plugin_active('revslider/revslider.php')) {
    global $wpdb;
    $rs         = $wpdb->get_results("
    SELECT id, title, alias
    FROM " . $wpdb->prefix . "revslider_sliders
    ORDER BY id ASC LIMIT 999
    ");
    $revsliders = array();
    if ($rs) {
        foreach ($rs as $slider) {
            $revsliders[$slider->title] = $slider->alias;
        }
    } else {
        $revsliders["No sliders found"] = 0;
    }
    vc_map(array(
        "base" => "rev_slider_vc",
        "name" => __("Revolution Slider", 'erika'),
        "category" => __('Content', 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Widget title", 'erika'),
                "param_name" => "title",
                "description" => __("What text use as a widget title. Leave blank if no title is needed.", 'erika')
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Revolution Slider", 'erika'),
                "param_name" => "alias",
                "admin_label" => true,
                "value" => $revsliders,
                "description" => __("Select your Revolution Slider.", 'erika')
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'erika'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'erika')
            )
        )
    ));
} // if revslider plugin active

// Contact wooocommerce plugin

if ( in_array( 'wooocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
    vc_map(array(
        "name" => __("Recent Product", 'erika'),
        "base" => "recent_products",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Per Page", 'erika'),
                "param_name" => "per_page",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order", 'erika'),
                "param_name" => "order",
                "value" => array(
                    __("Desc", 'erika') => 'desc',
                    __("ASC", 'erika') => 'asc',
                ),
            ),
        )
    ));

    vc_map(array(
        "name" => __("Feature Product", 'erika'),
        "base" => "featured_products",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Per Page", 'erika'),
                "param_name" => "per_page",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order", 'erika'),
                "param_name" => "order",
                "value" => array(
                    __("Desc", 'erika') => 'desc',
                    __("ASC", 'erika') => 'asc',
                ),
            ),
        )
    ));

    vc_map(array(
        "name" => __("Product", 'erika'),
        "base" => "products",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order", 'erika'),
                "param_name" => "order",
                "value" => array(
                    __("Desc", 'erika') => 'desc',
                    __("ASC", 'erika') => 'asc',
                ),
            ),
        )
    ));

    vc_map(array(
        "name" => __("Product Category", 'erika'),
        "base" => "product_category",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Per Page", 'erika'),
                "param_name" => "per_page",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order", 'erika'),
                "param_name" => "order",
                "value" => array(
                    __("Desc", 'erika') => 'desc',
                    __("ASC", 'erika') => 'asc',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Category", 'erika'),
                "param_name" => "category",
            ),
        )
    ));

    vc_map(array(
        "name" => __("Product Categories", 'erika'),
        "base" => "product_categories",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Number", 'erika'),
                "param_name" => "number",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Parent", 'erika'),
                "param_name" => "parent",
            ),
            array(
                "type" => "textfield",
                "heading" => __("IDs", 'erika'),
                "param_name" => "ids",
            ),
        )
    ));

    vc_map(array(
        "name" => __("Sale Product", 'erika'),
        "base" => "sale_products",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Per Page", 'erika'),
                "param_name" => "per_page",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
        )
    ));

    vc_map(array(
        "name" => __("Best Selling Products", 'erika'),
        "base" => "best_selling_products",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Per Page", 'erika'),
                "param_name" => "per_page",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
        )
    ));

    vc_map(array(
        "name" => __("Top Rated Product", 'erika'),
        "base" => "top_rated_products",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Per Page", 'erika'),
                "param_name" => "per_page",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order", 'erika'),
                "param_name" => "order",
                "value" => array(
                    __("Desc", 'erika') => 'desc',
                    __("ASC", 'erika') => 'asc',
                ),
            ),
        )
    ));

    vc_map(array(
        "name" => __("Related Products", 'erika'),
        "base" => "related_products",
        "category" => __("WooCommerce", 'erika'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Per Page", 'erika'),
                "param_name" => "per_page",
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Column", 'erika'),
                "param_name" => "columns",
                "value" => array(
                    __("3 Columns", 'erika') => '3',
                    __("4 Columns", 'erika') => '4'
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Order by", 'erika'),
                "param_name" => "orderby",
                "value" => array(
                    __("None", 'erika') => 'none',
                    __("ID", 'erika') => 'id',
                    __("Title", 'erika') => 'title',
                    __("Name", 'erika') => 'name',
                    __("Date", 'erika') => 'date',
                ),
            ),
        )
    ));
}
// Contact Gravity form plugin
if (is_plugin_active('gravityforms/gravityforms.php')) {
    $gravity_forms_array[__("No Gravity forms found.", 'erika')] = '';
    if (class_exists('RGFormsModel')) {
        $gravity_forms = RGFormsModel::get_forms(1, "title");
        if ($gravity_forms) {
            $gravity_forms_array = array(
                __("Select a form to display.", 'erika') => ''
            );
            foreach ($gravity_forms as $gravity_form) {
                $gravity_forms_array[$gravity_form->title] = $gravity_form->id;
            }
        }
    }
    vc_map(array(
        "name" => __("Gravity Form", 'erika'),
        "base" => "gravityform",
        "icon" => "icon-wpb-vc_gravityform",
        "category" => __("Content", 'erika'),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Form", 'erika'),
                "param_name" => "id",
                "value" => $gravity_forms_array,
                "description" => __("Select a form to add it to your post or page.", 'erika'),
                "admin_label" => true
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Display Form Title", 'erika'),
                "param_name" => "title",
                "value" => array(
                    __("No", 'erika') => 'false',
                    __("Yes", 'erika') => 'true'
                ),
                "description" => __("Would you like to display the forms title?", 'erika'),
                "dependency" => Array(
                    'element' => "id",
                    'not_empty' => true
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Display Form Description", 'erika'),
                "param_name" => "description",
                "value" => array(
                    __("No", 'erika') => 'false',
                    __("Yes", 'erika') => 'true'
                ),
                "description" => __("Would you like to display the forms description?", 'erika'),
                "dependency" => Array(
                    'element' => "id",
                    'not_empty' => true
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Enable AJAX?", 'erika'),
                "param_name" => "ajax",
                "value" => array(
                    __("No", 'erika') => 'false',
                    __("Yes", 'erika') => 'true'
                ),
                "description" => __("Enable AJAX submission?", 'erika'),
                "dependency" => Array(
                    'element' => "id",
                    'not_empty' => true
                )
            ),
            array(
                "type" => "textfield",
                "heading" => __("Tab Index", 'erika'),
                "param_name" => "tabindex",
                "description" => __("(Optional) Specify the starting tab index for the fields of this form. Leave blank if you're not sure what this is.", 'erika'),
                "dependency" => Array(
                    'element' => "id",
                    'not_empty' => true
                )
            )
        )
    ));
} // if gravityforms active