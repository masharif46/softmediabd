<?php

/*Row*/
function vc_theme_vc_row($atts, $content = null) {

  extract(shortcode_atts(array(
    'class' => '',
    'margin' => '',
    'padding' => '',
    'bg' => '',
    'bg_color' => '',
    'bg_mark' => '',
    'bg_repeat' => 'cover',
    'bg_opacity' => '1',
    'style' => 'normal'
    ), $atts));

  $out = $before_wrap = $after_wrap = '';


  global $post;

    if(erika_meta_data('_erika_radio_sidebar_layout') == 'fullwidth' && erika_meta_data('_erika_radio_force_full_width') == 'on' && is_page() ){
      $before_wrap = '<div class="container">';
      $after_wrap = '</div>';
    }

    $bg_out = $bg_color_out = $bg_repeat_out = $bg_opacity_out = $m_out = $p_out = $bg_mark_out = '';

    if($bg){
      $bg_out = ' data-bg="'.wp_get_attachment_url($bg).'"';
    }
    if($bg_color){
      $bg_color_out = ' data-bgcolor="'.$bg_color.'"';
    }
    if($bg_mark){
      $bg_mark_out = ' data-bgmark="'.erika_hex2rgba($bg_mark,$bg_opacity).'"';
    }
    
    if($margin){
      $m_out = ' data-margin="'.$margin.'"';
    }

    if($padding){
      $p_out = ' data-padding="'.$padding.'"';
    }

  $out .= '<div class="section '.$bg_repeat.' '.$class.'"'.$m_out.$p_out.$bg_out.$bg_color_out.$bg_mark_out.'>';
  $out .= $before_wrap;
  $out .= '<div class="row '.$style.'">';
  $out .= wpb_js_remove_wpautop($content);
  $out .= '</div>';
  $out .= $after_wrap;
  $out .= '</div>';

  return $out;

}

/*Row Inner*/
function vc_theme_vc_row_inner($atts, $content = null) {

  extract(shortcode_atts(array(
    'el_class' => '',
    'style' => 'normal',
  ), $atts));

  $el_class = $el_class? ' '.$el_class:'';

  $output = '<div class="row clearfix'.$el_class.' '.$style.'">';
  $output .= wpb_js_remove_wpautop($content);
  $output .= '</div>';

  return $output;
}

/*Column*/
function vc_theme_vc_column($atts, $content = null) {

  $style = '';

  extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'animation' => 'none',
    'animation_time' => '',
    'animation_delay' => '',
    'inner_class' => '',
    'inner_margin' => '',
    'inner_padding' => '',
  ), $atts));
  
  $a_out = $animation != 'none' ? ' data-wow-duration="'.$animation_time.'s" data-wow-delay="'.$animation_delay.'s"' : '';
  

  $width = wpb_translateColumnWidthToSpan($width);
  $el_class = $el_class? ' '.$el_class:'';
  $animation_cl = $animation != 'none' ? ' wow '.$animation : '';
  $class = $width.$el_class.$animation_cl;

  $m_out = $p_out = '';

  if($inner_margin)
  $m_out = ' data-margin="'.$inner_margin.'"';

  if($inner_padding)
  $p_out = ' data-padding="'.$inner_padding.'"';

  $output = '<div class="'.$class.'"'.$a_out.'>';
  $output .= '<div class="element '.$inner_class.'" '.$m_out.' '.$p_out.'>';
  $output .= wpb_js_remove_wpautop($content);
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}

/*Column Inner*/
function vc_theme_vc_column_inner($atts, $content = null) {

  $style = $animation = '';

  extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'inner_class' => '',
    'inner_margin' => '',
    'inner_padding' => '',
  ), $atts));

  $width = wpb_translateColumnWidthToSpan($width);
  $el_class = $el_class? ' '.$el_class:'';
  $class = $width.' wpb_column column_container'.$el_class;

  $m_out = $p_out = '';

  if($inner_margin)
  $m_out = ' data-margin="'.$margin.'"';

  if($inner_padding)
  $p_out = ' data-padding="'.$padding.'"';

  $output = '<div class="'.$class.'">';
  $output .= '<div class="element '.$inner_class.'" '.$m_out.' '.$p_out.'>';
  $output .= wpb_js_remove_wpautop($content);
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}

/*Accordion*/
function vc_theme_vc_accordion($atts, $content = null) {

	extract(shortcode_atts(array(
    'class' => '',
    'style' => 'solid',
    ), $atts));

  $GLOBALS['astyle'] = $style;
  $GLOBALS['toggle_id'] = erika_rand_string(8);

  return '<div id="acc-'.$GLOBALS['toggle_id'].'" class="'.$style.' accordion '.$class.'">'.wpb_js_remove_wpautop($content).'</div>';
}


function vc_theme_vc_accordion_tab($atts, $content = null) {

	extract(shortcode_atts(array(
    'class' => '',
    'open' => '',
    'title' => ''
    ), $atts));

  if($open == 1){
    $class_open = 'in';
    $class_open_1 = '';
  } else {
    $class_open = '';
    $class_open_1 = 'class="collapsed"';
  }

  $toggle_item_id = erika_rand_string(8);

  if ($GLOBALS['astyle'] != 'toggle') {
    $data_pr = 'data-parent="#acc-'.$GLOBALS['toggle_id'].'"';
  } else {
    $data_pr = '';
  }

  return '<div class="panel accordion-item"><div class="accordion-heading"><h5 class="accordion-title"><a '.$class_open_1.' data-toggle="collapse" href="#collapse-'.$toggle_item_id.'" '.$data_pr.'>'.$title.'</a></h5></div>
  <div id="collapse-'.$toggle_item_id.'" class="accordion-collapse collapse '.$class_open.'"><div class="accordion-body">'.wpb_js_remove_wpautop($content).'</div></div></div>';
}


/*Tabs*/
function vc_theme_vc_tabs($atts, $content = null) {

	extract(shortcode_atts(array(
    'style' => 'main',
    'class' => '',
    ), $atts));


  $GLOBALS['tab_count'] = 0;
  $i = 1;
  $randomid = rand();
  $tabid = rand();

  do_shortcode( $content );

  if( is_array( $GLOBALS['tabs'] ) ){

    foreach( $GLOBALS['tabs'] as $tab ){  
      if( $tab['icon'] != '' ){
        $icon = '<i class="'.erika_icon_format($tab['icon']).'"></i>';
      }
      else{
        $icon = '';
      }

      $tabs[] = '<li class="tab"><a data-toggle="tab" href="#panel'.$randomid.$i.'">'.$icon . $tab['title'].'</a></li>';
      $panes[] = '<div class="tabs-container" id="panel'.$randomid.$i.'"><div class="tabs-content"><p>'.wpb_js_remove_wpautop($tab['content']).'</p></div></div>';
      $i++;
      $icon = '';
    }

      $script = '<script type="text/javascript">jQuery(document).ready(function($){jQuery("#tab-'.$tabid.' a:first").tab("show");})</script>';
      $return = '<div id="tab-'.$tabid.'" class="clearfix tabs '.$style.' '.$class.'"><ul class="tabNavigation clearfix list-unstyled bottom-0">'.implode( "\n", $tabs ).'</ul>'.implode( "\n", $panes ).'</div>'.$script;
    

  }
  return $return;
}

/*Tab*/
function vc_theme_vc_tab($atts, $content = null) {

	extract(shortcode_atts(array(
    'title' => '',
    'icon'  => '',
    ), $atts));
  
  $x = $GLOBALS['tab_count'];
  $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'icon' => $icon, 'content' =>  $content );
  $GLOBALS['tab_count']++;
}

?>