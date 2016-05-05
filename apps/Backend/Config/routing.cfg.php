<?php
$r = array(
  '__urlSuffix__'=>'.html',
  '__remap__'=> array(
     'route'=>'home/default'
  ),
  '/'=>array(
     'route'=>'home/default'
  ),
  '{controller}'=>array( 
    'route'=>'{controller}/default' 
  ),
  '{controller}/{action}'=>array( 
    'route'=>'{controller}/{action}' 
  ),
  '{controller}/{action}/{id:\d+}'=>array( 
    'route'=>'{controller}/{action}'   ),
);
return $r;