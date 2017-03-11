<?
/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2003. 10. 9
 *	�̸��� : kanghoonil@npine.com , hoonil@javastars.com
 *	���ϸ� : lib_ImageConvert.php
 *	
 *	> �Լ� ���� <
 *	array(int �����(1=����, 0=����), string �̹����ҽ�format���, string ��� �޽���) THUMBNAIL_IMAGE_CREATE($image_path, $save_path, $max_with_size=100, $max_height_size=100, $save_format="jpg", $background_color="WHITE", $image_quality=100)
 *	�̹��� ������ �ۼ� �Լ� 
 *	
 *	> �������� ���� <
 *	$image_path				:				���� ���
 *	$save_path				:				���� ���
 *	$max_with_size			:				���� �ִ� ������
 *	$max_height_size		:				���� �ִ� ������
 *	$waterMakeImagePath		:				���͸�ũ �̹���(���� �ִ°�� ����)
 *	$save_format			:				���� ���� ����
 *	$background_color		:				���� �ִ� ������
 *	$image_quality			:				�����
 *	
 -----------------------------------------------------------------------------*/



FUNCTION thumbnailImageCreate($image_path, $save_path, $max_with_size=100, $max_height_size=100, $waterMakeImagePath="", $save_format="jpg", $background_color="WHITE", $image_quality=70){
	
	/**
	 *	���� �̹��� ������ �˾ƿ���
	 *	$image_path_size_info[0]		:		���� �̹��� ���� ������
	 *	$image_path_size_info[1]		:		���� �̹��� ���� ������
	 *	$image_path_size_info[2]		:		���� �̹��� ���� ���
	 *												1 - GIF
	 *												2 - JPG
	 *												3 - PNG
	 *												4 - SWF
	 *													   
	 *	$image_path_size_info[3]		:		���� �̹��� ���ڿ� ex) height="xxx" width="xxx"
	 */
		$image_path_size_info=getimagesize($image_path);
		
		
		/**
		 *	THUMBNAIL IMAGE ������ ����
		 */
		if($image_path_size_info[0] > $image_path_size_info[1]){
				
				/**
				 *	�̹��� ����� width �� height ���� ū���
				 */
				if($image_path_size_info[0] > $max_with_size){
						$save_path_width_size = $max_with_size;
						$save_path_height_size_divided = ($image_path_size_info[0] / $save_path_width_size);
						$save_path_height_size = ($image_path_size_info[1] / $save_path_height_size_divided);
						
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
				
		}else if($image_path_size_info[0] == $image_path_size_info[1]){
				
				/**
				 *	�̹��� ����� width �� height �� ���� ���
				 */
				if($image_path_size_info[0] > $max_with_size){
						$save_path_width_size = $max_with_size;
						$save_path_height_size_divided = ($image_path_size_info[0] / $save_path_width_size);
						$save_path_height_size = ($image_path_size_info[1] / $save_path_height_size_divided);
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
		}else{
				/**
				 *	�̹��� ����� height ��  width ���� ū���
				 */
				if($image_path_size_info[1] > $max_height_size){
						$save_path_height_size = $max_height_size;
						$save_path_width_size_divided = ($image_path_size_info[1] / $save_path_height_size);
						$save_path_width_size = ($image_path_size_info[0] / $save_path_width_size_divided);
				}else{
						$save_path_width_size = $image_path_size_info[0];
						$save_path_height_size = $image_path_size_info[1];
				}
		}
		
		
		/**
		 *	THUMBNAIL IMAGE ������ ������ ��׶��� ���� ����
		 */
		$save_image=ImageCreateTrueColor($save_path_width_size-1, $save_path_height_size-1);
		
		
		/**
		 *	��׶��� ���� ������ ���� �̹��� ��׶��� ���� ��
		 *	�⺻�� : WHITE
		 */
		/*
		switch($background_color){
				case "WHITE":
						$save_image_background_color=ImageColorAllocate($save_image, 255,255,255);
						break;
				case "BLACK":
						$save_image_background_color=ImageColorAllocate($save_image, 0, 0, 0);
						break;
				default :
						return array(0, "!!! ��׶��� ������ �������� ���մϴ�. �ۼ��ڿ��� ���� �Ͻʽÿ� !!!");
		}
		*/
		
		/**
		 *	�����̹����� ���� ���� ����� �о� �ͼ� �̹����� ���� ���� ����� �����Ѵ�.
		 *	�������� $image_path_size_info[2]
		 */
		switch($image_path_size_info[2]){
				case 1 :
							/**
							 *	GIF ���� ����
							 */	
							$source_image=ImageCreateFromGIF($image_path);
							$source_format="gif";
							break;
				case 2 :
							/**
							 *	JPG ���� ����
							 */
							$source_image=ImageCreateFromJPEG($image_path);
							$source_format="jpg";
							break;
				case 3 :
							/**
							 *	PNG ���� ����
							 */
							$source_image=ImageCreateFromPNG($image_path);
							$source_format="png";
							break;
				default :
							/**
							 *	GIF, JPG, PNG ���˹���� �ƴҰ�� ���� ���� ���� �� ����
							 */
							return array(0, $source_format, "!!! �����̹����� GIF, JPG, PNG ���� ����� ��s�Ͼ �̹��� ������ �о�� �� �����ϴ�. !!!");
		}
		
		
		/**
		 *	�̹��� ������ �Ҽ��� �ڸ� ����
		 */
		$save_path_width_size = round($save_path_width_size);
		$save_path_height_size = round($save_path_height_size);
		
		
		/**
		 *	$save_image=ImageCreate($save_path_width_size, $save_path_height_size) �κп� �����̹����� ���� ���纻�� �׸���.
		 *	$arg1		:		ImageCreateTrueColor ���� ����(�ٿ��ֱ� �� �̹���)
		 *	$arg2		:		ImageCreateFromXXX ���� ����(������ �̹���)
		 *	$arg3		:		�ٿ��ֱ� �� �̹����� X ������
		 *	$arg4		:		�ٿ��ֱ� �� �̹����� Y ������
		 *	$arg5		:		������ �̹����� X ������
		 *	$arg6		:		������ �̹����� Y ������
		 *	$arg7		:		�ٿ��ֱ� �� �̹����� X ����
		 *	$arg8		:		�ٿ��ֱ� �� �̹����� Y ����
		 *	$arg9		:		������ �̹����� X ����
		 *	$arg10		:		������ �̹����� Y ����
		 */
		 // 2004-03-10  ImageCopyResized �Լ���  ImageCopyResampled �Լ��� ��ü
//		if(ImageCopyResized($save_image ,$source_image, 0, 0, 0, 0, $save_path_width_size, $save_path_height_size, ImageSX($source_image), ImageSY($source_image))){
		if(ImageCopyResampled($save_image ,$source_image, 0, 0, 0, 0, $save_path_width_size, $save_path_height_size, ImageSX($source_image), ImageSY($source_image))){
				/**
				 *	������ �̹����� ���˹�� ���� �⺻�� jpg
				 */
				switch($save_format){
						case "jpg"	:
						case "jpeg"	:
						case "JPG"	:
						case "JPEG"	:
										if(ImageJPEG($save_image, $save_path, $image_quality)){
												#####----- ���͸�ũó�� üũ -----#####
												if($waterMakeImagePath){
														#####----- ���͸�ũ ó�� �Լ� ȣ�� -----#####
														$waterMakeResult = imageWaterMaking($save_path, $waterMakeImagePath);
														if($waterMakeResult[0]){
																return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path JPG ���� �̹��� ���� - ���͸�ũó��");
														}else{
																return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size JPG ���� �̹��� ������ ���� �߽��ϴ� - ���� : ��Ŀ��ũó������. !!!");
														}
												}else{
														return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path JPG ���� �̹��� ����");
												}
										}else{
												return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size JPG ���� �̹��� ������ ���� �߽��ϴ�. !!!");
										}
								break;
								
						case "png"	:
						case "PNG"	:
										if(ImagePNG($save_image, $save_path, $image_quality)){
												#####----- ���͸�ũó�� üũ -----#####
												if($waterMakeImagePath){
														#####----- ���͸�ũ ó�� �Լ� ȣ�� -----#####
														$waterMakeResult = imageWaterMaking($save_path, $waterMakeImagePath);
														if($waterMakeResult[0]){
																return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path PNG ���� �̹��� ���� - ���͸�ũó��");
														}else{
																return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size PNG ���� �̹��� ������ ���� �߽��ϴ� - ���� : ��Ŀ��ũó������. !!!");
														}
												}else{
														return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path PNG ���� �̹��� ����");
												}
										}else{
												return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size PNG ���� �̹��� ������ ���� �߽��ϴ�. !!!");
										}
								break;
						case "gif";
						case "GIF";
										if(ImageGIF($save_image, $save_path, $image_quality)){
												#####----- ���͸�ũó�� üũ -----#####
												if($waterMakeImagePath){
														#####----- ���͸�ũ ó�� �Լ� ȣ�� -----#####
														$waterMakeResult = imageWaterMaking($save_path, $waterMakeImagePath);
														if($waterMakeResult[0]){
																return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path GIF ���� �̹��� ���� - ���͸�ũó��");
														}else{
																return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size GIF ���� �̹��� ������ ���� �߽��ϴ� - ���� : ��Ŀ��ũó������. !!!");
														}
												}else{
														return array(1, $source_format, "$save_path_width_size * $save_path_height_size $save_path GIF ���� �̹��� ����");
												}
										}else{
												return array(0, $source_format, "!!! $save_path_width_size * $save_path_height_size GIF ���� �̹��� ������ ���� �߽��ϴ�. !!!");
										}
								break;
						default :
								return array(0, $source_format, "!!! �Է��Ͻ� ���� �̹����� �������� �ʽ��ϴ�. !!!");
				}
		}else{
				return array(0, $source_format, "!!! ImageCopyResized �Լ� ����� ������ �߻��߽��ϴ�. !!!");
		}
}



/*----------------------------------------------------------------------------- 
 *	������ : ������
 *	������ : 2004. 1. 6
 *	�̸��� : kanghoonil@npine.com , hoonil@javastars.com
 *	���ϸ� : lib_ImageConvert.php
 *	
 *	> �Լ� ���� <
 *	���͸�ũ ó�� �Լ�
 *	
 *	> �������� ���� <
 *	$imagePath				:		���͸�ũ�� ó���� �̹���
 *	$waterMakeSourceImage	:		���͸�ũ �̹���
 *	$ARGimageQuality		:		�̹��� ����Ƽ
 *	
 -----------------------------------------------------------------------------*/
FUNCTION imageWaterMaking($ARGimagePath, $ARGwaterMakeSourceImage, $ARGimageQuality = 70){
		#####----- �̹��� ���� �������� -----#####
		$getSourceImageInfo = GETIMAGESIZE($ARGimagePath);
		#####----- ���� �̹��� �˻� -----#####
		if(!$getSourceImageInfo[0]){
				return ARRAY(0, "!!! ���� �̹����� �������� �ʽ��ϴ�. !!!");
		}
		$getwaterMakeSourceImageInfo = GETIMAGESIZE($ARGwaterMakeSourceImage);
		#####----- ���͸�ũ �̹��� �˻� -----#####
		if(!$getwaterMakeSourceImageInfo[0]){
				return ARRAY(0, "!!! ���͸�ũ �̹����� �������� �ʽ��ϴ�. !!!");
		}
		
		#####----- ���� �̹��� ����(�ε�) -----#####
		switch($getSourceImageInfo[2]){
				case 1 :	#####----- GIF ���� ���� -----#####
							$sourceImage = IMAGECREATEFROMGIF($ARGimagePath);
							break;
				case 2 :	#####----- JPG ���� ���� -----#####
							$sourceImage = IMAGECREATEFROMJPEG($ARGimagePath);
							break;
				case 3 :	#####----- PNG ���� ���� -----#####
							$sourceImage = IMAGECREATEFROMPNG($ARGimagePath);
							break;
				default :	#####----- GIF, JPG, PNG ���˹���� �ƴҰ�� ���� ���� ���� �� ���� -----#####
							return array(0, "!!! �����̹����� GIF, JPG, PNG ���� ����� �ƴϾ �̹��� ������ �о�� �� �����ϴ�. !!!");
		}
		
		#####----- ���͸�ũ �̹��� ����(�ε�) -----#####
		switch($getwaterMakeSourceImageInfo[2]){
				case 1 :	#####----- GIF ���� ���� -----#####
							$waterMakeSourceImage = IMAGECREATEFROMGIF($ARGwaterMakeSourceImage);
							break;
				case 2 :	#####----- JPG ���� ���� -----#####
							$waterMakeSourceImage = IMAGECREATEFROMJPEG($ARGwaterMakeSourceImage);
							break;
				case 3 :	#####----- PNG ���� ���� -----#####
							$waterMakeSourceImage = IMAGECREATEFROMPNG($ARGwaterMakeSourceImage);
							break;
				default :	#####----- GIF, JPG, PNG ���˹���� �ƴҰ�� ���� ���� ���� �� ���� -----#####
							return array(0, "!!! ���͸�ũ�̹����� GIF, JPG, PNG ���� ����� �ƴϾ �̹��� ������ �о�� �� �����ϴ�. !!!");
		}
		
		
		#####----- ���͸�ũ ��ġ ���ϱ�(�߾ӿ� ���͸�ũ ����) -----#####
		$waterMakePositionWidth = ($getSourceImageInfo[0] - $getwaterMakeSourceImageInfo[0]) / 2;
		$waterMakePositionHeight = ($getSourceImageInfo[1] - $getwaterMakeSourceImageInfo[1]) / 2;
		
		#####----- �̹��� �׸��� -----#####
		/**
		 *	$save_image=ImageCreate($save_path_width_size, $save_path_height_size) �κп� �����̹����� ���� ���纻�� �׸���.
		 *	$arg1		:		ImageCreateTrueColor ���� ����(�ٿ��ֱ� �� �̹���)
		 *	$arg2		:		ImageCreateFromXXX ���� ����(������ �̹���)
		 *	$arg3		:		�ٿ��ֱ� �� �̹����� X ������
		 *	$arg4		:		�ٿ��ֱ� �� �̹����� Y ������
		 *	$arg5		:		������ �̹����� X ������
		 *	$arg6		:		������ �̹����� Y ������
		 *	$arg7		:		�ٿ��ֱ� �� �̹����� X ����
		 *	$arg8		:		�ٿ��ֱ� �� �̹����� Y ����
		 *	$arg9		:		������ �̹����� X ����
		 *	$arg10		:		������ �̹����� Y ����
		 */
		IMAGECOPYRESIZED($sourceImage, $waterMakeSourceImage, $waterMakePositionWidth, $waterMakePositionHeight, 0, 0, ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage), ImageSX($waterMakeSourceImage), ImageSY($waterMakeSourceImage));
		
		#####----- �̹��� ���� -----#####
		switch($getSourceImageInfo[2]){
				case 1 :	#####----- GIF ���� ���� -----#####
							if(IMAGEGIF($sourceImage, $ARGimagePath, $ARGimageQuality)){
									return ARRAY(1, "GIF ���� ���͸�ũ �̹����� ó�� �Ǿ����ϴ�.");
							}else{
									return ARRAY(0, "GIF ���� ���͸�ũ �̹����� ó�� ���� ������ �߻��߽��ϴ�.");
							}
							break;
				case 2 :	#####----- JPG ���� ���� -----#####
							if(IMAGEJPEG($sourceImage, $ARGimagePath, $ARGimageQuality)){
									return ARRAY(1, "JPG ���� ���͸�ũ �̹����� ó�� �Ǿ����ϴ�.");
							}else{
									return ARRAY(0, "JPG ���� ���͸�ũ �̹����� ó�� ���� ������ �߻��߽��ϴ�.");
							}
							break;
				case 3 :	#####----- PNG ���� ���� -----#####
							if(IMAGEPNG($sourceImage, $ARGimagePath, $ARGimageQuality)){
									return ARRAY(1, "PNG ���� ���͸�ũ �̹����� ó�� �Ǿ����ϴ�.");
							}else{
									return ARRAY(0, "PNG ���� ���͸�ũ �̹����� ó�� ���� ������ �߻��߽��ϴ�.");
							}
							break;
				default :	#####----- GIF, JPG, PNG ���˹���� �ƴҰ�� ���� ���� ���� �� ���� -----#####
							return ARRAY(0, "!!! ������ũ�̹����� GIF, JPG, PNG ���� ����� �ƴϾ �̹��� ������ �о�� �� �����ϴ�. !!!");
		}
		
		
}

?>
