<?php

/*
* Custom Ajax Pagination for codeigniter search
*/

  class Ajax_pagination
  {
	public $total;
	public $anchors;
	
	function __construct()
	{
	  ///constructior
	}
	function __destruct()
	{
	  ////destructior
	}
    
	function make_search($numrows,$starting,$recpage,$first_lb,$last_lb,$previous_lb,$next_lb,$page_lb,$of_lb,
	 $total_lb,$page_p,$div_p,$str_post)
	{
	
			//ajax pagination preparation
			$next           =    $starting+$recpage;
			$var            =    ((intval($numrows/$recpage))-1)*$recpage;
			$page_showing   =    intval($starting/$recpage)+1;
			$total_page     =    ceil($numrows/$recpage);

			if($numrows % $recpage != 0){
				$last = ((intval($numrows/$recpage)))*$recpage;
			}else{
				$last = ((intval($numrows/$recpage))-1)*$recpage;
			}
			
			/*ajax funcition js parrams
			* url,divname,starting,string post
			*/
			//calculate previous link
			$previous = $starting-$recpage;
			$anc = "<ul id='pagination-flickr'>";
			if($previous < 0){
				$anc .= "<li class='previous-off'>".$first_lb."</li>";
				$anc .= "<li class='previous-off'>".$previous_lb."</li>";
			}else{
				$anc .= "<li class='next'><a href='#/".$first_lb."' onclick=\"javascript:load_page_pagination('$page_p','$div_p','0','$str_post');\">".$first_lb." </a></li>";
				$anc .= "<li class='next'><a href='#/".$previous_lb."' onclick=\"javascript:load_page_pagination('$page_p','$div_p','$previous','$str_post');\">".$previous_lb." </a></li>";
			}
			
			################If you dont want the numbers just comment this block###############    
			$norepeat = 4;//no of pages showing in the left and right side of the current page in the anchors 
			$j = 1;
			$anch = "";
			for($i=$page_showing; $i>1; $i--){
				$fpreviousPage = $i-1;
				$page = ceil($fpreviousPage*$recpage)-$recpage;
				$anch = "<li><a href='#/".$fpreviousPage."' onclick=\"javascript:load_page_pagination('$page_p','$div_p','$page','$str_post');\" >$fpreviousPage </a></li>".$anch;
				if($j == $norepeat) break;
				$j++;
			}
			$anc .= $anch;
			$anc .= "<li class='active'>".$page_showing."</li>";
			$j = 1;
			for($i=$page_showing; $i<$total_page; $i++){
				$fnextPage = $i+1;
				$page = ceil($fnextPage*$recpage)-$recpage;
				$anc .= "<li><a href='#/".$fnextPage."' onclick=\"javascript:load_page_pagination('$page_p','$div_p','$page','$str_post');\" >$fnextPage</a></li>";
				if($j==$norepeat) break;
				$j++;
			}
			############################################################
			if($next >= $numrows){
				$anc .= "<li class='previous-off'>".$next_lb."</li>";
				$anc .= "<li class='previous-off'>".$last_lb."</li>";
			}else{
				$anc .= "<li class='next'><a onclick=\"javascript:load_page_pagination('$page_p','$div_p','$next','$str_post');\" href='#/".$next_lb."'>".$next_lb." </a></li>";
				$anc .= "<li class='next'><a href='#/".$last_lb."' onclick=\"javascript:load_page_pagination('$page_p','$div_p','$last','$str_post');\">".$last_lb."</a></li>";
			}
				$anc .= "</ul>";
				
			//assaign anchors to the public accessable variable
			$this->anchors = $anc;
			//assaign total record details
			$this->total = "".$page_lb." : $page_showing <i> ".$of_lb."  </i> $total_page . ".$total_lb.": $numrows";
	  } 
	 
  }
?>