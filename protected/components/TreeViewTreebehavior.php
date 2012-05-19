<?php

class TreeViewTreebehavior extends Treebehavior
{
    public function getTreeViewData($returnrootnode = true, $keyfield = null)
    {
        if($keyfield == null)
        {
            $keyfield = 'id';
        }
        // Fetch the flat tree
        $rawtree = $this->getTree(true);
        // Init variables needed for the array conversion
        $tree = array();
        $node =& $tree;
        $position = array();
        $lastitem = '';
        $depth = $this->getLevelValue();
        
        foreach($rawtree as $rawitem)
        {
            // If its a deeper item, then make it subitems of the current item
            if ($rawitem->getLevelValue() > $depth)
            {
                $position[] =& $node; //$lastitem;
                $depth = $rawitem->getLevelValue();
                $node =& $node[$lastitem]['children'];
            }
            // If its less deep item, then return to a level up
            else
            {
                while ($rawitem->getLevelValue() < $depth)
                {
                    end($position);
                    $node =& $position[key($position)];
                    array_pop($position);
                    $depth = $node[key($node)]['node']->getLevelValue();
                }
            }
            
            if(!$rawitem->hasChildNodes())
                $rawitem->owner->name = '<a title="' . $rawitem->owner->description . '" href="' . Yii::app()->createUrl('teachers/view', array('id' => $rawitem->owner->id)) . '">'.$rawitem->owner->name . '</a>';
            else
                $rawitem->owner->name = '<span>'.$rawitem->owner->name.'</span>';
            
            // Add the item to the final array
            $node[$rawitem->$keyfield]['node'] = $rawitem;
            $node[$rawitem->$keyfield]['id'] = 'node'.$rawitem->owner->id;
            $node[$rawitem->$keyfield]['text'] = $rawitem->owner->name;
            // save the last items' name
            $lastitem = $rawitem->$keyfield;
        }
        // we don't care about the root node
        if (!$returnrootnode)
        {
            reset($tree);
	    if(isset($tree[key($tree)]['children'])) {
                 $tree = $tree[key($tree)]['children'];
	    }
            //array_shift($tree);
        }
        
        return $tree;
    }
}
