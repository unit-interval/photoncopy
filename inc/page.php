<?php

function page_close() {
	echo '</body></html>';
}
function page_footer() {
	echo '
		<div class="footerWrapper">
			<div class="footer">
				<ul class="fd">
					<li>
						<a href="/admin/">admin</a>
					</li>
|
					<li>
						<a href="/static/">static</a>
					</li>
|
					<li>
						<a href="/partner.php">partner</a>						
					</li>
				</ul>			
			</div>
		</div>
	';
}
function page_home($tasks, $stores) {
	echo "<div class='contentWrapper'>
			<div class='panel profile'>
				<dl class='profileItem'>
					<dt>PDF文档</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<dl class='profileItem'>
					<dt>WORD文档</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<dl class='profileItem'>
					<dt>PPT幻灯片</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<dl class='profileItem' id='green'>
					<dt>双面打印</dt>
					<dd><span class='value'>0</span> RMB</dd>
				</dl>
				<a href='credit/index.php'>
					<dl class='profileItem rtCorner rbCorner' id='creditPlus'>
						<dd><span class='value'>+</span></dd>
					</dl>
				</a>
				<dl class='profileItem' id='credit'>
					<dt>信用额度</dt>
					<dd><span class='value'>{$_SESSION['credit'][0]}</span> RMB</dd>
				</dl>
			</div>
			<div class='panel task'>
				<h2>任务</h2>
				<div class='lbCorner' id='leftBtn'>&lt</div>
				<ul class='itemWrapper'>"
	. mod_tasks($tasks, $stores) .
				"
				</ul>
				<div id='rightBtn' class='rbCorner'>&gt</div>
				<div class='clear'></div>
			</div>
			<div class='panel store'>
				<h2>请选择打印店</h2>
				<p>网络: 北京大学 | <a>查看地圖</a></p>
				<div id='storeList'>"
				. mod_stores($stores) .
				"
					<div class='clear'></div>
				</div>
			</div>
		</div>		
		";
}
function page_index() {
	echo '
		<div class="contentWrapper">
			<div class="funct">
				<div id="login" class="panel">
					<h2>登录</h2>
					<form action="/authorize.php?c=login" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" value="'
								. $_COOKIE['email'] .
								'" title="请输入邮箱地址" class="autoHint" />
							</div>
							<div class="field">
								<label>密码</label>
								<input type="password" name="passwd" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="checkbox" type="checkbox" name="pub" value="yes" />
							<h3> 正在使用公共电脑登录</h3>
							<input class="submit" type="submit" value="登录" />
						</fieldset>
					</form>
				</div>
				<div id="signup" class="panel">
					<h2>注册</h2>
					<form action="/authorize.php?c=reg" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" title="请输入邮箱地址" class="autoHint" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="submit" type="submit" value="注册" />
						</fieldset>
					</form>
				</div>
				<div id="forget" class="panel">
					<h2>取回密码</h2>
					<form action="/authorize.php?c=forget" method="post">
						<fieldset>
							<div class="field">
								<label>邮箱</label>
								<input type="text" name="email" value="'
								. $_COOKIE['email'] .
								'" title="请输入邮箱地址" class="autoHint" />
							</div>
						</fieldset>
						<fieldset class="submit">
							<input class="submit" type="submit" value="取回密码" />
						</fieldset>
					</form>
				</div>
			</div>
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
	' . mod_login() . '
			</ul>
		</div>
	' . mod_msg();
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
			<div id='storeMap'>" .
//				<iframe width='100%' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://maps.google.com/?ie=UTF8&amp;hq=&amp;ll=39.864289,116.378515&amp;spn=0.005765,0.00912&amp;z=16&amp;output=embed'></iframe>
				"<iframe></iframe>
			</div>
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
						<div class='file'>
							选择需要打印的PDF文档，上传文件大小限制20MB<br />
							<input type='file' name='document' />
							<input type='hidden' name='type' value='0' />
						</div>
						<div class='dashedLine'></div>
						<table>
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
						</table>
						<div class='orderConfirm' id='pdfCon'>
							计算总价
						</div>
						<div class='tableConfirm' id='pdfConfirm'>
							<div class='dashedLine'></div>
							<table class='orderSum'>
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
							<table>
								<tr>
									<td><div class='orderCancel' id='pdfConf'>修改订单</div></td>
									<td><input class='orderSubmit' id='pdfSubmit' type='submit' value='提交订单'/></td>
								</tr>
							</table>
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
