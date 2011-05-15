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
 				<dl id='credit'>
 					<dt>积分</dt>
 					<dd id='credit0'>{$_SESSION['credit'][0]}</dd>
 					<dd id='credit1'>{$_SESSION['credit'][0]}</dd>
 				</dl>
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
				<div class='w6h3 ltCorner rtCorner'>
					<div style='float: left'>页数估计</div>
					<div style='float: right'>打印份数</div>
					<div class='clear'></div>
				</div>
				<div class='w6content'>
					<div class='dynos-copy'>
						<p></p>
						<p>请估计上传文件的页数</p>
						<p>无需考虑单双面设置与版式放缩</p>
					</div>
					<div class='slider'>
			            <div id='dynos-slider-container'>
							<div id='dynos-slider' class='ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all'>
							</div>
			            </div>
			            <div id='workers-slider-container'>
			            	<div id='workers-slider' class='ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all'>
			            	</div>
			            </div>
					</div>
		          	<div class='workers-copy'>
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
	         		<div class='clear'></div>
				</div>
				<div class='w6confirm'>
					<div class='w6h3a'>
						积分使用说明
						<input type='button' id='w6ConfirmBtn' class='uiBtn2 w6item' value='确认页数与份数' />
					</div>
					<p>
						在估计文档页数并选择打印份数的同时，积分也相应扣去，这部分积分用来作为信用担保，用户前往打印店交款结账后将归还对应积分。<br>
						积分不足可能导致打印店拒绝订单，届时系统会发出通知，请您到打印店下载已上传的文档进行自助打印。
					</p>
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
					<input type='text' id='q' name='q' placeholder='搜索' class='uiSearch'>
					<div class='msgBox panel0'>
						<h2 class='ltCorner rtCorner'>通知<span id='unread'>10</span></h2>
						<ul class='unreadContent'>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>2</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>我知道了</span>
							</li>
							<li>
								<span class='msgId'>1</span>
								辅导教师克里夫介绍到了看风景刻录速度交罚款乐山大佛揭开了<span class='msgClose'>去看看</span>
							</li>
						</ul>
					</div> 
				</div>
				<div class='panel0 taskQueueR'>
					<h2>任务队列</h2>
					<div id='taskAccordion'>"
					. mod_order_queue($orders) . "
					</div>
					<h2 class='lbCorner rbCorner'></h2>
				</div>
				<div class='clear'></div>
			</div> 
			<form id='formOrder' accept-charset='UTF-8'>
				<input type='hidden' id='w2Form' name='pid' value='' />
				<input type='hidden' id='w3Form1' name='paper' value='' />
				<input type='hidden' id='w3Form2' name='color' value='' />
				<input type='hidden' id='w4Form' name='back' value='' />
				<input type='hidden' id='w5Form' name='layout' value='' />
				<input type='hidden' id='w6Form2' name='page' value='' />
				<input type='hidden' id='w6Form1' name='copy' value='' />
				<input type='hidden' id='w7Form' name='misc' value='' />
				<input type='hidden' id='w8Form' name='note' />
				<input type='hidden' id='w9Form' name='guarantee'/>
				<input type='hidden' name='fid'/>
				<input type='hidden' name='fname'/>
			</form>
		</div>
		<iframe name='ifr_upload' class='outcast init'></iframe>";
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
