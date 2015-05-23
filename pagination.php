<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/18/15
 * Time: 5:15 PM
 */


class Pagination {
    protected $_config = array(
        'current_page' => 1,
        'total_record' => 1,
        'limit'        => 10,
        'start'        => 1,
        'total_page'   => 1,
        'link_full'    => '',
        'link_first'   => ''
    );

    function init($config = array())
    {
        foreach ($config as $key => $val){
            if (isset($this->_config[$key])){
                $this->_config[$key] = $val;
            }
        }

        if ($this->_config['limit'] < 0){
            $this->_config['limit'] = 0;
        }

        $this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);

        if (!$this->_config['total_page']){
            $this->_config['total_page'] = 1;
        }

        if ($this->_config['current_page'] < 1){
            $this->_config['current_page'] = 1;
        }

        if ($this->_config['current_page'] > $this->_config['total_page']){
            $this->_config['current_page'] = $this->_config['total_page'];
        }

        $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];
    }

    private function __link($page)
    {
        if ($page <= 1 && $this->_config['link_first']){
            return $this->_config['link_first'];
        }
        return str_replace('{page}', $page, $this->_config['link_full']);
    }

    function html()
    {
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit'])
        {
            $p = "<ul id='pagi'>";

            // Nút prev và first
            if ($this->_config['current_page'] > 1)
            {
                $p .= '<li><a href="'.$this->__link('1').'">First</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['current_page']-1).'">Prev</a></li>';
            }

            for ($i = 1; $i <= $this->_config['total_page']; $i++)
            {
                if ($this->_config['current_page'] == $i){
                    $p .= '<li><span>'.$i.'</span></li>';
                }
                else{
                    $p .= '<li><a href="'.$this->__link($i).'">'.$i.'</a></li>';
                }
            }

            if ($this->_config['current_page'] < $this->_config['total_page'])
            {
                $p .= '<li><a href="'.$this->__link($this->_config['current_page'] + 1).'">Next</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['total_page']).'">Last</a></li>';
            }

            $p .= '</ul>';
        }
        return $p;
    }
}




?>