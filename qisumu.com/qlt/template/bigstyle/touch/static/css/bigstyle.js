/* 基础函数库 */
/**
 * 判断是否有下一页
 * page : 当前页号
 * total: 总记录数
 * pageSize: 每页记录个数
 * cn : 本页记录个数
 **/
function has_next_page(page, total, pageSize, cn)
{
	if (cn<pageSize) return false;
	var pageCount = Math.ceil(total/pageSize);
	return page<pageCount;
}

/* 语言 */
var lang= {
	home: '首页',
	forum: '论坛',
    post: '发帖',
	notice: '消息',
	uc: '我的',
	tip: "请安装并启用 <b style='color:red;'>掌上论坛</b> 插件(1.4.7版本及以上)"
};

