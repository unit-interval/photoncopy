<?php

function page_resetpasswd(){
	echo "
	<div class='contentWrapper'> 
		<div class='profile'>
			<div class='profileL'>
				<div class='profileType'>
					密码重置
				</div>
			</div>
			<div class='profileRWrapper'>
			<div class='profileR' id='profile-0'>
				<div class='profileHeader'>
					密码重置
				</div>
				<div class='profileContent'>
					<form action='/authorize.php' method='post'>
						<table>
							<tbody>
								<tr>
									<th>邮箱</th>
									<td><input type='text' class='uiText2' name='email' disabled='true' value='{$_SESSION['email']}'></td>
								</tr>
								<tr>
									<th>用户名</th>
									<td><input type='text' id='user_login' class='uiText2' name='name' value='{$_SESSION['name']}' disabled='true'></td>
								</tr>
								<tr>
									<th>设定密码</th>
									<td><input type='password' id='pass1' class='uiText2' name='passwd'></td>
								</tr>
								<tr>
									<th>确认密码</th>
									<td><input type='password' id='pass2' class='uiText2'></td>
								</tr>
								<tr>
									<th></th>
									<td><div id='pass-strength-result'>强度</div><input type='submit' id='pass-confirm' class='uiBtn3' value='激活帐户'></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			</div>
			<div class='clear'></div>
		</div> 
	</div>
		";
}

function page_activate() {
	echo "
	<div class='contentWrapper'> 
		<div class='profile'>
			<div class='profileL'>
				<div class='profileType'>
					初次设置
				</div>
			</div>
			<div class='profileRWrapper'>
			<div class='profileR' id='profile-0'>
				<div class='profileHeader'>
					初次设置
				</div>
				<div class='profileContent'>
					<form action='/authorize.php' method='post'>
						<table>
							<tbody>
								<tr>
									<th>邮箱</th>
									<td><input type='text' class='uiText2' name='email' disabled='disabled' value='{$_SESSION['email']}'></td>
								</tr>
								<tr>
									<th>用户名</th>
									<td><input type='text' id='user_login' class='uiText2' name='name'></td>
								</tr>
								<tr>
									<th>设定密码</th>
									<td><input type='password' id='pass1' class='uiText2' name='passwd'></td>
								</tr>
								<tr>
									<th>确认密码</th>
									<td><input type='password' id='pass2' class='uiText2'></td>
								</tr>
								<tr>
									<th></th>
									<td><div id='pass-strength-result'>强度</div><input type='submit' id='pass-confirm' class='uiBtn3' value='激活帐户'></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
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
							<a href='/blog/about/'>关于我们</a>
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
							<a href='/blog/tutorial/'>用户教程</a>
						</li>
					</ul>
				</div>
				<div class='latestNews'>
					<h3>近期新闻</h3>
					<dl>
						<dt><a href='/blog/2011/05/dev-alpha/'>光子复制内测<a></dt>
						<dd>May 29, 2011</dd>
					</dl>
				</div>
				<div class='clear'></div>
			</div>
		</div>
	";
}
function page_home($orders, $stores) {
	echo "
		<div class='lightbox'>
			<div class='panel board'>
				<h2>
					<span id='lightboxStoreName'></span>
					<span class='storeClose'>×</span>
				</h2>
				<div id='storeStatus'>
					<div id='storeAvatar'>
						<img id='lightboxStoreAvatar' width='100%' height='100%' src='' alt='Store Avatar'>
					</div>
					<div id='storeMsg'>
						<div id='msgQuote'></div>
						<div id='msgContent'>打印店介绍</div>
					</div>
					<div class='clear'></div>
				</div>
				<ul class='storeNav'>
					<li class='selected'>外景照片</li>
					<li>查看地图</li>
				</ul>
				<div class='storeDetail lbCorner rbCorner'>
					<div id='storeView'>
						<img width='100%' src='' alt='Store View'>
					</div>
					<div id='storeMap'>
						<img width='100%' src='' alt='Store Map'>
					</div>
				</div>
			</div>
			<div id='dummyLightbox'></div>
		</div>
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
	 					<dt>量子数</dt>
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
					<div class='editForm'>
						<h3>打印店</h3>
						<h4 id='w2Edit'></h4>
					</div>
					<div class='editForm'>
						<h3>纸张</h3>
						<h4 id='w3Edit1'></h4>
						<h3>油墨</h3>
						<h4 id='w3Edit2'></h4>
					</div>
					<div class='editForm'>
						<h3>环保选项</h3>
						<h4 id='w4Edit'></h4>
					</div>
					<div class='editForm'>
						<h3>版式缩放</h3>
						<h4 id='w5Edit'></h4>
					</div>
					<div class='editForm'>
						<h3>打印份数</h3>
						<h4 id='w6Edit'></h4>
					</div>
					<div class='editForm last'>
						<h3>附加服务</h3>
						<h4 id='w7Edit'></h4>
					</div>
					<div class='clear'></div>
					<div class='confirmForm lbCorner rbCorner'>
						<h3>客户留言<input type='text' class='uiText' id='w8Edit' class='uiTextarea1' /><input type='button' id='w8ConfirmBtn' class='uiBtn2' disabled='true' value='文件上传中'/></h3>
					</div>
				</div>
			</div>
			<div class='wDummy'></div>
			<div class='taskQueue'>
				<div class='taskQueueL'>
					<input type='text' id='taskSearch' placeholder='搜索' class='uiSearch'>
				</div>
				<div class='panel0 taskQueueR'>
					<h2>订单列表</h2>
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
						<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText' value='{$_COOKIE['email']}' />
					</div>
					<div class='field'>
						<label>密码<span id='forgetBtn' class='fright'>忘记密码</span></label>
						<input type='password' name='passwd' placeholder='请输入密码' class='uiText'>
					</div></fieldset><fieldset class='submit'>
					<input class='checkbox' type='checkbox' name='pub' />
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
					<input class='uiBtn submit' type='submit' value='注册'>
			</fieldset></form></div>
			<div id='forget' class='panel'>
				<h2>取回密码<span class='lightboxClose fright'>×</span></h2>
				<form><fieldset>
					<div class='field'>
						<label>邮箱</label>
						<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText' value='{$_COOKIE['email']}' />
					</div></fieldset><fieldset class='submit'>
					<input class='uiBtn submit' type='submit' value='取回密码'>
			</fieldset></form></div>
			<div id='dummyLightbox'></div>
		</div>
		<div class='contentWrapper'>
			<ul class='slideshow'>
				<li class='slidePhoto' id='slidePhoto-1'>
					<div class='slidePhotoWrapper'>
						<h2>让校园生活更便捷</h2>
						<p>在线提交打印任务，到店付款领取文档，一切已在行进中完成</p>
						<a href='/blog/tutorial/'>了解更多</a>";
						if($_SESSION['logged_in'] != true)
						echo "
						<div class='slideshowCtrl'>
							<input type='button' class='uiBtn2' id='signupBtn' value='免费注册'/>
							<div class='clear'></div>
						</div>";
					echo 
					"</div>
				</li>
			</ul>
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
	echo "\t<link rel='stylesheet' type='text/css' href='/media/css/$v.css' />\n";
	foreach($link['js'] as $v)
	echo "\t<script type='text/javascript' src='/media/js/$v.js'></script>\n";
	echo <<<EOT
</head>
EOT;
}
function page_nav($body_id = 'main', $body_style = '') {
	// and error msg
	if($body_style === '')
		$body_style = $body_id;
	echo "
	<body id='$body_style'>"
		. mod_notif() . "
		<div class='nav'>
			<a href='/' id='logo'></a>"
			. mod_nav_account($body_id) . '
		</div>';
}
function page_par_home($orders, $users) {
	$t1 = text_defs('store_region');
	echo "
		<div class='lightbox'>
			<div class='panel1' id='lockMask'>
				<h2>解锁</h2>
				<div class='field'>
					<input name='phrase' class='uiText' placeholder='请输入短密码' type='password'/>
					<input type='hidden' value='". $_SESSION['passphrase'] . "'>
				</div>
			</div>
		</div>
		<div class='contentWrapper'>
			<div class='content'>
				<div class='panel1 board'>
					<h2>" . $t1[$_SESSION['region']] . $_SESSION['name'] . "</h2>
					<div id='storeStatus'>
						<div id='storeCtrl'>
							<div id='storeAvatar'>
							<img width='100%' height='100%' src='/media/images/store/storeAvatar{$_SESSION['pid']}.jpg' alt='Store Avatar'/>
							</div>
							<input class='uiBtn1' type='button' id='storeLock' value='锁屏幕'/>
						</div>
						<div id='storeMsg'>
							<div id='msgQuote'></div>
							<div id='msgContent'>
								<div id='msgBody'>" . $_SESSION['memo']. "</div>
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
				<div class='taskQueue'>
					<div class='taskQueueL'>
						<input type='text' id='taskSearch' placeholder='搜索' class='uiSearch'>
					</div>
					<div class='panel1 taskQueueR'>
						<h2>订单队列</h2>
						<div id='taskAccordion'>"
							. mod_order_queue_par($orders, $users) .
						"</div>
						<div class='lbCorner rbCorner taskAccordionBottom'> </div>
					</div>
					<div class='clear'></div>
				</div>
			</div>
		</div>
	";
}
function page_par_profile($users) {
	echo "
	<div class='contentWrapper'> 
		<div class='profile'>
			<div class='profileL'>
				<div class='profileType'>
					帐户中心
				</div>
				<ul>
					<li><a href='#1-1'>基本信息</a></li>
					<li><a href='#1-2'>安全设置</a></li>
				</ul>
				<div class='profileType'>
					统计中心
				</div>
				<ul>
					<li><a href='#0'>储蓄概要</a></li>
				</ul>
			</div>
			<div class='profileRWrapper'>
				<div class='profileR' id='profile-1-1'>
					<div class='profileHeader'>基本信息</div>
					<div class='profileContent'>
						<form action='/authorize.php?c=par_update_info' method='post'>
							<table class='formTable'>
								<tbody>
									<tr>
										<th>店名</th>
										<td><input type='text' class='uiText2' name='name' value='{$_SESSION['name']}' /></td>
									</tr>
									<tr>
										<th>网络</th>
										<td>
											<select class='uiSelect' name='parNetwork'>
												<option value='0'>北京大学</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>头像</th>
										<td>
											<input type='file' name='avatar' /> 100像素×100像素的JPG文件
										</td>
									</tr>
									<tr>
										<th>外景</th>
										<td>
											<input type='file' name='photo' /> 940像素×345像素的JPG文件
										</td>
									</tr>
									<tr>
										<th>地图</th>
										<td>
											<input type='file' name='map' /> 940像素×345像素的PNG文件
										</td>
									</tr>
									<tr>
										<th></th>
										<td><input type='submit' class='uiBtn3' value='保存设置' /></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
				<div class='profileR' id='profile-1-2'>
					<div class='profileHeader'>安全设置</div>
					<div class='profileContent'>
						<form action='/authorize.php?c=update_par_password' method='post'>
							<table class='formTable'>
								<tbody>
									<tr>
										<th>邮箱</th>
										<td><input type='text' class='uiText2' value='{$_SESSION['email']}' disabled='disabled'></td>
									</tr>
									<tr>
										<th>修改密码</th>
										<td><input type='password' class='uiText2' name='passwd' /></td>
									</tr>
									<tr>
										<th>确认密码</th>
										<td><input type='password' class='uiText2' /></td>
									</tr>
									<tr>
										<th></th>
										<td><input type='submit' class='uiBtn3' value='修改设置' /></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
				<div class='profileR' id='profile-0'>"
				. mod_stat_par($users) . "
				</div>
			</div>
			<div class='clear'></div>
		</div> 
	</div>";
}
function page_par_activate() {
	echo '
	<div class="contentWrapper"> 
		<div class="profile">
			<div class="profileL">
				<div class="profileType">
					初次设置
				</div>
			</div>
			<div class="profileRWrapper">
			<div class="profileR" id="profile-0">
				<div class="profileHeader">
					初次设置
				</div>
				<div class="profileContent">
					<form action="/authorize.php?c=par_activate" method="post"> 
					<table class="formTable">
						<tbody>
							<tr>
								<th>邮箱</th>
								<td><input type="text" class="uiText2" name="email" disabled="disabled" value="abc@example.com" /></td>
							</tr>
							<tr>
								<th>店名</th>
								<td><input type="text" id="user_login" class="uiText2" name="name" /></td>
							</tr>
							<tr>
								<th>短密码</th>
								<td><input type="password" id="pass0" class="uiText2" name="short" />
							<tr>
								<th>设定密码</th>
								<td><input type="password" id="pass1" class="uiText2" name="passwd" /></td>
							</tr>
							<tr>
								<th>确认密码</th>
								<td><input type="password" id="pass2" class="uiText2" /></td>
							</tr>
							<tr>
								<th></th>
								<td><div id="pass-strength-result">强度</div><input type="button" id="pass-confirm" class="uiBtn3" value="激活帐户" /></td>
							</tr>
							<tr>
								<th>管理员邮箱</th>
								<td><input type="password" class="uiText2" name="adminEmail" /></td>
							</tr>
							<tr>
								<th>管理员密码</th>
								<td><input type="password" class="uiText2" name="adminPasswd" /></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			</div>
			<div class="clear"></div>
		</div> 
	</div>
	';
}
function page_par_signup() {
	echo "
		<div class='lightbox'>
			<div id='login' class='panel'>
				<h2>登录<span class='lightboxClose fright'>×</span></h2>
				<form action='/authorize.php?c=partnerlogin' method='post'>
					<fieldset><div class='field'>
						<label>邮箱</label>
						<input type='text' name='email' placeholder='请输入邮箱地址' class='uiText'>
					</div>
					<div class='field'>
						<label>密码<span id='forgetBtn' class='fright'>忘记密码</span></label>
						<input type='password' name='passwd' placeholder='请输入密码' class='uiText'>
					</div></fieldset><fieldset class='submit'>
					<input class='uiBtn submit' type='submit' value='登录'>
					</fieldset>
				</form>
			</div>
			<div id='signup' class='panel'>
				<h2>申请<span class='lightboxClose fright'>×</span></h2>
				<form>
					<fieldset>
						<div class='field'><label>邮箱</label><input type='text' name='email' placeholder='请输入邮箱地址' class='uiText'></div>
						<div class='field'><label>联系方式</label><input type='text' name='phone' placeholder='请输入手机或电话号码' class='uiText'></div>
						<div class='field'><label>店址</label><input type='text' name='address' placeholder='请输入商铺的具体地址' class='uiText'></div>
					</fieldset>
					<fieldset class='submit'>
						<input class='uiBtn submit' type='submit' value='申请'>
					</fieldset>
				</form>
			</div>
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
		</div>"
		. '<div class="contentWrapper">'
		."	<ul class='slideshow'>
				<li class='slidePhoto' id='slidePhoto-1'>
					<div class='slidePhotoWrapper'>
						<h2>让校园生活更便捷</h2>
						<p>在线提交打印任务，到店付款领取文档，一切已在行进中完成</p>
						<a href='/blog/tutorial'>了解更多</a>
						<div class='slideshowCtrl'>
							<input type='button' class='uiBtn2' id='signupBtn' value='申请店铺'/>
							<div class='clear'></div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	";
}
function page_profile($badges, $badges_won, $num_orders, $stores) {
	echo "
	<div class='contentWrapper'> 
		<div class='profile'>
			<div class='profileL'>
				<div class='profileType'>
					帐户中心
				</div>
				<ul>
					<li><a href='#0'>我的帐户</a></li>
					<li><a href='#1-1'>基本信息</a></li>
					<li><a href='#1-2'>安全设置</a></li>
					<li style='display: none'><a href='#1-3'>认证中心</a></li>
				</ul>
				<div class='profileType'>
					徽章中心
				</div>
				<ul>
					<li><a href='#2-1'>徽章说明</a></li>
					<li><a href='#2-2'>我的徽章</a></li>
					<li><a href='#2-3'>更多徽章</a></li>
				</ul>
				<div class='profileType'>
					统计中心
				</div>
				<ul>
					<li><a href='#3-1'>消费概要</a></li>
				</ul>
			</div>
			<div class='profileRWrapper'>
			<div class='profileR' id='profile-0'>
				<div class='profileHeader'>我的帐户</div>
				<div class='profileContent'>
					<div class='profileSection'>
						<h2>徽章架</h2>"
						. mod_badge_summary($badges, $badges_won) . "
					</div>
					<div class='profileSection'>
						<h2>零钱罐</h2>"
						. mod_pocket_list($stores) . "
					</div>
				</div>
			</div>
			<div class='profileR' id='profile-1-1'>
				<div class='profileHeader'>基本信息</div>
				<div class='profileContent'>
					<form action='/authorize.php?c=update-name' method='post'>
						<table class='formTable'>
							<tbody>
								<tr>
									<th>用户名</th>
									<td><input type='text' class='uiText2' id='user_login' name='name' title='{$_SESSION['name']}' value='{$_SESSION['name']}' /></td>
								</tr>
								<tr>
									<th></th>
									<td><input type='submit' class='uiBtn3' value='保存设置'></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<div class='profileR' id='profile-1-2'>
				<div class='profileHeader'>安全设置</div>
				<div class='profileContent'>
					<form action='/authorize.php?c=update-password' method='post'>
						<table class='formTable'>
							<tbody>
								<tr>
									<th>邮箱</th>
									<td><input type='text' class='uiText2' value='{$_SESSION['email']}' disabled='disabled'/></td>
								</tr>
								<tr>
									<th>修改密码</th>
									<td><input type='password' class='uiText2' id='pass1' name='passwd'/></td>
								</tr>
								<tr>
									<th>确认密码</th>
									<td><input type='password' class='uiText2' id='pass2'/></td>
								</tr>
								<tr>
									<th></th>
									<td>
										<div id='pass-strength-result'>强度</div>
										<input type='submit' id='pass-confirm' class='uiBtn3' value='修改设置'>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<div class='profileR' id='profile-1-3'>
				<div class='profileHeader'>认证中心</div>
				<div class='profileContent'>
					<form>
						<table class='formTable'>
							<tbody>
								<tr>
									<th>教育邮箱</th>
									<td><input type='text' class='uiText2' name='email'/> @ <select class='uiSelect' name='university'><option value='@pku.edu.cn'>pku.edu.cn (北京大学)</option></select></td>
								</tr>
								<tr>
									<th></th>
									<td><input type='submit' class='uiBtn3' value='获取验证码'/></td>
								</tr>
							</tbody>
						</table>
					</form>
					<form>
						<table class='formTable'>
							<tbody>
								<tr>
									<th>验证码</th>
									<td><input type='text' class='uiText2' name='email'/></td>
								</tr>
								<tr>
									<th></th>
									<td><input type='submit' class='uiBtn3' value='验证教育邮箱'/></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<div class='profileR' id='profile-2-1'>
				<div class='profileHeader'>徽章说明</div>
				<div class='profileContent'>
					<p>用户可以通过完成不同任务获取徽章并增加量子数。部分任务为隐藏任务，触发任务条件后系统将自动通知您。</p>
					<table>
						<table class='badgeTable'>
							<tr>
								<th><div class='badge'><span class='badge1'></span>金质徽章</div></th>
								<td>金质徽章非常稀少，只有做出杰出贡献的用户才能获得它们。</td>
							</tr>
							<tr>
								<th><div class='badge'><span class='badge2'></span>银质徽章</div></th>
								<td>银质徽章奖励给长期使用的用户，它们不常见，但您只需要累计良好的信用记录就能得到。</td>
							</tr>
							<tr>
								<th><div class='badge'><span class='badge3'></span>铜质徽章</div></th>
								<td>铜质徽章奖励给普通用户，它们是很容易得到的。</td>
							</tr>
							<tr>
								<th><div class='badge'>徽章</div> × 数字</th>
								<td>数字表示当前拥有该徽章的用户数。</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
			<div class='profileR' id='profile-2-2'>
				<div class='profileHeader'>我的徽章</div>
				<div class='profileContent'>
					<table class='badgeTable'>
						<tbody>"
						. mod_badge_won($badges, $badges_won) ."
						</tbody>
					</table>
				</div>
			</div>
			<div class='profileR' id='profile-2-3'>
				<div class='profileHeader'>更多徽章</div>
				<div class='profileContent'>
					<table class='badgeTable'>
						<tbody>"
						. mod_badge_rest($badges, $badges_won) . "
						</tbody>
					</table>
				</div>
			</div>
			<div class='profileR' id='profile-3-1'>
				<div class='profileHeader'>消费概要</div>
				<div class='profileContent'>"
					. mod_stat_credit($num_orders, $stores) . "
				</div>
			</div>
			</div>
			<div class='clear'></div>
		</div> 
	</div>";
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
function script_home($stores) {
	$regions = text_defs('store_region');
	foreach($stores as &$n)
		$n['region'] = $regions[$n['region']];
	echo "
<script type='text/javascript'>
/* <![CDATA[ */
var order_option_text = {
	back:	".json_encode_mb(text_defs('order_back')).",
	color:	".json_encode_mb(text_defs('order_color')).",
	layout:	".json_encode_mb(text_defs('order_layout')).",
	misc:	".json_encode_mb(text_defs('order_misc')).",
	paper:	".json_encode_mb(text_defs('order_paper')).",
	region:	".json_encode_mb($regions, JSON_FORCE_OBJECT).",
};
var Vault = {
	\"stores\": ".json_encode($stores, JSON_FORCE_OBJECT).",
	\"option_text\": order_option_text,
};
/* ]]> */
</script>";
}
?>
