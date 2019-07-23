<?php 
function mbt_add_category_field(){  
    echo '<div class="form-field">  
            <label for="cat-color">颜色</label>  
            <input name="cat-color" id="cat-color" type="text" value="" size="40">  
            <p>在文章列表的标题前显示</p>  
          </div>';                         
}  
add_action('category_add_form_fields','mbt_add_category_field',10,2);  
  
// 分类编辑字段  
function mbt_edit_category_field($tag){  
    echo '<tr class="form-field">  
            <th scope="row"><label for="cat-color">颜色</label></th>  
            <td>  
                <input name="cat-color" id="cat-color" type="text" value="';  
                echo get_option('cat-color-'.$tag->term_id).'" size="40"/><br>  
                <span class="cat-color">'.$tag->name.' 的分类颜色</span>  
            </td>  
        </tr>';           
}  
add_action('category_edit_form_fields','mbt_edit_category_field',10,2);  
  
// 保存数据  
function mbt_taxonomy_metadate($term_id){  
    if(isset($_POST['cat-color'])){  
        //判断权限--可改  
        if(!current_user_can('manage_categories')){  
            return $term_id;  
        }  
        // 颜色  
        $color_key = 'cat-color-'.$term_id; // key 选项名为 cat-tel-1 类型  
        $color_value = $_POST['cat-color']; // value  
          
              
        // 更新选项值  
        update_option( $color_key, $color_value );   
    }  
}  
  
// 虽然要两个钩子，但是我们可以两个钩子使用同一个函数  
add_action('created_category','mbt_taxonomy_metadate',10,1);  
add_action('edited_category','mbt_taxonomy_metadate',10,1); 

?>