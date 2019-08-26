<?php 

if (!function_exists('sort_order')) {
    /**
     * Returns opposite sort direction
     *
     * @param string $sort
     * 
     * @param string $order
     * */
    function sort_order($sort, $order)
    {
        if( $order ):
            
            if( strtolower($order) == 'asc' ):
                return "/admin/search?sort={$sort}&order=desc";
            else:
                return "/admin/search?sort={$sort}&order=asc";
            endif;

        else:
            return "/admin/search?sort={$sort}&order=desc";
        endif;
 
    }
}

if (!function_exists('sort_arrow')) {
    /**
     * Returns opposite sort arrow
     * 
     * @param string $name
     *
     * @param string $sort
     * 
     * @param string $order
     * */
    function sort_arrow($name, $sort, $order)
    {
        if( $name == $sort ):
            
            if( strtolower($order) == 'asc' ):
                return "<span class='fa fa-caret-up'></span>";
            else:
                return "<span class='fa fa-caret-down'></span>";
            endif;
            
        endif;
 
    }
}
