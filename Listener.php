<?php

namespace Truonglv\NodeListTabs;

class Listener
{
    private static $nodeListDepth = 0;

    public static function getTabHashId($title)
    {
        return \XF::app()->router()->prepareStringForUrl($title, true);
    }

    public static function getNodeListDepth($depth = null)
    {
        if (intval($depth) === 1) {
            self::$nodeListDepth++;
        }

        return (self::$nodeListDepth === 1) ? 1 : null;
    }

    public static function getNodeFAIcon($id)
    {
        static $icons = null;
        if ($icons === null) {
            $iconRules = \XF::app()->options()->NodeListTabs_nodeIcons;
            $iconRules = preg_split("/(\n|\r\n)/", $iconRules, -1, PREG_SPLIT_NO_EMPTY);

            if (!is_array($iconRules)) {
                $iconRules = [];
            }

            $icons = [];
            foreach ($iconRules as $iconRule) {
                list($nodeId, $iconName) = explode('|', $iconRule, 2);

                $icons[intval($nodeId)] = $iconName;
            }
        }

        return isset($icons[$id]) ? $icons[$id] : null;
    }
}
