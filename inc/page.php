<?php

function page_activate() {
	echo "
	<div class='contentWrapper'> 
		<div class='profile'>
			<div class='profileL'>
				<div class='profileType'>
					帐户设置
				</div>
			</div>
			<div class='profileR' id='accountSetting'>
				<div class='profileHeader'>
					帐户设置
				</div>
				<div class='profileContent'>
					<h2>初次设置</h2>
					<p></p>
					<form action='/profile.php' method='post'>
					<table>
						<tbody>
							<tr>
								<th>邮箱</th>
								<td><input type='text' class='uiText2' name='email' disabled='disabled' value='abc@example.com'/></td>
							</tr>
							<tr>
								<th>用户名</th>
								<td><input type='text' class='uiText2' name='name'/></td>
							</tr>
							<tr>
								<th>设定密码</th>
								<td><input type='password' class='uiText2' name='passwd'/></td>
							</tr>
							<tr>
								<th>确认密码</th>
								<td><input type='password' class='uiText2' name='passwd-confirm'/></td>
							</tr>
							<tr>
								<th></th>
								<td><input type='submit' class='uiBtn3' value='激活帐户'></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			<div class='clear'></div>
		</div> 
	</div>
		";
}
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
							关于我们
						</li>
					</ul>
				</div>
				<div class='footerItem'>
					<h3>合作伙伴</h3>
					<ul>
						<li>
							<a href='/partner.php'>商铺登录</a>
						</li>
					</ul>
				</div>
				<div class='footerItem'>
					<h3>用户</h3>
					<ul>
						<li>
							用户教程
						</li>
					</ul>
				</div>
				<div class='latestNews'>
					<h3>近期新闻</h3>
					<dl>
						<dt>光子复制Beta1.0启动</dt>
						<dd>May 6, 2011</dd>
					</dl>
				</div>
				<div class='clear'></div>
			</div>
		</div>
	";
}
function page_home($orders, $stores) {
	echo "
		<div class='contentWrapper'>
			<div class='panel' id='btnWrapper'>
				<div id='btn0'></div>
				<div class='btn' id='firstBtn'><div id='btn1' class='innerBtn'></div></div>
				<div class='btn'><div id='btn2' class='innerBtn'></div></div>
				<div class='btn'><div id='btn3' class='innerBtn'></div></div>
				<div class='btn'><div id='btn4' class='innerBtn'></div></div>
				<div class='btn'><div id='btn5' class='innerBtn'></div></div>
				<div class='btn'><div id='btn6' class='innerBtn'></div></div>
				<div class='btn'><div id='btn7' class='innerBtn'></div></div>
				<div class='btn'><div id='btn8' class='innerBtn'></div></div>
				<a href='/profile.php'>
	 				<dl id='credit'>
	 					<dt>信用</dt>
	 					<dd id='credit1'>{$_SESSION['credit'][0]}</dd>
	 				</dl>
	 			</a>
			</div>
			<div class='drawer lbCorner rbCorner'>
				<div id='status'>
					<span class='fleft'></span>
					<div id='statusFileBar'><div id='statusFileBarInner'></div></div>
					<span></span>
				</div>
				<div class='clear'></div>
			</div>
			<div id='w1' class='w panel'>
				<h2>上传文件</h2>
				<p style='text-align: center'>
					支持文件类型: PDF文档 WORD文档 PPT幻灯片; 大小限制: 20MB<br>
				</p>
				<form id='formFile' target='ifr_upload' action='/xhr/upload-handler.php' method='post' enctype='multipart/form-data'>
					<input type='hidden' name='UPLOAD_IDENTIFIER' />
					<input type='file' name='file' />
				</form>
				<p style='text-align: center'>
					重新选择上传文件将直接替换之前上传的文件
				</p>
				<div id='w1c'></div>
			</div>
			<div id='w2' class='w panel'>
				<h2>选择打印店</h2>
				<div class='storeWrapper'>"
				. mod_store_sel($stores) . "
				</div> 
			</div>
			<div id='w3' class='w panel'>
				<h2>纸张和油墨</h2>
				<table class='hovertable'>
					<tr>
						<th></th>
						<th>B5纸</th>
						<th>A4纸</th>
					</tr>
					<tr>
						<th>黑白打印</th>
						<td><div class='w3item' id='b5bw'></div></td>
						<td><div class='w3item' id='a4bw'></div></td>
					</tr>
					<tr>
						<th>彩色打印</th>
						<td><div class='w3item' id='b5color'></div></td>
						<td><div class='w3item' id='a4color'></div></td>
					</tr>
				</table>
			</div>
			<div id='w4' class='w panel'>
				<h2>环保选项</h2>
				<table class='hovertable'>
					<tr>
						<th></th>
						<th>单面打印</th>
						<th>双面打印</th>
					</tr>
					<tr>
						<th></th>
						<td><div class='w4item' id='single'></div></td>
						<td><div class='w4item' id='double'></div></td>
					</tr>
				</table>
			</div>
			<div id='w5' class='w panel'>
				<h2>版式缩放</h2>
				<p>提示: 打印PPT幻灯片一般需要进行版式放缩</p>
				<table class='hovertable'>
					<tr>
						<th></th>
						<th>1x1版</th>
						<th>2x1版</th>
						<th>2x2版</th>
						<th>2x3版</th>
						<th>2x4版</th>
						<th>3x3版</th>
						<th>3x4版</th>
					</tr>
					<tr>
						<th></th>
						<td><div class='w5item' id='layout1'></div></td>
						<td><div class='w5item' id='layout2'></div></td>
						<td><div class='w5item' id='layout4'></div></td>
						<td><div class='w5item' id='layout6'></div></td>
						<td><div class='w5item' id='layout8'></div></td>
						<td><div class='w5item' id='layout9'></div></td>
						<td><div class='w5item' id='layout12'></div></td>
					</tr>
				</table>
			</div>
			<div id='w6' class='w panel'>
				<h2>打印份数</h2>
				<div class='w6content'>
					<div class='dynos-copy'>
						<p></p>
						<p>请选择需要打印的份数</p>
						<p>通过下方按钮可进行微调</p>
		            	<p>
		            		<input type='button' id='copyM10' class='copyAdjust' value='-10' />
		            		<input type='button' id='copyM1' class='copyAdjust' value='-1' />
		            		<input type='button' id='copyP1' class='copyAdjust' value='+1' />
		            		<input type='button' id='copyP10' class='copyAdjust' value='+10' />
		            	</p>
					</div>
					<div class='slider'>
			            <div id='dynos-slider-container'>
							<div id='dynos-slider' class='ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all'>
							</div>
			            </div>
					</div>
		          	<div class='workers-copy'>
						<div class='w6confirm'>
							<div class='w6h3a'>
								<input type='button' id='w6ConfirmBtn' class='uiBtn2 w6item' value='确认份数' />
							</div>
						</div>
	          		</div>
	         		<div class='clear'></div>
				</div>
			</div>
			<div id='w7' class='w panel'>
				<h2>附加服务</h2>
				<table class='hovertable'>
					<tr>
						<th></th>
						<th>无装订</th>
						<th>简易装订</th>
						<th>侧边装订</th>
						<th>添加封面</th>
					</tr>
					<tr>
						<th></th>
						<td><div class='w7item' id='bind0'></div></td>
						<td><div class='w7item' id='bind1'></div></td>
						<td><div class='w7item' id='bind2'></div></td>
						<td><div class='w7item' id='bind3'></div></td>
					</tr>
				</table>
			</div>
			<div id='w8' class='w panel'>
				<h2>确认订单</h2>
				<p>订单仍可进一步修改，如需定制化服务请给打印店留言，并留下联系方式。</p>
				<div class='w8content'>
					<div class='editForm lbCorner'>
						<h3>打印店</h3>
						<h4 id='w2Edit'>北京大学25楼打印店</h4>
					</div>
					<div class='editForm'>
						<h3>纸张</h3>
						<h4 id='w3Edit1'>A4纸</h4>
						<h3>油墨</h3>
						<h4 id='w3Edit2'>黑白打印</h4>
					</div>
					<div class='editForm'>
						<h3>环保选项</h3>
						<h4 id='w4Edit'>双面打印</h4>
					</div>
					<div class='editForm'>
						<h3>版式缩放</h3>
						<h4 id='w5Edit'>1版</h4>
					</div>
					<div class='editForm'>
						<h3>页数估计</h3>
						<h4 id='w6Edit1'>页数很少</h4>
						<h3>打印份数</h3>
						<h4 id='w6Edit2'>打印6份</h4>
					</div>
					<div class='editForm'>
						<h3>附加服务</h3>
						<h4 id='w7Edit'>添加封面</h4>
					</div>
					<div class='confirmForm rbCorner'>
						<h3>客户留言</h3>
						<textarea id='w8Edit' class='uiTextarea'></textarea>
						<input type='button' id='w8ConfirmBtn' class='uiBtn2' disabled='disabled' value='请稍等'/>
					</div>
					<div class='clear'></div>
				</div>
			</div>
			<div class='wDummy'></div>
			<div class='taskQueue'>
				<div class='taskQueueL'>
					<input type='text' id='taskSearch' placeholder='搜索' class='uiSearch'>
				</div>
				<div class='panel0 taskQueueR'>
					<h2>任务队列</h2>
					<div id='taskAccordion'>"
					. mod_order_queue($orders) . "
					</div>
					<div class='lbCorner rbCorner taskAccordionBottom'></div>
				</div>
				<div class='clear'></div>
			</div> 
			<form id='formOrder' accept-charset='UTF-8'>
				<input type='hidden' id='w2Form' name='pid' value='' />
				<input type='hidden' id='w3Form1' name='paper' value='' />
				<input type='hidden' id='w3Form2' name='color' value='' />
				<input type='hidden' id='w4Form' name='back' value='' />
				<input type='hidden' id='w5Form' name='layout' value='' />
				<input type='hidden' id='w6Form' name='copy' value='' />
				<input type='hidden' id='w7Form' name='misc' value='' />
				<input type='hidden' id='w8Form' name='note' />
				<input type='hidden' id='w9Form' name='guarantee'/>
				<input type='hidden' name='fid'/>
				<input type='hidden' name='fname'/>
				<input type='hidden' name='page' value='1' />
			</form>
		</div>
		<iframe name='ifr_upload' class='outcast init'></iframe>";
}
function page_index() {
	echo "
		<div class='lightbox'>
			<div id='login' class='panel'>
				<h2>登录<span class='lightboxClose fright'>×</span></h2>
				<form action='/authorize.php?c=login' method='post'>
					<fieldset><div class='field'>
						<label>邮箱</label>
						<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText'>
					</div>
					<div class='field'>
						<label>密码<span id='forgetBtn' class='fright'>忘记密码</span></label>
						<input type='password' name='passwd' placeholder='请输入密码' class='uiText'>
					</div></fieldset><fieldset class='submit'>
					<input class='checkbox' type='checkbox' name='publicLogin' value='yes'>
					<h3> 正在使用公共电脑登录</h3>
					<input class='uiBtn submit' type='submit' value='登录'>
					</fieldset>
				</form>
			</div>
			<div id='signup' class='panel'>
				<h2>注册<span class='lightboxClose fright'>×</span></h2>
				<form><fieldset>
					<div class='field'>
						<label>邮箱</label>
						<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText'>
					</div></fieldset><fieldset class='submit'>
					<input class='uiBtn submit' type='button' value='注册'>
			</fieldset></form></div>
			<div id='forget' class='panel'>
				<h2>取回密码<span class='lightboxClose fright'>×</span></h2>
				<form><fieldset>
					<div class='field'>
						<label>邮箱</label>
						<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText'>
					</div></fieldset><fieldset class='submit'>
					<input class='uiBtn submit' type='button' value='取回密码'>
			</fieldset></form></div>
			<div id='dummyLightbox'></div>
		</div>
		<div class='contentWrapper'>
			<ul class='slideshow'>
				<li class='slidePhoto' id='slidePhoto-1'>
					<div class='slidePhotoWrapper'>
						<h2>让校园生活更便捷</h2>
						<p>在线提交打印任务，到店付款领取文档，一切已在行进中完成</p>
						<a href='tutorial'>了解更多</a>
					</div>
				</li>
			</ul>";
	if($_SESSION['logged_in'] != true)
		echo "
			<div class='content'>
				<div class='slideshowCtrl'>
					<input type='button' class='uiBtn2' id='signupBtn' value='免费注册'/>
					<div class='clear'></div>
				</div>
			</div>";
	echo "
		</div>";
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
EOT;
}
function page_nav($body_id = 'main') {
	// and error msg
	echo "
<body id='$body_id'>
		<div id='dummyNotification'></div>
		<div id='notificationWrapper'></div>
		<div class='nav'>
			<a href='/' id='logo'></a>
	" . mod_nav_account() . '
		</div>';
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
				<table>"
						. mod_order_queue_proc($orders) .
				"</table>
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
	echo "
	<div class='contentWrapper'> 
		<div class='profile'>
			<div class='profileL'>
				<a href='#1' class='profileType'>
					帐户设置
				</a>
				<a href='#2' class='profileType'>
					任务中心
				</a>
				<a class='profileType' href='#3'>
					徽章中心
				</a>
			</div>
			<div class='profileR' id='accountSetting'>
				<div class='profileHeader'>
					帐户设置
				</div>
				<div class='profileContent'>
					<div class='profileSection'>
					<h2>基本设置</h2>
					<table class='formTable'>
						<tbody>
							<tr>
								<th>用户名</th>
								<td><input type='text' class='uiText2' name='userName' value='{$_SESSION['name']}' /></td>
							</tr>
							<tr>
								<th></th>
								<td><input type='button' class='uiBtn3' value='保存设置'  disabled='disabled' /></td>
							</tr>
						</tbody>
					</table>
					</div>
					<div class='profileSection'>
					<h2>安全设置</h2>
					<table class='formTable'>
						<tbody>
							<tr>
								<th>邮箱</th>
								<td><input type='text' class='uiText2' value='{$_SESSION['email']}' disabled='disabled' /></td>
							</tr>
							<tr>
								<th>修改密码</th>
								<td><input type='password' class='uiText2' name='password1' /></td>
							</tr>
							<tr>
								<th>确认密码</th>
								<td><input type='password' class='uiText2' name='password2' /></td>
							</tr>
							<tr>
								<th></th>
								<td><input type='button' class='uiBtn3' value='修改设置' disabled='disabled' /></td>
							</tr>
						</tbody>
					</table>
					</div>
				</div>
			</div>
			<div class='profileR' id='taskCenter'>
				<div class='profileHeader'>任务中心</div>
				<div class='profileContent'>
					<div class='profileSection'>
					<p>用户可以通过完成不同的任务获得徽章并累计信用。部分任务为隐藏任务，完成后系统将自动通知您激活奖励。</p>
					<div class='badge pointerCursor'><span class='badge1'></span><input type='hidden' name='taskNo' value='1' />献计献策</div>
					<div class='badge pointerCursor'><span class='badge3'></span><input type='hidden' name='taskNo' value='2' />大学校</div>
					</div>
					<div id='taskDetail'>
					</div>
				</div>
			</div>
			<div class='profileR' id='creditCenter'>
				<div class='profileHeader'>徽章中心</div>
				<div class='profileContent'>
					<div class='profileSection'>
					<h2>徽章说明</h2>
					<table>
						<tbody>
							<tr>
								<th><div class='badge'><span class='badge1'></span>金质徽章</div></th>
								<td>金质徽章非常稀少，只有做出杰出贡献的用户才能获得它们。</td>
							</tr>
							<tr>
								<th><div class='badge'><span class='badge2'></span>银质徽章</div></th>
								<td>银质徽章奖励给长期使用的用户，它们并不常见，但您只需要累计良好的信用记录就能得到。</td>
							</tr>
							<tr>
								<th><div class='badge'><span class='badge3'></span>铜质徽章</div></th>
								<td>铜质徽章奖励给普通用户，它们是很容易得到的。</td>
							</tr>
						</tbody>
					</table>
					</div>
					<div class='profileSection'>
					<h2>我的徽章</h2>
					<table>
						<tbody>
							<tr>
								<th><div class='badge'><span class='badge3'></span>新手上路</div> × 570</th>
								<td>欢迎来到光子复制，我们将为您提供最便利的生活类应用服务。</td>
							</tr>
							<tr>
								<th><div class='badge'><span class='badge3'></span>大学校</div> × 570</th>
								<td>已经认证大学邮箱。</td>
							</tr>
							<tr>
								<th><div class='badge'><span class='badge1'></span>献计献策</div> × 2</th>
								<td>对光子复制提出宝贵意见，并被采纳。</td>
							</tr>
						</tbody>
					</table>
					</div>
				</div>
			</div>
			<div class='clear'></div>
		</div> 
	</div>
		";
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
function script_home($s) {
	$sn = array();
	foreach($s as $n) {
		$sn[$n['id']] = $n['name'];
	}
	echo "
<script type='text/javascript'>
/* <![CDATA[ */
var order_option_text = {
	store:	".json_encode($sn).",
	back:	".json_encode(text_defs('order_back')).",
	color:	".json_encode(text_defs('order_color')).",
	layout:	".json_encode(text_defs('order_layout')).",
	misc:	".json_encode(text_defs('order_misc')).",
	paper:	".json_encode(text_defs('order_paper')).",
	region:	".json_encode(text_defs('store_region'), JSON_FORCE_OBJECT).",
};
/* ]]> */
</script>";
}
?>
