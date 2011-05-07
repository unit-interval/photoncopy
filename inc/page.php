<?php

function page_close() {
	echo '</body></html>';
}
function page_footer() {
	echo "
		<div class='footerWrapper'>
			<div class='footer'>
				<div class='footerItem'>
					<h3>光子复制</h3>
					<ul>
						<li>
							档案库
						</li>
						<li>
							成长的足迹
						</li>
						<li>
							联系我们
						</li>
						<li>
							加入我们
						</li>
					</ul>
				</div>
				<div class='footerItem'>
					<h3>合作伙伴</h3>
					<ul>
						<li>
							申请店铺
						</li>
						<li>
							<a href='/partner.php'>商铺登录</a>
						</li>
						<li>
							工作流程
						</li>
					</ul>
				</div>
				<div class='footerItem'>
					<h3>用户</h3>
					<ul>
						<li>
							用户教程
						</li>
						<li>
							用户协议
						</li>
					</ul>
				</div>
				<div class='latestNews'>
					<h3>近期新闻</h3>
					<dl>
						<dt>光子复制Beta1.0启动</dt>
						<dd>May 6, 2011</dd>
						<dt>放两个新闻</dt>
						<dd>在这里写日期</dd>
					</dl>
				</div>
				<div class='clear'></div>
			</div>
		</div>
	";
}
function page_home($tasks, $stores_prior) {
	echo "<div class='contentWrapper'>
			<div class='panel taskType'>
				<div class='taskTypeItem' id='pdfTask'>
					<p>PDF文档</p>
				</div>
				<div class='taskTypeItem' id='wordTask'>
					<p>WORD文档</p>
				</div>
				<div class='taskTypeItem' id='pptTask'>
					<p>PPT幻灯片</p>
				</div>
				<div class='taskTypeItem' id='taskSum'>
					<h3>费用估计</h3>
					<div>
						<span id='price'>0</span><span>元</span>
					</div>
				</div>
				<div class='taskTypeItem' id='credit'>
					<h3>可用积分</h3>
					<div>
						<span id='credit'>{$_SESSION['credit'][0]}</span>
					</div>
				</div>
			</div>
			<div class='drawer lbCorner rbCorner'>
				<div id='status'>
					请选择打印文件的类型
				</div>
				<div id='creditPlus'>
					如何增加积分 <a href='/credit.php'><img style='vertical-align: text-bottom' src='../images/question.png' alt='q' /></a>
				</div>
				<div class='clear'></div>
				<div id='pdfPage'>
					<div id='pdfConfig'>
						<div class='uploadFile'>
							<form action='/submit.php' method='post' enctype='multipart/form-data'>
								<input type='file'>
								<input type='hidden' name='type' />
								<input type='hidden' name='store' />
								<input type='hidden' name='size' />
								<input type='hidden' name='color' />
								<input type='hidden' name='double' />
								<input type='hidden' name='layout' />
								<input type='hidden' name='pageUpper' />
								<input type='hidden' name='pageLower' />
								<input type='hidden' name='copy' />
								<input type='hidden' name='note' />
								<input type='submit' value='提交' />
							</form>
						</div>
						<input type='button' id='storeBtn' class='uiBtn2' value='选择打印店' />
						<div class='storeListWrapper'>"
						. mod_store_sel($stores_prior) .
						"
							<div class='clear'></div>
						</div>
						<input type='button' id='sizeBtn' value='纸张' />
						<div class='sizeListWrapper'>
							<div class='sizeItem'>
								<input type='hidden' value='A4' />
								A4
							</div>
							<div class='sizeItem'>
								<input type='hidden' value='B5' />
								B5
							</div>
						</div>
						<input type='button' id='colorBtn' value='油墨' />
						<div class='colorListWrapper'>
							<div class='colorItem'>
								<input type='hidden' value='黑白' />
								黑白
							</div>
							<div class='colorItem'>
								<input type='hidden' value='彩色' />
								彩色
							</div>
						</div>
						<input type='button' id='doubleBtn' value='环保' />
						<div class='doubleListWrapper'>
							<div class='doubleItem'>
								<input type='hidden' value='单面打印' />
								单面打印
							</div>
							<div class='doubleItem'>
								<input type='hidden' value='双面打印' />
								双面打印
							</div>
						</div>
						<input type='button' id='pageBtn' value='页数' />
						<div class='pageListWrapper'>
							<div class='pageItem'>
								<input type='hidden' name='upper' value='1' />
								<input type='hidden' name='lower' value='10' />
								1-10
							</div>
							<div class='pageItem'>
								<input type='hidden' name='upper' value='10' />
								<input type='hidden' name='lower' value='50' />
								10-50
							</div>
							<div class='pageItem'>
								<input type='hidden' name='upper' value='50' />
								<input type='hidden' name='lower' value='100' />
								50-100
							</div>
							<div class='pageItem'>
								<input type='hidden' name='upper' value='100' />
								<input type='hidden' name='lower' value='500' />
								100-500
							</div>
						</div>
						<input type='button' id='copyBtn' value='份数' />
						<div class='copyListWrapper'>
							<div class='copyItem'>
								<input type='hidden' value='1' />
								1
							</div>
							<div class='copyItem'>
								<input type='hidden' value='2' />
								2
							</div>
						</div>
						<input type='button' value='确认' />
					</div>
					<div id='pdfConfirm'>
						提示：blablabla;
					</div>
				</div>
			</div>
			<div class='panel taskQueue'>
				<h2>任务队列</h2>
				<table>
					<tbody>"
					. mod_taskqueue($tasks, $stores_prior) . "
					</tbody>
				</table>
				<h2></h2>
			</div>
		</div>";
}
function page_index() {
	echo '
		<div class="contentWrapper">
			<div class="funct">'
			. mod_login()
			. mod_login_signup()
			. mod_login_forget() .
			'</div>
			<div class="content">
				<div id="instruct">
					<p>Step 1: blablabla</p>
					<p>Step 2: blablabla</p>
				</div>
				<div id="stat">
					<p>*** users have signed up.</p>
					<p>*** orders have been made.</p>
				</div>
			</div>
		</div>
	';
}
function page_meta() {
	global $link;
	echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh" xml:lang="zh">
<head>
	<meta name="description" content="xxx" />
	<meta name="keywords" content="print" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="zh-CN" />
	<title>' . CODE_NAME . '</title>
	';
	foreach($link['css'] as $v)
	echo "\t<link rel='stylesheet' type='text/css' href='./media/css/$v.css' />\n";
	foreach($link['js'] as $v)
	echo "\t<script type='text/javascript' src='./media/js/$v.js'></script>\n";
	echo <<<EOT
</head>
<body>
EOT;
}
function page_nav() {
	// and error msg
	echo '
		<div class="nav">
			<div id="logo">
				<a href="/">光子复制</a>
			</div>
			<ul class="account">
	' . mod_nav_account() . '
			</ul>
		</div>
	' . mod_msg();
}
function page_par_act() {
	
}
function page_par_home($orders) {
	$t1 = text_defs('store_region');
	echo "
		<div id='lockMask' class='dummy'>
			<input name='phrase' type='password'/>
			<input type='hidden' value='{$_SESSION['passphrase']}' />
		</div>
		<div class='contentWrapper'>
			<div class='panel board'>
				<h2>" . $t1[$_SESSION['region']] . $_SESSION['name'] . "</h2>
				<div id='storeStatus'>
					<div id='storeCtrl'>
						<div id='storeAvatar'>
						<img width='100%' height='100%' src='/media/images/store/storeAvatar1.jpg' alt='Store Avatar'/>
						</div>
						<input class='uiBtn1' type='button' id='storeLock' value='锁屏幕'/>
					</div>
					<div id='storeMsg'>
						<div id='msgQuote'></div>
						<div id='msgContent'>
							<div id='msgBody'>" . $_SESSION['memo']. "</div>
							<div id='msgDate'>最后一次更新于2011年5月4日</div>
							<input class='uiBtn1' type='button' id='msgChange' value='更改状态' />
							<div class='clear'></div>
							<form id='msgChangePanel'>
								<div class='uiTextareaWrapper'>
									<textarea class='uiTextarea' id='msgNew' rows='5'></textarea>
								</div>
								<div class='clear'></div>
								<div class='uiBtn1Wrapper'>
									<input class='uiBtn1' type='submit' value='确认'/>
									<input class='uiBtn1' id='msgCancel'type='button' value='取消'/>
								</div>
							</form>
						</div>
					</div>
					<div class='clear'></div>
				</div>
			</div>
			<div class='panel order'>
				<h2>打印任务队列</h2>
				<table>
					<tbody>
						<tr>
							<th width='50px'>编号</th>
							<th width='50px'>类型</th>
							<th width='200px'>要求</th>
							<th>留言</th>
							<th width='50px'>下载</th>
							<th width='50px'>状态</th>
							<th width='50px'>操作</th>
						</tr>
						<tr></tr>"
						. mod_order_queue_proc($orders) .
					"</tbody>
				</table>
				<p class='lbCorner rbCorner'>30秒后刷新</p>
			</div>
		</div>
	";
}
function page_par_logout() {
	
}
function page_par_profile() {
	
}
function page_par_reg() {
	
}
function page_par_signup() {
	$a = '/partner';
	echo '
		<div class="contentWrapper">
			<div class="funct">'
			. mod_login($a)
			. mod_login_signup($a)
			. mod_login_forget($a) .
			'</div>
			<div class="content">
				<div id="instruct">
					<p>Become one of our provider now!</p>
				</div>
				<div id="stat">
					<p>*** users have signed up.</p>
					<p>*** orders have been made.</p>
				</div>
			</div>
		</div>
	';
}
function page_profile() {
	echo "<div class='contentWrapper'><div class='content'>
		<p>displays user profile.</p>
		<form><fieldset><div class='field'>
			<label>邮箱</label>
			<input type='text' name='email' disabled='disabled' value='{$_SESSION['email']}' />
			<input type='hidden' name='email-' value='{$_SESSION['email']}' />
			<label>用戶名</label>
			<input type='text' name='name' value='{$_SESSION['name']}'/>
			<input type='hidden' name='name-' value='{$_SESSION['name']}'/>
			<label>密码</label>
			<input type='password' name='passwd' />
			<label>密码確認</label>
			<input type='password' name='passwd-confirm' />
		</div></fieldset><fieldset class='submit'>
			<input class='submit' type='reset' value='重置' />
			<input class='submit' type='submit' value='提交' />
		</fieldset></form>
		</div></div>";
}
function page_reg($m) {
	echo "<div class='contentWrapper'><div class='content'>
		<p>displays reg form.</p>
		<form action='/profile.php' method='post'>
			<fieldset><div class='field'>
				<label>邮箱</label>
				<input type='text' name='email' readonly='readonly' value='$m' />
				<label>用戶名</label>
				<input type='text' name='name' />
				<label>密码</label>
				<input type='password' name='passwd' />
				<label>密码確認</label>
				<input type='password' name='passwd-confirm' />
			</div></fieldset><fieldset class='submit'>
				<input class='submit' type='submit' value='提交' />
			</fieldset></form>
		</div></div>";
}
function page_store($store) {
	echo "
		<div class='contentWrapper'><div class='panel board'>
			<h2>{$text_store_region[$store['region']]}{$store['name']}</h2>
			<div id='storeStatus'>
				<div id='storeAvatar'><img width='100%' height='100%' src='/media/images/store/storeAvatar1.jpg' alt='Store Avatar' /></div>
				<div id='storeMsg'>
					<div id='msgQuote'></div>
					<div id='msgContent'>{$store['memo']}</div>
				</div>
				<div class='clear'></div>
			</div>
			<div id='storeView'>
				<img width='100%' src='/media/images/store/storeView1.jpg' alt='Store View'/>
			</div>
			<div id='storeMap'>"
			. mod_map() .
			"</div>
			<p id='toggleMap'>显示地图</p>
		</div>
		<div class='panel order'>
			<h2>添加打印任务</h2>
			<div class='taskType' id='pdf'>PDF文档</div>
			<div class='taskDetail' id='pdfDetail'>
				<div class='taskIcon'>
					<img width='100%' src='/media/images/pdf.png' alt='pdf' />
				</div>
				<div class='taskDeal'>
					<form action='/submit.php' method='post' enctype='multipart/form-data'>
						<input type='hidden' name='store' value='{$store['id']}' />
						<input type='hidden' name='type' value='0' />
						<div class='file'>
							选择需要打印的PDF文档，上传文件大小限制20MB<br />
							<input type='file' name='document' />
							<input type='button' class='uiBtn0' value='使用信用额度预打印'/>
							<input type='submit' class='uiBtn0' value='上传文件后到店自助打印'/>
						</div>
						<div class='dashedLine'></div>
						<table class='taskConfig'>
							<tr>
								<th>纸张:</th>
								<td>
									<select name='paper'>
										<option value='1' title='0.06'>A4 (210mm*297mm) 0.06元/张</option>
										<option value='2' title='0.1'>B5 (182mm*257mm) 0.06元/张</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>油墨:</th>
								<td>
									<select name='color'>
										<option value='1' title='0.04'>黑白打印 0.04元/面</option>
										<option value='2' title='0.94'>彩色打印 0.94元/面</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>环保:</th>
								<td>
									<select name='double'>
										<option value='1'>单面打印</option>
										<option value='2'>双面打印</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>份数:</th>
								<td><input type='text' name='copy' title='请输入需要打印的份数' class='autoHint' /></td>
							</tr>
							<tr>
								<th>页数:</th>
								<td><input type='text' name='page' title='请准确输入上传文件的页数' class='autoHint' /></td>
							</tr>
							<tr>
								<th>服务:</th>
								<td>
									<input type='checkbox' name='' value='1' title='0'/><label>装订 0.00元</label>
									<input type='checkbox' name='' value='1' title='1.5'/><label>添加封面 1.50元</label>
								</td>
							</tr>
							<tr>
								<th>留言:</th>
								<td><textarea name='note' title='请将附加说明写于此处' class='autoHint' rows='3'></textarea></td>
							</tr>
							<tr>
								<th></th>
								<td>
									<input type='button' class='uiBtn0' id='pdfCon' value='计算总价' />
									<input type='button' class='uiBtn0' id='pdfConf' value='修改订单' />
								</td>
							</tr>
						</table>
						<div class='dashedLine'></div>
						<div class='taskConfirm' id='pdfConfirm'>
							<table class='taskConfi'>
								<tr>
									<td></td>
									<td>单价</td>
									<td>数量</td>
									<td>合计</td>
								</tr>
								<tr>
									<td>纸张费用</td>
									<td>0.06元</td><td>50张</td><td>3元</td>
								</tr>
								<tr>
									<td>墨水费用</td>
									<td>0.04元</td><td>100面</td><td>4元</td>
								</tr>
								<tr>
									<td>总费用</td>
									<td></td><td></td><td>4元</td>
								</tr>
							</table>
							<input class='uiBtn0' type='submit' value='提交订单' />
						</div>
					</form>
				</div>
				<div class='clear'></div>
			</div>
			<div class='taskType' id='word'>WORD文档</div>
			<div class='taskDetail' id='wordDetail'>
				<div class='taskIcon'>
					<img width='100%' src='/media/images/docx.png' alt='pdf' />
				</div>
				<form action='/submit.php' method='post' enctype='multipart/form-data'>
					<label>提交PDF文档 </label><input type='file' name='document' /><br>
					<input type='hidden' name='type' value='1' />
					<label>颜色 </label><input type='radio' checked='yes' name='color' value='黑白' />黑白<input type='radio' name='color' value='彩色' />彩色<br>
					<label>环保 </label><input type='radio' checked='yes' name='double' value='双面' />双面<input type='radio' name='double' value='单面'/>单面<br>
					<label>页数 </label><input type='text' name='page' title='请准确输入上传文件的页数' class='autoHint' /><br>
					<input type='submit' value='提交'/>
				</form>
			</div>
			<div class='taskType lbCorner rbCorner' id='ppt'>PPT幻灯片</div>
			<div class='taskDetail' id='pptDetail'>
				<div class='taskIcon'>
					<img width='100%' src='/media/images/pptx.png' alt='pdf' />
				</div>
				<form action='/submit.php' method='post' enctype='multipart/form-data'>
					<label>提交PDF文档 </label><input type='file' name='document' /><br>
					<input type='hidden' name='type' value='2' />
					<label>颜色 </label><input type='radio' checked='yes' name='color' value='黑白' />黑白<input type='radio' name='color' value='彩色' />彩色<br>
					<label>环保 </label><input type='radio' checked='yes' name='double' value='双面' />双面<input type='radio' name='double' value='单面'/>单面<br>
					<label>页数 </label><input type='text' name='page' title='请准确输入上传文件的页数' class='autoHint' /><br>
					<input type='submit' value='提交'/>
				</form>
			</div>
		</div>
	</div>
	";
}
?>
