<?php
/**
 * @property string $parent_attribute
 * @property string $parent_relation
 */
class CategoryTreeBehavior extends CategoryBehavior
{
    public $parent_attribute = 'parent_id';
    public $parent_relation = 'parent';

    /**
     * Returns array of primary keys of children items
     * @param mixed $parent number, object or array of numbers
     * @return array
     */
    public function get_childs_array($parent = 0)
    {
        $parent_ids = $this->_get_parents_ids($parent);

        $this->_cached();

		$criteria         = $this->_get_owner_criteria();
		$criteria->select = 't.'. $this->_primary_key_attribute() . ', t.' . $this->title_attribute . ', t.' . $this->parent_attribute;
		$command          = $this->_create_find_command($criteria);
		$items            = $command->queryAll();
        $this->_clear_owner_criteria();

        $result = [];

        foreach ($parent_ids as $parent_id)
        {
            $this->_get_childs_array_recursive($items, $result, $parent_id);
        }

        return array_unique($result);
    }

    protected function _get_childs_array_recursive(&$items, &$result, $parent_id)
    {
        foreach ($items as $item)
        {
            if ((int)$item[$this->parent_attribute] == (int)$parent_id)
            {
                $result[] = $item[$this->_primary_key_attribute()];
                $this->_get_childs_array_recursive($items, $result, $item[$this->_primary_key_attribute()]);
            }
        }
    }

    /**
     * Returns associated array ($id=>$fullTitle, $id=>$fullTitle, ...)
     * @param mixed $parent number, object or array of numbers
     * @return array
     */
    public function get_titles_list($parent=0)
    {
        $this->_cached();

        $items = $this->_get_items_array([
            $this->_primary_key_attribute(),
            $this->title_attribute,
            $this->parent_attribute
        ], $parent);

        $associated = [];
        foreach ($items as $item)
        {
            $associated[$item[$this->_primary_key_attribute()]] = $item;
        }

        $items = $associated;

        $result = array();

        foreach($items as $item)
        {
            $titles = [$item[$this->title_attribute]];

            $temp = $item;
            while (isset($items[(int)$temp[$this->parent_attribute]]))
            {
                $titles[] = $items[(int)$temp[$this->parent_attribute]][$this->title_attribute];
                $temp = $items[(int)$temp[$this->parent_attribute]];
            }

            $result[$item[$this->_primary_key_attribute()]] = implode(' - ', array_reverse($titles));
        }

        return $result;
    }

    /**
     * Returns associated array ($alias=>$fullTitle, $alias=>$fullTitle, ...)
     * @param mixed $parent number, object or array of numbers
     * @return array
     */
    public function get_aliases_list($parent=0)
    {
        $this->_cached();

        $items = $this->_get_items_array([
            $this->aliasAttribute,
            $this->titleAttribute,
            $this->parentAttribute,
        ], $parent);

        $associated = [];
        foreach ($items as $item)
        {
            $associated[$item[$this->alias_attribute]] = $item;
        }

        $items = $associated;

        $result = [];

        foreach($items as $item)
        {
            $titles = [$item[$this->title_attribute]];

            $temp = $item;
            while (isset($items[(int)$temp[$this->parent_attribute]]))
            {
                $titles[] = $items[(int)$temp[$this->parent_attribute]][$this->title_attribute];
                $temp = $items[(int)$temp[$this->parent_attribute]];
            }

            $result[$item[$this->alias_attribute]] = implode(' - ', array_reverse($titles));
        }

        return $result;
    }

    /**
     * Returns tabulated array ($url=>$title, $url=>$title, ...)
     * @param mixed $parent number, object or array of numbers
     * @param int $sub levels
     * @return array
     */
    public function get_urls_list($parent=0)
    {
        $criteria = $this->_get_owner_criteria();

        if (!$parent)
        {
            $parent = $this->getOwner()->getPrimaryKey();
        }

        if ($parent)
        {
            $criteria->compare($this->_primary_key_attribute(), $this->get_childs_array($parent));
        }

        $items = $this->_cached($this->getOwner())->findAll($criteria);

        $categories = [];
        foreach ($items as $item)
        {
            $categories[(int)$item->{$this->parent_attribute}][] = $item;
        }

        return $this->_get_urls_list_recursive ($categories, $parent);
    }

    protected function _get_urls_list_recursive($items, $parent, $indent=0)
    {
        $parent = (int)$parent;
        $result = [];
        if (isset($items[$parent]) && $items[$parent])
        {
            foreach ($items[$parent] as $item)
            {
                $result += array($item->get_url() => str_repeat('-- ', $indent) . $item->{$this->title_attribute}) + $this->_get_urls_list_recursive($items, $item->getPrimaryKey(), $indent + 1);
            }
        }

        return $result;
    }

    /**
     * Finds model by path
     * @param string $path
     * @return CActiveRecord model
     */
    public function find_by_path($path)
    {
		$domens   = explode('/', trim($path, '/'));
		$model    = null;
		$criteria = $this->_get_owner_criteria();

        if (count($domens) == 1) 
        {
            $criteria->mergeWith([
				'condition' => 't.' . $this->alias_attribute . ' = :alias AND (t.' . $this->parent_attribute . ' iS NULL OR t.' . $this->parent_attribute . ' = 0)',
				'params'    => [':alias' => $domens[0]]
            ]);

            $model = $this->_cached($this->getOwner())->find($criteria);
        } 
        else 
        {
            $criteria->mergeWith([
				'condition' => 't.' . $this->aliasAttribute . '=:alias',
				'params'    => [':alias' => $domens[0]]
            ]);

            $parent = $this->_cached($this->getOwner())->find($criteria);

            if ($parent)
            {
                $domens = array_slice($domens, 1);
                foreach ($domens as $alias)
                {
                    $model = $parent->_get_child_by_alias($alias, $this->_get_original_criteria());
                    if (!$model) 
                	{
                		return null;
                	}

                    $parent = $model;
                }
            }
        }
        return $model;
    }

    /**
     * Constructs full path for current model
     * @param string $separator
     * @return string
     */
    public function get_url($separator='/', $limit = 10)
    {
		$category = $this->getOwner();
		$uri      = [$category->{$this->alias_attribute}];

        while ($limit-- && $this->_cached($category)->{$this->parent_relation})
        {
			$uri[]    = $category->{$this->parent_relation}->{$this->alias_attribute};
			$category = $category->{$this->parent_relation};
        }

        return implode(array_reverse($uri), $separator);
    }

    /**
     * Constructs breadcrumbs for zii.widgets.CBreadcrumbs widget
     * @param bool $lastLink if you can have link in last element
     * @return array
     */
    public function get_breadcrumbs($last_link = false, $limit = 10)
    {
        if ($last_link)
        {
            $breadcrumbs = [[
				'title' => $this->getOwner()->{$this->title_attribute},
				'url'   => $this->getOwner()->getUrl()
        	]];
        }
        else 
        {
            $breadcrumbs = [
				'title' => $this->getOwner()->{$this->title_attribute}
        	];
        }

        $page = $this->getOwner();

        while ($limit-- && $this->_cached($page)->{$this->parent_relation})
        {
        	$page = $page->{$this->parent_relation};
        	$breadcrumbs[] = [
				'url'   => $page->get_url(),
				'title' => $page->{$this->parent_relation}->{$this->title_attribute}
        	];
            
        }
        return array_reverse($breadcrumbs);
    }

    /**
     * Constructs full title for current model
     * @param string $separator
     * @return string
     */
    public function get_full_title($inverse = false, $separator=' - ', $limit = 10)
    {
    	$item = $this->getOwner();
        $titles = [$item->{$this->title_attribute} ];

        while ($limit-- && $this->_cached($item)->{$this->parent_relation})
        {
        	$item = $item->{$this->parent_relation};
            $titles[] = $item->{$this->title_attribute};
        }

        return implode($inverse ? $titles : array_reverse($titles), $separator);
    }

    protected function _get_parents_ids($parent)
    {
        if (!$parent)
        {
            $parent = $this->getOwner()->getPrimaryKey();
        }

        $parents = $this->_to_ids_array($parent);

        return $parents;
    }

    protected function _to_array_with_id($items)
    {
        $array = [];

        if (!$items)
        {
            $items = [0];
        } 
        elseif (!is_array($items))
        {
            $items = [$items];
        }

        foreach ($items as $item) 
        {
            if (is_object($item)) 
            {
                $array[] = $item->getPrimaryKey();
            }
             else 
             {
                $array[] = $item;
            }
        }

        return array_unique($array);
    }

    protected function _get_child_by_alias($alias, $criteria=null)
    {
        if ($criteria === null)
        {
            $criteria = $this->_get_owner_criteria();
        }

        $criteria->mergeWith([
            'condition' => 't.' . $this->alias_attribute . '=:alias AND t.' . $this->parent_attribute . '=:parent_id',
            'params' =>[
				':alias'     =>$alias,
				':parent_id' =>$this->getOwner()->getPrimaryKey()
            ]
        ]);

        return $this->_cached($this->getOwner())->find($criteria);
    }

    protected function _get_original_criteria()
    {
        return clone $this->_criteria;
    }
}