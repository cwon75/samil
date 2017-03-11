<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================
	프로그램명 : 삼일교회 V4
	화일명 : form_class.php (form 출력을 위한 클래스)
  작성일 : 2007. 7. 24
  작성자 : 윤범석 ( http://rgboard.com )
  작성자 E-Mail : master@rgboard.com
	
	input태그를 좀더 쉽게 생성하기 위해 제작 차후 개발예정
	
	최종수정일 : 
 ===================================================== */
 
if (!defined('HTML_FORM_INC_INCLUDED')) 
{
	define('HTML_FORM_INC_INCLUDED', 1);
// *-- HTML_FORM_INC_INCLUDED START --*
	class html_form
	{
		// input 태그 기본값
		var $type; // 공용
		var $size;
		var $maxlength;
		var $value;
		var $class;
		
		var $cols; // textarea 용
		var $rows;
		
		var $hname; // validata 추가
		var $option;
		var $span;
		var $required;
		
		var $method; // form 태그용
		var $action;
//		var $onsubmit;
		var $enctype;
		
		function clear()
		{
			$this->type='text';
			$this->size='20';
			$this->maxlength='';
			$this->value='';
			$this->class='';
			
			$this->cols='';
			$this->rows='';
			
			$this->hname='';
			$this->option='';
			$this->span='';
			$this->required=0;
			
			$this->method='POST';
			$this->action='';
			$this->enctype='';
		}
		
		function html_form() {
			$this->clear();
		}
		
		function input($type,$options,$value) {
			$options=explode(',',$options);
			foreach ($options as $option) {
				$tag=explode('=',$option);
			}
		}
	} 
} // *-- HTML_FORM_INC_INCLUDED END --*
?>