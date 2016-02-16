<?php
defined('_JEXEC') or die ;

jimport('joomla.plugin.plugin');

function ref_gamer($matches)
{
	return urldecode($matches[1]);
}

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
			//20160208 zoearth 針對文章處理
			if ($this->params->get('no_font_size_medium') == '1')
			{
				$response = str_replace('font-size: medium;','',$response);
			}
			
			//20160208 zoearth ref.gamer處理
			if ($this->params->get('ref_gamer') == '1')
			{
				$response = preg_replace_callback('/http:\/\/ref.gamer.com.tw\/redir\.php\?url\=([^"]*)/','ref_gamer',$response);
			}
			
            JResponse::setBody($response);
        }
    }
}