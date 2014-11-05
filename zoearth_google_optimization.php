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
            
            JResponse::setBody($response);
        }
    }
}