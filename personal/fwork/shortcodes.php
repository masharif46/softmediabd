<?php

/**
* masbaf shortcodes
*
* @since erange 1.0
*/

/*-----------------------------------------------------------------------------------*/
/*  Alert
/*-----------------------------------------------------------------------------------*/
function erika_alert( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'class' => '',
    'style' => '', // erros, info, success, warning
    'close'  => '', 
    ), $atts));

  if($close == 'yes'){
    $close_out = '<span class="close" data-dismiss="alert" aria-hidden="true">&times;</span>';
  } else {
    $close_out = '';
  }

  return '<div class="alert '.$style.' '.$class.' fade in"><div class="alert-icon"><i class="fa fa-info"></i></div><div class="alert-content"><p>'.do_shortcode( $content ).'</p></div>'.$close_out.'</div>';

}

/*-----------------------------------------------------------------------------------*/
/*  Button
/*-----------------------------------------------------------------------------------*/
function erika_buttons( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'link'      => '#',
    'size'      => 'medium',
    'target'    => '_self',
    'color'     => 'color',
    'style'     => 'normal',
    'class'     => '',
    'icon'      => ''
    ), $atts));

  if($icon == '') {
    $return2 = "";
  }
  else{
    $return2 = '<span class="icon"><i class="'.erika_icon_format($icon).'"></i></span>';
  }

  $out = '<a href="'. $link.'" target="'.$target.'" class="button '.$color.' '.$style.' '.$class.'"><span>'. do_shortcode($content).'</span>'.$return2.'</a>';

  return $out;
}


/*-----------------------------------------------------------------------------------*/
/*  Container
/*-----------------------------------------------------------------------------------*/
function erika_container( $atts, $content = null ) {
  return '<div class="container">'.do_shortcode( $content ).'</div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Columns
/*-----------------------------------------------------------------------------------*/
function erika_column_row( $atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    ), $atts));
  return '<div class="row '.$class.'">'.do_shortcode( $content ).'</div>';
}
function erika_column_child_row( $atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    ), $atts));
  return '<div class="row '.$class.'">'.do_shortcode( $content ).'</div>';
}

function erika_column( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'large' => '',
    'medium' => '',
    'small' => '',
    'mobile'  => '',
    'class' => '',
    ), $atts));

  $large_out = '';
  $medium_out = '';
  $small_out = '';
  $mobile_out = '';
  $class_out = '';

  if($large){
    $large_out = 'col-lg-'.$large;
  }
  if($medium){
    $medium_out = 'col-md-'.$medium;
  }
  if($small){
    $small_out = 'col-sm-'.$small;
  }
  if($mobile){
    $mobile_out = 'col-xs-'.$medium;
  }
  if($class){
    $class_out = $class;
  }

  return '<div class="'.$large_out.' '.$medium_out.' '.$small_out.' '.$mobile_out.' '.$class_out.'">'.do_shortcode( $content ).'</div>';
}

function erika_child_column( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'large' => '',
    'medium' => '',
    'small' => '',
    'mobile'  => '',
    'class' => '',
    ), $atts));

  $large_out = '';
  $medium_out = '';
  $small_out = '';
  $mobile_out = '';
  $class_out = '';

  if($large){
    $large_out = 'col-lg-'.$large;
  }
  if($medium){
    $medium_out = 'col-md-'.$medium;
  }
  if($small){
    $small_out = 'col-sm-'.$small;
  }
  if($mobile){
    $mobile_out = 'col-xs-'.$medium;
  }
  if($class){
    $class_out = $class;
  }

  return '<div class="'.$large_out.' '.$medium_out.' '.$small_out.' '.$mobile_out.' '.$class_out.'">'.do_shortcode( $content ).'</div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Heading
/*-----------------------------------------------------------------------------------*/
function erika_heading($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'style' => '',
    'title' => '',
    'desc'  => ''
    ), $atts));

  if($desc){
    $desc_out = '<span class="sub-heading">'.$desc.'</span>';
  } else {
    $desc_out = '';
  }
  return '<div class="heading-area '.$class.'"><h4 class="heading '.$style.'">'.$title.'</h4>'.$desc_out.'</div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Icon Box
/*-----------------------------------------------------------------------------------*/
function erika_iconbox($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'icon' => '', //normal, top, alt
    'title' => '',
    'style' => '',
    ), $atts));

  return '<div class="iconbox clearfix '.$style.' '.$class.'"><div class="iconbox-icon"><i class="'.erika_icon_format($icon).'"></i></div><div class="iconbox-content"><h4 class="bottom-10">'.$title.'</h4><div class="iconbox-content-p">'.do_shortcode( $content ).'</div></div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Counter Box
/*-----------------------------------------------------------------------------------*/
function erika_counterbox($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'number' => '',
    'title' => '',
    'style' => 'white',
    'icon' => '',
    ), $atts));

  return '<div class="counter-box '.$class.' clearfix"><div class="counter-icon"><i class="'.erika_icon_format($icon).'"></i></div><div class="counter-content '.$style.'"><h3 class="counter" data-to="'.$number.'">0</h3><h4 class="counter-desc">'.$title.'</h4></div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Counter Span
/*-----------------------------------------------------------------------------------*/
function erika_counter($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'number' => '',
    ), $atts));

  return '<span class="counter number '.$class.'" data-to="'.$number.'">0</span>';
}

/*-----------------------------------------------------------------------------------*/
/*  ServiceBox
/*-----------------------------------------------------------------------------------*/
function erika_servicebox($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'icon' => '',
    'title' => '',
    'link'  => '',
    'link_name' => '',
    ), $atts));

  if ($link && $link_name){
    $button_out = '<div class="service-action top-20"><a href="'.$link.'" class="button white stroke"><span>'.$link_name.'</span></a></div>';
  } else {
    $button_out = '';
  }

  return '<div class="service-box fadein"><div class="service-icon"><i class="'.erika_icon_format($icon).'"></i></div><div class="service-content top-10"><h3 class="bottom-10 service-title">'.$title.'</h3>'.do_shortcode( $content ).'</div>'.$button_out.'</div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Pro Box
/*-----------------------------------------------------------------------------------*/
function erika_probox($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'img' => '',
    'title' => '',
    'link'  => '',
    ), $atts));

  if ($link){
    $before_link = '<a href="'.$link.'">';
    $after_link = '</a>';
  } else {
    $before_link = $after_link = '';
  }
  
  return '<div class="probox"><div class="probox-image"><img src="'.wp_get_attachment_url($img).'" alt="" class="img-responsive"></div><div class="probox-heading"><div class="probox-title"><h5 class="bottom-0">'.$before_link.$title.$after_link.'</h5></div><div class="probox-desc">'.do_shortcode( $content ).'</div></div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Image Box
/*-----------------------------------------------------------------------------------*/
function erika_imagebox($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'img' => '',
    'title' => '',
    ), $atts));

  return '<div class="imagebox '.$class.'"><div class="imagebox-img"><img src="'.wp_get_attachment_url($img).'" alt="" class="img-responsive"></div><span class="imagebox-mark"></span><div class="imagebox-content"><h4 class="imagebox-heading bottom-10">'.$title.'</h4>'.do_shortcode( $content ).'.</div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Skillbar
/*-----------------------------------------------------------------------------------*/
function erika_skillbar($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'title' => '',
    'percent' => '',
    'color' => '#EF4A43',
    'style' => 'normal', // strip, strip active
    ), $atts));

  return '<div class="progress-trigger '.$class.'"><span class="prgress-small-title">'.$title.'</span><div class="progress clearfix"><div data-percentage="'.$percent.'" data-bgcolor="'.$color.'" class="progress-bar"><span class="percent">'.$percent.'%</span></div></div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Chart
/*-----------------------------------------------------------------------------------*/
function erika_chart($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'bgcolor' => '',
    'percent' => '',
    'barcolor' => '',
    'title' => '',
    ), $atts));

  if($title){
    $title_out = $title;
  } else {
    $title_out = '<span>'.$percent.'</span>%';
  }

  return '<div class="chart-trigger '.$class.'"><div class="chart" data-bgcolor="'.$bgcolor.'" data-barcolor="'.$barcolor.'" data-percent="'.$percent.'"></div></div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Testimonial
/*-----------------------------------------------------------------------------------*/
function erika_testimonial($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'style'  => '',
    'name' => '',
    'company' => '',
    'avatar' => '',
    ), $atts));

  $out = '';

  if ($avatar)
    $avatar_out = '<span class="avatar"><img src="'.wp_get_attachment_url($avatar).'" alt="" /></span>';
  if ($name)
    $name_out = '<span class="name">'.$name.'</span>';
  if ($company)
    $company_out = '<span class="company">- '.$company.'</span>';

  if ($name || $company || $avatar ){
    $out = '<div class="testimonail-info clearfix">'.$avatar_out.'<div class="nameout">'.$name_out.$company_out.'</div></div>';
  }

  return '<div class="testimonail-item '.$style.' '.$class.'"><div class="testimonial-content">'.do_shortcode( $content ).'</div>'.$out.'</div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Element
/*-----------------------------------------------------------------------------------*/
function erika_element($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'margin'  => '',
    'padding' => '',
    ), $atts));

  $data_margin = $data_padding = '';

  if($margin){
    $data_margin = 'data-margin="'.$margin.'"';
  }
  if($padding){
    $data_padding = 'data-padding="'.$padding.'"';
  }

  return '<div class="element '.$class.'" '.$data_margin.' '.$data_padding.'>'.do_shortcode( $content ).'</div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Team
/*-----------------------------------------------------------------------------------*/
function erika_team($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'name' => '',
    'position' => '',
    'avatar'  => '',
    'facebook'  => '',
    'twitter' => '',
    'googleplus'  => '',
    'linkedin'  => '',
    ), $atts));

  $social = '';

  if($facebook){
    $social .= '<li class="facebook"><a href="'.$facebook.'"><i class="fa fa-facebook"></i></a></li>';
  }
  if($twitter){
    $social .= '<li class="facebook"><a href="'.$twitter.'"><i class="fa fa-twitter"></i></a></li>';
  }
  if($googleplus){
    $social .= '<li class="facebook"><a href="'.$googleplus.'"><i class="fa fa-google-plus"></i></a></li>';
  }
  if($linkedin){
    $social .= '<li class="facebook"><a href="'.$linkedin.'"><i class="fa fa-linkedin"></i></a></li>';
  }

  if($social){
    $before = '<ul class="list-unstyled social bottom-0">';
    $after = '</ul>';
  } else {
    $before = '';
    $after = '';
  }

  return '<div class="team-member"><div class="team-member-image"><img src="'.wp_get_attachment_url($avatar).'" alt="" /></div><div class="team-member-content fadein text-center"><h4 class="bottom-0">'.$name.'</h4><span class="desc">'.$position.'</span><div class="team-member-content-dt">'.do_shortcode( $content ).'</div><div class="team-member-social">'.$before.$social.$after.'</div></div></div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Callout
/*-----------------------------------------------------------------------------------*/
function erika_callout($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    'title' => '',
    'desc'  => '',
    'link' => '',
    'button_color'  => '',
    'button_name' => '',
    'button_style'  => 'normal', // border
    'target'  => '_blank',
    'style' => 'normal'
    ), $atts));

  if($link){
    $link_out = '<a target="'.$target.'" href="'.$link.'" class="button '.$button_style.' '.$button_color.'"><span>'.$button_name.'</span></a>';
  } else {
    $link_out = '';
  }

  if($title){
    $title_out = '<h4 class="bottom-0">'.$title.'</h4>';
  } else {
    $title_out = '';
  }

  if($desc){
    $desc_out = '<p>'.$desc.'</p>';
  } else {
    $desc_out = '';
  }

  return '<div class="callout '.$style.' '.$class.'"><div class="callout-content"><div class="row"><div class="col-md-9">'.$title_out.$desc_out.'</div><div class="col-md-3 text-right top-5">'.$link_out.'</div></div></div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Colorbox
/*-----------------------------------------------------------------------------------*/
function erika_colorbox($atts, $content = null){
  extract(shortcode_atts(array(
    'style' => 'heading',
    'img' => '',
    'bg_mark' => '',
    'bg_opacity' => '',
    'class' => '',
    'title' => '',
    'desc' => '',
    'icon' => '',
    'link' => '',
    ), $atts));

  $link_out = '';

  if ($link){
    $link_out = '<a href="'.$link.'"></a>';
  }

  if ($style == 'heading') {
    $return = '<div class="'.$class.' gray-box height-group"><h5 class="box-title large bottom-0">'.$title.'</h5><p>'.$desc.'</p></div>';
  } else {
     $return = '<div class="color-box-item"><div class="color-box height-group section default" data-bg="'.wp_get_attachment_url($img ).'" data-bgmark="'.erika_hex2rgba($bg_mark,$bg_opacity).'">'.$link_out.'<div class="color-box-inner"><div class="color-box-content"><h5 class="box-title ">'.$title.'</h5><p>'.$desc.'</p></div><div class="color-box-icon"><i class="'.erika_icon_format($icon).'"></i></div></div></div></div>';
  }
  return $return;
}

/*-----------------------------------------------------------------------------------*/
/*  Pricing Table
/*-----------------------------------------------------------------------------------*/
/* Pricing Table */
function erika_pricing($atts, $content = null){
  extract(shortcode_atts(array(
    'title' => '',
    'price' => '',
    'currency'  => '',
    'desc'  => '',
    'button_url' => '',
    'button_name' => 'Action',
    ), $atts));

  $out = '';

  if($price){
    $price_out = '<div class="pricing-price"><span class="price">'.$price.'</span><span class="currency">'.$currency.'</span><span class="desc">'.$desc.'</span></div>';
  } else {
    $price_out = '';
  }

  if($button_url){
    $action_out = '<div class="pricing-action"><a class="fadein" href="'.$button_url.'">'.$button_name.'</a><span class="icon"><i class="fa fa-arrow-right"></i></span></div>';
  } else {
    $action_out = '';
  }

  return '<div class="pricing-item fadein"><div class="pricing-item-inner"><div class="pricing-heading fadein"><h4>'.$title.'</h4></div><div class="seperate"></div>'.$price_out.'<div class="seperate"></div><div class="pricing-detail">
'.do_shortcode( $content ).'</div>'.$action_out.'</div></div>';
}

// Pricing Table

function erika_pricing_table($atts, $content = null){
  extract(shortcode_atts(array(
    'title' => '',
    'price' => '',
    'currency'  => '',
    'desc'  => '',
    'button_url' => '',
    'button_name' => 'Action',
    'class' => '',
    'style' => 'pad'
    ), $atts));

  if ($style == 'slab'){
    $header = $footer = '';
  } else {
    $header = '<h4 class="bottom-0">'.$title.'</h4><div class="pricing-price"><span class="price">'.$price.'</span><span class="currency">'.$currency.'</span><div class="pricing-desc"><span>'.$desc.'</span></div></div>';
    $footer = '<a href="'.$button_url.'" class="button black"><span>'.$button_name.'</span></a>';
  }

  return '<div class="'.$class.' pricing-table '.$style.' text-center"><div class="pricing-header">'.$header.'</div><div class="pricing-content">'.do_shortcode( $content ).'</div><div class="pricing-footer">'.$footer.'</div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Google Fonts
/*-----------------------------------------------------------------------------------*/
function erika_googlefont( $atts, $content = null) {
  extract( shortcode_atts( array(
    'font' => 'Swanky and Moo Moo',
    'size' => '42px',
    'margin' => '0px'
    ), $atts ) );

  $google = preg_replace("/ /","+",$font);

  return '<link href="http://fonts.googleapis.com/css?family='.$google.'" rel="stylesheet" type="text/css">
  <div class="googlefont" style="font-family:\'' .$font. '\', serif !important; font-size:' .$size. ' !important; margin: ' .$margin. ' !important;">' . do_shortcode($content) . '</div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Video
/*-----------------------------------------------------------------------------------*/
function erika_video($atts) {
  extract(shortcode_atts(array(
    'type'  => '',
    'id'  => '',
    'width'   => false,
    'height'  => false,
    'autoplay'  => ''
    ), $atts));
  
  if ($height && !$width) $width = intval($height * 16 / 9);
  if (!$height && $width) $height = intval($width * 9 / 16);
  if (!$height && !$width){
    $height = 380;
    $width = 760;
  }
  
  $autoplay = ($autoplay == 'yes' ? '1' : false);

  if($type == "vimeo") $return = "<div class='video-embed'><iframe src='http://player.vimeo.com/video/$id?autoplay=$autoplay&amp;title=0&amp;byline=0&amp;portrait=0' width='$width' height='$height' class='iframe'></iframe></div>";
  
  else if($type == "youtube") $return = "<div class='video-embed'><iframe src='http://www.youtube.com/embed/$id?HD=1;rel=0;showinfo=0' width='$width' height='$height' class='iframe'></iframe></div>";

  if (!empty($id)){
    return $return;
  }
}


/*-----------------------------------------------------------------------------------*/
/*  Google Maps
/*-----------------------------------------------------------------------------------*/
function erika_map($atts) {

  // default atts
  $atts = shortcode_atts(array( 
    'lat'   => '0', 
    'lon'    => '0',
    'id' => 'map',
    'z' => '1',
    'w' => '400',
    'h' => '300',
    'maptype' => 'ROADMAP',
    'address' => '',
    'kml' => '',
    'kmlautofit' => 'yes',
    'marker' => '',
    'markerimage' => '',
    'traffic' => 'no',
    'bike' => 'no',
    'fusion' => '',
    'start' => '',
    'end' => '',
    'infowindow' => '',
    'infowindowdefault' => 'yes',
    'directions' => '',
    'hidecontrols' => 'false',
    'scale' => 'false',
    'scrollwheel' => 'true',
    'drag' => 'false',
    'pan' => 'false',
    'style' => '',
    'api' => 'AIzaSyDR4cw6rWrtnk81cg87GE-Z6RNy8VVcamM'
    ), $atts);

  $returnme = '<div id="' .$atts['id'] . '" style="width:' . $atts['w'] . 'px;height:' . $atts['h'] . 'px;" class="google_map ' . $atts['style'] . '"></div>';
  
  //directions panel
  if($atts['start'] != '' && $atts['end'] != '') 
  {
    $panelwidth = $atts['w']-20;
    $returnme .= '<div id="directionsPanel" style="width:' . $panelwidth . 'px;height:' . $atts['h'] . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>';
  }

  $returnme .= '
  <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places,geometry,visualization&amp;v=3.exp&amp;key='.$atts['api'].'"></script>
  <script type="text/javascript">
  var latlng = new google.maps.LatLng(' . $atts['lat'] . ', ' . $atts['lon'] . ');
  var myOptions = {
    zoom: ' . $atts['z'] . ',
    center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
    zoomControl: true,
    panControl: ' . $atts['pan'] .',
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.SMALL
    },
    draggable: ' . $atts['drag'] .',
    scrollwheel: ' . $atts['scrollwheel'] .',
    scaleControl: ' . $atts['scale'] .',
    disableDefaultUI: ' . $atts['hidecontrols'] .',
    mapTypeId: google.maps.MapTypeId.' . $atts['maptype'] . '
  };
  var ' . $atts['id'] . ' = new google.maps.Map(document.getElementById("' . $atts['id'] . '"),
    myOptions);
';

    //kml
if($atts['kml'] != '') 
{
  if($atts['kmlautofit'] == 'no') 
  {
    $returnme .= '
    var kmlLayerOptions = {preserveViewport:true};
    ';
  }
  else
  {
    $returnme .= '
    var kmlLayerOptions = {preserveViewport:false};
    ';
  }
  $returnme .= '
  var kmllayer = new google.maps.KmlLayer(\'' . html_entity_decode($atts['kml']) . '\',kmlLayerOptions);
  kmllayer.setMap(' . $atts['id'] . ');
  ';
}

    //directions
if($atts['start'] != '' && $atts['end'] != '') 
{
  $returnme .= '
  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(' . $atts['id'] . ');
  directionsDisplay.setPanel(document.getElementById("directionsPanel"));

  var start = \'' . $atts['start'] . '\';
  var end = \'' . $atts['end'] . '\';
  var request = {
    origin:start, 
    destination:end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });


';
}

    //traffic
if($atts['traffic'] == 'yes')
{
  $returnme .= '
  var trafficLayer = new google.maps.TrafficLayer();
  trafficLayer.setMap(' . $atts['id'] . ');
  ';
}

    //bike
if($atts['bike'] == 'yes')
{
  $returnme .= '      
  var bikeLayer = new google.maps.BicyclingLayer();
  bikeLayer.setMap(' . $atts['id'] . ');
  ';
}

    //fusion tables
if($atts['fusion'] != '')
{
  $returnme .= '      
  var fusionLayer = new google.maps.FusionTablesLayer(' . $atts['fusion'] . ');
  fusionLayer.setMap(' . $atts['id'] . ');
  ';
}

    //address
if($atts['address'] != '')
{
  $returnme .= '
  var geocoder_' . $atts['id'] . ' = new google.maps.Geocoder();
  var address = \'' . $atts['address'] . '\';
  geocoder_' . $atts['id'] . '.geocode( { \'address\': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      ' . $atts['id'] . '.setCenter(results[0].geometry.location);
      ';

      if ($atts['marker'] !='')
      {
            //add custom image
        if ($atts['markerimage'] !='')
        {
          $returnme .= 'var image = "'. $atts['markerimage'] .'";';
        }
        $returnme .= '
        var marker = new google.maps.Marker({
          map: ' . $atts['id'] . ', 
          ';
          if ($atts['markerimage'] !='')
          {
            $returnme .= 'icon: image,';
          }
          $returnme .= '
          position: ' . $atts['id'] . '.getCenter()
        });
';

            //infowindow
if($atts['infowindow'] != '') 
{
              //first convert and decode html chars
  $thiscontent = htmlspecialchars_decode($atts['infowindow']);
  $returnme .= '
  var contentString = \'' . $thiscontent . '\';
  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

google.maps.event.addListener(marker, \'click\', function() {
  infowindow.open(' . $atts['id'] . ',marker);
});
';

              //infowindow default
if ($atts['infowindowdefault'] == 'yes')
{
  $returnme .= '
  infowindow.open(' . $atts['id'] . ',marker);
  ';
}
}
}
$returnme .= '
} else {
  alert("Geocode was not successful for the following reason: " + status);
}
});
';
}

    //marker: show if address is not specified
if ($atts['marker'] != '' && $atts['address'] == '')
{
      //add custom image
  if ($atts['markerimage'] !='')
  {
    $returnme .= 'var image = "'. $atts['markerimage'] .'";';
  }

  $returnme .= '
  var marker = new google.maps.Marker({
    map: ' . $atts['id'] . ', 
    ';
    if ($atts['markerimage'] !='')
    {
      $returnme .= 'icon: image,';
    }
    $returnme .= '
    position: ' . $atts['id'] . '.getCenter()
  });
';

      //infowindow
if($atts['infowindow'] != '') 
{
  $returnme .= '
  var contentString = \'' . $atts['infowindow'] . '\';
  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

google.maps.event.addListener(marker, \'click\', function() {
  infowindow.open(' . $atts['id'] . ',marker);
});
';
        //infowindow default
if ($atts['infowindowdefault'] == 'yes')
{
  $returnme .= '
  infowindow.open(' . $atts['id'] . ',marker);
  ';
}       
}
}

$returnme .= '</script>';


return $returnme;
}

/*-----------------------------------------------------------------------------------*/
/*  Testimonial Tabs
/*-----------------------------------------------------------------------------------*/

/* Tab Group*/
function erika_testimonial_tabgroup( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'class' => '',
    ), $atts));

  $GLOBALS['tab_count'] = 0;
  $i = 1;
  $randomid = rand();
  $tabid = rand();

  do_shortcode( $content );

  if( is_array( $GLOBALS['tabs'] ) ){

    foreach( $GLOBALS['tabs'] as $tab ){  

      $tabs[] = '<li class="bottom-1 col-md-3 col-xs-3"><a data-toggle="tab" href="#testimonial'.$randomid.$i.'"><img class="img-responsive" src="'.$tab['avatar'].'" alt=""></a></li>';
          $panes[] = '<div class="testimonail-detail" id="testimonial'.$randomid.$i.'"><p>'.wpb_js_remove_wpautop($tab['content']).'</p><div class="testimonial-info"><span class="name">'.$tab['name'].'</span><span class="company">'.$tab['position'].'</span></div></div>';
      $i++;
    }

      $script = '<script type="text/javascript">jQuery(document).ready(function($){jQuery("#testimonial-'.$tabid.' a:first").tab("show");})</script>';
      
      $return = '<div class="row"><div class="col-md-6 bottom-sm-30 bottom-xs-30 wow fadeIn" data-wow-duration="0.6s" data-wow-delay="0.6s"><div class="tabs testimonial"><div id="testimonial-'.$tabid.'" class="clearfix tabs '.$class.'"><ul class="tabNavigation list-unstyled bottom-0 clearfix row onepixel">'.implode( "\n", $tabs ).'</ul></div></div></div><div class="col-md-6 wow fadeIn" data-wow-duration="0.6s" data-wow-delay="0.3s">'.implode( "\n", $panes ).'</div></div>'.$script;

  }
  return $return;
}

/* Tab */
function erika_testimonial_tab( $atts, $content = null) {
  extract(shortcode_atts(array(
    'name' => '',
    'position'  => '',
    'avatar'  => '',
    ), $atts));
  
  $x = $GLOBALS['tab_count'];
  $GLOBALS['tabs'][$x] = array( 'name' => sprintf( $name, $GLOBALS['tab_count'] ), 'position' => $position, 'avatar' =>  $avatar, 'content' =>  $content);
  $GLOBALS['tab_count']++;
}

function erika_testimonial_tab_area ( $atts, $content = null) {
  return do_shortcode( $content );
}


/*-----------------------------------------------------------------------------------*/
/*  Icons & Lists
/*-----------------------------------------------------------------------------------*/

// Icons
function erika_miniicon( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'icon'      => 'ok'
    ), $atts));

  $out = '<i class="fa fa-'. $icon .'"></i>';
  return $out;
}

// List Wrap
function erika_list( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'style' => 'normal', //seperate
    'class' => '',
    ), $atts));

  if($style){
    $class_out = ' '.$style;
  } else {
    $class_out = '';
  }

  $out = '<ul class="'.$class.' list-unstyled icon-list'.$class_out.'">'. do_shortcode($content) . '</ul>';

  return $out;
}

// List Items
function erika_list_item( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'icon'      => 'ok',
    'class' => '',
    'title' => '',
    'desc' => '',
    'style' => 1
    ), $atts));

  if ($class) {
    $class_out = ' class="'.$class.'"';
  } else {
    $class_out = '';
  }

  if($icon){
    $icon_out = '<i class="'.erika_icon_format($icon).'"></i>';
  } else {
    $icon_out = '';
  }

  if($style == 1) {
    $out = '<li'.$class_out.'><span>'.$icon_out. do_shortcode($content) . '</span></li>';
  } else {
    $out = '<li class="bottom-20" data-sr-init="true" data-sr-complete="true"><i class="'.erika_icon_format($icon).' top-5"></i><div class="icon-content"><h4 class="white bottom-0">'.$title.'</h4><span>'.$desc.'</span></div></li>';
  }

  return $out;
}

/*-----------------------------------------------------------------------------------*/
/*  Dropcap
/*-----------------------------------------------------------------------------------*/
function erika_dropcap($atts, $content = null){
  extract(shortcode_atts(array(
    'style' => ''
    ), $atts));

  return '<span class="dropcap '.$style.'">'.do_shortcode( $content ).'</span>';
}

/*-----------------------------------------------------------------------------------*/
/*  High Light
/*-----------------------------------------------------------------------------------*/
function erika_highlight($atts, $content = null){
  extract(shortcode_atts(array(
    'color' => ''
    ), $atts));

  return '<span class="highlight '.$color.'">'.do_shortcode( $content ).'</span>';
}

/*-----------------------------------------------------------------------------------*/
/*  Useful HTML Tags
/*-----------------------------------------------------------------------------------*/

// Break Tag
function erika_br() {
  return '<br />';
}

// Clear Tag
function erika_clear() {
  return '<div class="clear"></div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Divider
/*-----------------------------------------------------------------------------------*/
function erika_divider( $atts, $content = null ){
  extract(shortcode_atts(array(
    'class'      => '',
    ), $atts));

  $out = '<div class="divider '.$class.'"></div>';

  return $out;
}

/*-----------------------------------------------------------------------------------*/
/*  Stepbox
/*-----------------------------------------------------------------------------------*/
function erika_stepbox( $atts, $content = null ){
  extract(shortcode_atts(array(
    'title'      => '',
    'number'  => 1,
    'class'      => '',
    'style' => '',
    'desc'  => ''
    ), $atts));

  return '<div class="stepbox clearfix '.$class.' '.$style.'"><div class="step">'.$number.'</div><div class="stepcontent"><h3 class="bottom-10">'.$title.'</h3><span>'.$desc.'</span></div></div>';

}

/*-----------------------------------------------------------------------------------*/
/*  Job Box
/*-----------------------------------------------------------------------------------*/
function erika_jobbox( $atts, $content = null ){
  extract(shortcode_atts(array(
    'title'      => '',
    'class'      => '',
    'link'  => '',
    'link_name'  => ''
    ), $atts));

  return '<div class="jobbox '.$class.'"><div class="jobbox-heading"><h4 class="bottom-0">'.$title.'</h4></div><div class="jobbox-content">'.do_shortcode( $content ).'</div><div class="jobbox-footer"><a href="'.$link.'">'.$link_name.'</a></div></div>';

}

/*-----------------------------------------------------------------------------------*/
/*  Portfolio List
/*-----------------------------------------------------------------------------------*/
function erika_portfolio_list($atts, $content = null){
  extract(shortcode_atts(array(
    'number'      => '4',
    'column'      => '3',
    'category'    => '',
    'tag'         => '',
    'class'       => '',
    ), $atts));
  
  $my_args = array(
    'showposts' => $number,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'portfolio',
  );

  if ($category){
    $my_args[] = array(
    'tax_query' => array(
      array(
        'taxonomy' => 'portfolio_category',
        'field' => 'id',
        'terms' => $category,
        )
      )
    );
  }

  if ($tag){
    $my_args[] = array(
    'tax_query' => array(
      array(
        'taxonomy' => 'portfolio_tag',
        'field' => 'id',
        'terms' => $tag,
        )
      )
    );
  }

  $out = '';

  $er_portfolio_shortcode_query = new WP_Query($my_args);
  if ( $er_portfolio_shortcode_query->have_posts() ) :
    $out .= '<div class="'.$class.'"><div class="row onepixel">';
  while ( $er_portfolio_shortcode_query->have_posts() ) : $er_portfolio_shortcode_query->the_post();
    $out .= '<div class="col-md-'.$column.' col-xs-12 col-sm-'.$column.' bottom-xs-30 bottom-sm-30">';
    $out .= erika_get_template_part('fwork/template/content', 'portfolio');
    $out .= '</div>';
  endwhile;
    $out .= '</div></div>';
  endif;wp_reset_query();
  return $out;

}

/*-----------------------------------------------------------------------------------*/
/*  Post List
/*-----------------------------------------------------------------------------------*/
function erika_posts_list($atts, $content = null){
  extract(shortcode_atts(array(
    'number'      => '4',
    'cat' => '',
    'tag' => '',
    'class' => '',
    'column' => '',
    'style' => 'normal'
    ), $atts));

  $my_args = array(
    'showposts' => $number,
    'orderby' => 'date',
    'order' => 'DESC',
    'ignore_sticky_posts' => 1
  );

  if ($cat){
    $cat_list = explode(',',$cat);
    $my_args['category__in'] = $cat_list;
  }
  
   if ($tag){
    $tag_list = explode(',',$tag);
    $my_args['tag__in'] = $tag_list;
  }

  if ($style == 'timeline') {
    $before = '<div class="'.$class.'"><ul class="clearfix list-unstyled bottom-0 timeline blogtl">';
    $after = '</ul></div>';
    $before_item = '';
    $after_item = '';
    $loop = 'timeline';
  } else {
    $before = '<div class="'.$class.'"><div class="row">';
    $after = '</div></div>';
    $before_item = '<div class="col-md-'.$column.' col-xs-12 col-sm-'.$column.' bottom-xs-30 bottom-sm-30">';
    $after_item = '</div>';
    $loop = 'shortcode';
  }

  $out = '';

  $er_portfolio_shortcode_query = new WP_Query($my_args);
  if ( $er_portfolio_shortcode_query->have_posts() ) :
    $out .= $before;
  while ( $er_portfolio_shortcode_query->have_posts() ) : $er_portfolio_shortcode_query->the_post();
    $out .= $before_item;
    $out .= erika_get_template_part('fwork/template/content', $loop);
    $out .= $after_item;
  endwhile;
    $out .= $after;
  endif;wp_reset_query();
  return $out;

}

/*-----------------------------------------------------------------------------------*/
/*  Timeline
/*-----------------------------------------------------------------------------------*/

function erika_timeline($atts, $content = null){

  return '<ul class="clearfix list-unstyled bottom-0 timeline blogtl">'.do_shortcode( $content ).'</ul>';

}

function erika_timeline_item($atts, $content = null){

  return '<li><div class="timeline-item"><div class="timeline-content">'.do_shortcode( $content ).'</div></div></li>';

}

/*-----------------------------------------------------------------------------------*/
/*  Carousel Shortcodes
/*-----------------------------------------------------------------------------------*/

function erika_carousel($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    ), $atts));

  return '<div class="'.$class.' carouselbox"><ul class="row list-unstyled bottom-0 carousel-area">'.do_shortcode( $content ).'</ul></div>';
}
function erika_carousel_item($atts, $content = null){

  return '<li>'.do_shortcode( $content ).'</li>';

}

function erika_customer_logo($atts, $content = null){
  extract(shortcode_atts(array(
    'img' => '',
    'img_hover' => '',
    ), $atts));

  return '<div class="cilent-item"><img src="'.$img_hover.'" alt="" class="cilent img-resonsive" data-hover="'.$img.'"></div>';

}


/*-----------------------------------------------------------------------------------*/
/*  Mega Menu Shortcodes
/*-----------------------------------------------------------------------------------*/

function erika_mega_block_icon($atts, $content = null){
  extract(shortcode_atts(array(
    'icon' => '',
    'url' => '',
    'title' => '',
    'class' => ''
    ), $atts));

  return '<div class="fadein icon-service-block '.$class.'"><span class="icon"><i class="'.erika_icon_format($icon).'"></i></span><a href="'.$url.'"><span class="desc">'.$title.'</span></a></div>';
}


/*-----------------------------------------------------------------------------------*/
/*  Promo Slider
/*-----------------------------------------------------------------------------------*/

function erika_promo_slider($atts, $content = null){
  extract(shortcode_atts(array(
    'class' => '',
    ), $atts));

  return '<div class="'.$class.' flexslider promoslider"><ul class="slides">'.do_shortcode( $content ).'</ul></div>';

}

function erika_promo_slider_item($atts, $content = null){

  return '<li>'.do_shortcode( $content ).'</li>';

}

function erika_dynamic_text($atts, $content = null){
  extract(shortcode_atts(array(
    'default' => '',
    ), $atts));
  return '<span data-typer-targets="'.do_shortcode( $content ).'">'.$default.'</span>';
}

/*-----------------------------------------------------------------------------------*/
/*  Sidebar
/*-----------------------------------------------------------------------------------*/
function erika_sidebar_special_area($atts, $content = null){
  extract(shortcode_atts(array(
    'name' => '',
    ), $atts));

  ob_start();
  dynamic_sidebar($name);
  $output = ob_get_contents();
  ob_end_clean();
  return '<div class="sidebar"><div class="sidebar-inner">'.$output.'</div></div>';
}

/*-----------------------------------------------------------------------------------*/
/*  Footer Shortcodes
/*-----------------------------------------------------------------------------------*/
function erika_bloginfo_wpurl($atts, $content = null){
  return get_bloginfo( 'wpurl' );
}
function erika_bloginfo_siteurl($atts, $content = null){
  return get_bloginfo( 'url' );
}
function erika_bloginfo_themeurl($atts, $content = null){
  return get_bloginfo( 'template_url' );
}
function erika_bloginfo_loginurl($atts, $content = null){
  return wp_login_url();
}
function erika_bloginfo_wp_logout_url($atts, $content = null){
  return wp_logout_url();
}
function erika_bloginfo_sitetitle($atts, $content = null){
  return get_bloginfo( 'name' );
}
function erika_bloginfo_tagline($atts, $content = null){
  return get_bloginfo( 'description' );
}
function erika_bloginfo_year($atts, $content = null){
  return date( 'Y' );
}

/*-----------------------------------------------------------------------------------*/
/*  Register Shortcode
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'alert', 'erika_alert' );
add_shortcode( 'button', 'erika_buttons' );
add_shortcode( 'counter', 'erika_counter' );
add_shortcode( 'highlight', 'erika_highlight' );
add_shortcode( 'dropcap', 'erika_dropcap' );
add_shortcode( 'icon', 'erika_miniicon' );
add_shortcode( 'video', 'erika_video' );
add_shortcode( 'googlefont', 'erika_googlefont' );
add_shortcode( 'member', 'erika_team' );
add_shortcode( 'testimonial', 'erika_testimonial' );
add_shortcode( 'chart', 'erika_chart' );
add_shortcode( 'skillbar', 'erika_skillbar' );
add_shortcode( 'heading', 'erika_heading' );
add_shortcode( 'br', 'erika_br' );
add_shortcode( 'clear', 'erika_clear' );
add_shortcode( 'divider', 'erika_divider' );
add_shortcode( 'map', 'erika_map');
add_shortcode( 'element', 'erika_element' );
add_shortcode( 'sidebar_area', 'erika_sidebar_special_area' );
add_shortcode( 'testimonial_group', 'erika_testimonial_tabgroup' );
add_shortcode( 'testimonial_item', 'erika_testimonial_tab' );
add_shortcode( 'testimonial_group_area', 'erika_testimonial_tab_area' );
add_shortcode( 'animate-text','erika_dynamic_text');
add_shortcode( 'wp-url','erika_bloginfo_wpurl' );
add_shortcode( 'site-url','erika_bloginfo_siteurl' );
add_shortcode( 'theme-url','erika_bloginfo_themeurl' );
add_shortcode( 'login-url','erika_bloginfo_loginurl' );
add_shortcode( 'logout-url','erika_bloginfo_wp_logout_url' );
add_shortcode( 'site-title','erika_bloginfo_sitetitle' );
add_shortcode( 'site-tagline','erika_bloginfo_tagline' );
add_shortcode( 'current-year','erika_bloginfo_year' );

add_shortcode( 'contact-map','erika_contact_map' );

add_shortcode( 'mega-block-icon','erika_mega_block_icon' );

add_shortcode( 'timeline', 'erika_timeline' );
add_shortcode( 'timeline-item', 'erika_timeline_item' );

add_shortcode( 'carousel','erika_carousel' );
add_shortcode( 'carousel-item','erika_carousel_item' );

add_shortcode( 'megablock', 'erika_mega_block' );

add_shortcode( 'posts', 'erika_posts_list' );
add_shortcode( 'portfolio', 'erika_portfolio_list' );

add_shortcode( 'slider', 'erika_promo_slider' );
add_shortcode( 'slider-item', 'erika_promo_slider_item' );

add_shortcode( 'counterbox', 'erika_counterbox' );
add_shortcode( 'servicebox', 'erika_servicebox' );
add_shortcode( 'iconbox', 'erika_iconbox' );
add_shortcode( 'stepbox', 'erika_stepbox' );
add_shortcode( 'imagebox', 'erika_imagebox' );
add_shortcode( 'probox', 'erika_probox' );
add_shortcode( 'jobbox', 'erika_jobbox' );

add_shortcode( 'colorbox', 'erika_colorbox' );

add_shortcode( 'customer_logo','erika_customer_logo' );

add_shortcode( 'testimonial_tab','erika_testimonial_tab' );
add_shortcode( 'testimonial_tab_item','erika_testimonial_tab_item' );

/*-----------------------------------------------------------------------------------*/
/*  Process Shortcode
/*-----------------------------------------------------------------------------------*/
function pre_process_shortcode($content) {
  global $shortcode_tags;

    // Backup current registered shortcodes and clear them all out
  $orig_shortcode_tags = $shortcode_tags;

  remove_all_shortcodes();
  add_shortcode( 'container', 'erika_container' );
  add_shortcode( 'row', 'erika_column_row' );
  add_shortcode( 'column', 'erika_column' );
  add_shortcode( 'child_row', 'erika_column_child_row' );
  add_shortcode( 'child_column', 'erika_child_column' );
  add_shortcode( 'list-item', 'erika_list_item' );
  add_shortcode( 'list', 'erika_list' );
  add_shortcode( 'heading', 'erika_heading' );
  add_shortcode( 'pricingbox', 'erika_pricing' );
  add_shortcode( 'pricingtable', 'erika_pricing_table' );
  add_shortcode( 'callout', 'erika_callout' );
  add_shortcode( 'micon','erika_menu_icon' );
  
    // Do the shortcode (only the one above is registered)
  $content = do_shortcode($content);

    // Put the original shortcodes back
  $shortcode_tags = $orig_shortcode_tags;

  return $content;
}
add_filter('the_content', 'pre_process_shortcode', 7);
add_filter('widget_text', 'pre_process_shortcode', 7);
?>