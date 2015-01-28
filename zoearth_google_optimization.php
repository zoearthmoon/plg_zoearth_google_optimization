<?php
defined('_JEXEC') or die ;

jimport('joomla.plugin.plugin');

class plgSystemZoearth_Google_Optimization extends JPlugin
{
    function onAfterRender()
    {
        $app =& JFactory::getApplication();
        if ($app->isSite())
        {
            $response = JResponse::getBody();
            
            //javascript 加上 async 非同步
            if ($this->params->get('javascript_async') == '1')
            {
                $response = str_replace('<script src=','<script async src=',$response);
            }
            
			//20150128 針對TAG圖片處理
            if ($this->params->get('tag_img') == '1')
            {
                $response = str_replace('span class="label label-success"><img','span ><img',$response);
            }
			
            JResponse::setBody($response);
        }
    }
}