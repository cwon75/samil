if (REQUIRE_ONCE_COMMON == null)
{
	// 한번만 실행되게
	var REQUIRE_ONCE_COMMON = true;
	
	// 숫자 포맷
	function number_format(numString) { 
		alert(numString);
		var arrStr = numString.split('.'); 
		var re = /(-?\d+)(\d{3})/; 
		
		while (re.test(arrStr[0])) { 
			arrStr[0] = arrStr[0].replace(re, "$1,$2"); 
		} 
		
		if(arrStr[1]) { 
			return arrStr[0] +'.' + arrStr[1]; 
		} else { 
			return arrStr[0]; 
		} 
	} 

	
	// 삭제 검사 확인
	function confirm_del(href) 
	{
		if(confirm("정말 삭제하시겠습니까?")) 
				document.location.href = href;
	}

	// 체크박스의 값을 변경한다.
	function set_checkbox(form,fname,val) {
		var chk_count=0;
		for(i=0;i<form.length;i++) {
			if(form[i].type=="checkbox" && form[i].name==fname) {
				if(val=='inv') {
					form[i].checked=!form[i].checked;
				} else {
					form[i].checked=val;
				}
				chk_count++;
			}
		}
		return chk_count;
	}

	// 체크박스에 하나라도 val값과 일치라면 참
	function chk_checkbox(form,fname,val) {
		var Check_List=false;
		for(i=0;i<form.length;i++) {
			if(form[i].type=="checkbox" && form[i].name==fname) {
				if(form[i].checked==val) Check_List=true;
			}
		}
		return Check_List;
	}
	
	// open 함수 재정의
	function window_open() {
		var a=window_open.arguments;
		if(a.length==1)
			window.open(a[0]);
		else if(a.length==2)
			window.open(a[0],a[1]);
		else
			window.open(a[0],a[1],a[2]);
	}
	
	// 우편번호검색
	function search_post(url_path,form_info) {
		window_open(url_path+'search_post.php?form_info='+form_info,'search_post','scrollbars=yes,width=470,height=400');
	}
	
	// 아이디중복확인
	function search_mb_id(url_path,form_info,mb_id) {
		window_open(url_path+'search_id.php?form_info='+form_info+'&mb_id='+mb_id,'search_id','top=200,left=300,width=400,height=250,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0');
	}

	// 닉네임중복확인
	function search_mb_nick(url_path,form_info,mb_nick) {
		window_open(url_path+'search_nick.php?form_info='+form_info+'&mb_nick='+mb_nick,'search_nick','top=200,left=300,width=400,height=250,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0');
	}
	
	// 쪽지쓰기
	function note_write(url_path,recv_id) {
		window_open(url_path+'note_write.php?recv_id='+recv_id,'note_write','scrollbars=no,width=370,height=380');
	}
	
	// 쪽지보기
	function note_view(url_path,mode,num) {
		window_open(url_path+'note_view.php?mode='+mode+'&num='+num,'note_view','scrollbars=no,width=370,height=380');
	}
	
	function login_naver() {
		window_open(member_url+'oauth-api/login_with_naver.php')
	}
	function login_google() {
		window_open(member_url+'oauth-api/login_with_google.php')
	}
	function login_facebook() {
		window_open(member_url+'oauth-api/login_with_facebook.php')
	}
	function login_twitter() {
		window_open(member_url+'oauth-api/login_with_twitter.php')
	}
	
	// 상위태그 검색해서 객체 반환
	function find_parent_tag(e,tag)
	{
		if(e.target)
			var obj = e.target
		else
			var obj = e.srcElement
		while (obj.tagName.toLowerCase() != tag)
		{
			if(obj.parentNode)
				obj = obj.parentNode
			else
				obj = obj.parentElement
			if(typeof(obj.tagName)=='undefined') break;
		}
		return obj
	}
	
	var list_tmp_color="";
	// 리스트위에 마우스 올라 갔을 경우 색상변환
	function list_over_color(e,color,title_idx) {
		var obj=find_parent_tag(e,'tr');
		if(!obj.style) return;
		var idx = obj.rowIndex;
		if(idx>=title_idx)	 {
			list_tmp_color=obj.style.backgroundColor;
			obj.style.backgroundColor=color
		}
	}
	function list_out_color(e) {
		var obj=find_parent_tag(e,'tr');
		if(obj.style) obj.style.backgroundColor=list_tmp_color
	}
	
	var list_tmp_color2="";
	// 리스트위에 마우스 올라 갔을 경우 색상변환
	function list_over_color2(e,color) {
		var obj=find_parent_tag(e,'li');
		if(!obj.style) return;
		list_tmp_color2=obj.style.backgroundColor;
		obj.style.backgroundColor=color
	}
	function list_out_color2(e) {
		var obj=find_parent_tag(e,'li');
		if(obj.style) obj.style.backgroundColor=list_tmp_color2
	}
	
	// 토글함수
	function toggle_display_object() {
		var a=toggle_display_object.arguments;
		var target=a[0];
		var disp=a[1];
		var on=a[2];
		var off=a[3];
		if(target.style.display=='') {
			target.style.display='none';
			disp.innerHTML=off;
		} else {
			target.style.display='';
			disp.innerHTML=on;
		}
	}
	
	
	// 글보기에서 이미지 처리를 위한 부분
	var img_width=Array();
	var img_height=Array();
	var img_array=Array();
	var img_width_obj;
	var img_width_adj;
	
	function set_img_width_init(p_obj,width_adj) {
		jQuery.each($('.view_image'),function(index,value){
			img_width[index]=$(this).width();
			img_height[index]=$(this).height();
			img_array[index]=this;
			$(this).bind('click',function () { view_image_popup(this); });
			$(this).css("cursor","pointer");
		});
		if(p_obj) {
			img_width_obj = p_obj;
		} else {
			img_width_obj = $(img_array[0]).parent();
		}
		if(width_adj) {
			img_width_adj = width_adj;
		} else {
			img_width_adj = -5;
		}
		set_width_img();
		jQuery(this).bind('resize',set_width_img);
	}
	
	function set_width_img(){
		if(img_array.length>0) {
			for(i=0;i<img_array.length;i++){ 
				var pwidth = $(img_width_obj).innerWidth() + img_width_adj;
				if(img_width[i] > pwidth) {
					$(img_array[i]).width(pwidth);
					$(img_array[i]).height(img_height[i] / ( img_width[i] / pwidth ));
				} else {
					$(img_array[i]).width(img_width[i]);
					$(img_array[i]).height(img_height[i]);
				}
			}
		}
	}
	
	function view_image_popup(img) {
		var img_window=window.open('',img_window,'scrollbars=yes,resizable=yes,width=100,height=100');
		if(img_window) {
			img_window.document.open();
			img_window.document.writeln('<html>');
			img_window.document.writeln('<title>이미지보기</title>');

			img_window.document.writeln('<scr'+'ipt>');
			img_window.document.writeln('function load_image() {');
			img_window.document.writeln('if((view_image.width+30)>(screen.width-5)) ');
			img_window.document.writeln('imgWidth=screen.width-5;');
			img_window.document.writeln('else');
			img_window.document.writeln('imgWidth=view_image.width+30;');
			
			img_window.document.writeln('if((view_image.height+55)>(screen.height-30)) ');
			img_window.document.writeln('imgHeight=screen.height-30;');
			img_window.document.writeln('else');
			img_window.document.writeln('imgHeight=view_image.height+55;');
			
			img_window.document.writeln('var x=screen.width/2-imgWidth/2;');
			img_window.document.writeln('var y=(screen.height-30)/2-imgHeight/2;');
			img_window.document.writeln('self.resizeTo(imgWidth,imgHeight);');
			img_window.document.writeln('self.moveTo(x,y);');			
			img_window.document.writeln('}');
			img_window.document.writeln('</scr'+'ipt>');

			img_window.document.writeln('<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">');
			img_window.document.writeln('<img src="'+img.src+'" id="view_image" onclick="self.close()" style="cursor:hand;" onload="load_image()">');
			img_window.document.writeln('</body>');
			img_window.document.writeln('</html>');
			img_window.document.close();
		}
	}
	

	var layername = 'rg_layer_div'

	function rg_layer_action(name, status)
	{
		var obj = document.getElementById(name);

		if (typeof(obj) == 'undefined') {
			return;
		}

		if (status) {
			obj.style.visibility = status;
		} else {
			if(obj.style.visibility == 'visible')
				obj.style.visibility='hidden';
			else
				obj.style.visibility='visible';
		}
	}

	var bbs_url = '';
	var member_url = '';
	var skin_url = '';

	function set_url(bbs,member,skin) {
		if(bbs!='') bbs_url=bbs;
		if(member!='') member_url=member;
		if(skin!='') skin_url=skin;
	}

	function rg_bbs_layer(bbs_code,num,name,id,homepage,email,profile,memo,e)
	{
		// event.clientX : 클릭한곳의 X 좌표
		// event.clientY : 클릭한곳의 Y 좌표
		// obj.offsetWidth  : DIV 오브젝트의 폭
		// obj.offsetHeight : DIV 오브젝트의 높이
		// document.body.clientWidth  : 브라우저의 폭
		// document.body.clientHeight : 브라우저의 높이
		// document.body.scrollLeft : 스크롤 Left
		// document.body.scrollTop  : 스크롤 Top
		// obj.style.posLeft : DIV 오브젝트의 X 좌표
		// obj.style.posTop  : DIV 오브젝트의 Y 좌표

		var obj = document.getElementById(layername);
		var x, y;
		var body = "";
		var height = 0;
		if(!e) e=window.event;
		if(document.documentElement.scrollLeft)	{
			x = e.clientX + document.documentElement.scrollLeft - 20;
			y = e.clientY + document.documentElement.scrollTop - 20;
		} else {
			x = e.clientX + document.body.scrollLeft - 20;
			y = e.clientY + document.body.scrollTop - 20;
		}
		obj.style.left = x+'px';
		obj.style.top = y+'px';
		
	
		if (name) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"location.href='"+bbs_url+"list.php?bbs_code="+bbs_code+"&ss[sn]=1&kw="+name+"';\"><td height=20>&nbsp; <IMG src="+skin_url+"images/namesearch_icon.gif border=0 width='12' height='12'> &nbsp;이름으로 검색&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (homepage) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+bbs_url+"layer_action.php?mode=homepage&data="+homepage+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/home_icon.gif border=0 width='12' height='12'> &nbsp;홈페이지&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (email) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+bbs_url+"layer_action.php?mode=email&data="+email+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/home_icon.gif border=0 width='12' height='12'> &nbsp;이메일&nbsp;&nbsp;</td></tr>";
			height += 20;
		}
		
		if (profile && id) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+member_url+"view_profile.php?mb_id="+id+"','profile','left=50,top=50,width=550,height=500,scrollbars=1');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/home_icon.gif border=0 width='12' height='12'> &nbsp;회원정보&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (memo && id) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"note_write('"+member_url+"','"+id+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"images/memo_icon.gif border=0 width='12' height='12'> &nbsp;쪽지보내기&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (body) {
			var layer_body = "<table border=0 width=100%><tr><td colspan=3 height=10></td></tr><tr><td width=5></td><td bgcolor=222222 style='cursor:pointer'><table border=0 cellspacing=0 cellpadding=3 width=100% height=100% bgcolor=e5e5e5>"+body+"</table></td><td width=10></td></tr><tr><td colspan=3 height=10></td></tr></table>";
			obj.innerHTML = layer_body;
			obj.style.width = '150px';
			obj.style.height = height+'px';
			obj.style.visibility='visible';
		}
	}


	function rg_init_layer(layername)
	{
		document.writeln("<div id="+layername+" style='position:absolute; left:1px; top:1px; width:1px; height:1px; z-index:1; visibility: hidden' onmousedown=\"rg_layer_action('"+layername+"', 'hidden')\" onmouseout=\"rg_layer_action('"+layername+"', 'hidden')\" onmouseover=\"rg_layer_action('"+layername+"', 'visible')\">");
		document.writeln("</div>");
	}
	
	rg_init_layer('rg_layer_div');	
}