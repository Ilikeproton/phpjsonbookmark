<?php
//设置
	$sok['json_name']='json';
	//$PASSWORD='654321';   //  index.php?r=edit 是编辑页面，需要密码登陆。没完善。
	
	
//--head标签seo优化
	$sok['title']='Re从零开始导航';
	$sok['description']='Bootstrap,jquery,php,nosql,json,Navigation,bookmark,导航';
	$sok['keywords']='Bootstrap,jquery,php,nosql,json,Navigation,bookmark,导航';
	$sok['og_site_name']='Re从零开始导航';//网站名称
	$sok['og_type']='website';
	$sok['og_image']='';//网页快照
	$sok['og_url']='';
	$sok['canonical']='';//
//--head标签seo优化




////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
//++++++++++++++++++++++++++++以下不需要修改++++++++++++++++++++++++++++++++//
////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

//++++++++++++++++++++++++++++密码登陆修改页面++++++++++++++++++++++++++++++//
////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
if($PASSWORD && $_REQUEST["r"]=='edit') {
	session_start();
	if(!$_SESSION['_sfm_allowed_2']) {
		// sha1, and random bytes to thwart timing attacks.  Not meant as secure hashing.
		$t = bin2hex(openssl_random_pseudo_bytes(10));
		if($_POST['p'] && sha1($t.$_POST['p']) === sha1($t.$PASSWORD)) {
			$_SESSION['_sfm_allowed_2'] = true;
			header('Location: ?');
		}
		echo '<html><body><form action=? method=post>PASSWORD:<input type=password name=p /></form></body></html>';
		exit;
	}
}
//++++++++++++++++++++++++++++json 获取数据+++++++++++++++++++++++++++++++++//
////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
			$sok['json'] = file_get_contents(dirname(__FILE__).'/'.$sok['json_name']);
			$sok['json_decode'] = json_decode($sok['json']);
		
			foreach ($sok['json_decode'] as $tmp):
				$sok['data_with_id'][$tmp->id]=$tmp;
			endforeach;

			foreach ($sok['json_decode'] as $tmp):
				if(!$tmp->url and $tmp->parentId=='1'){
					$sok['data_top_dir_array'][]= $tmp->id;	//所有一级目录
				}
			endforeach;

			foreach ($sok['json_decode'] as $tmp){
				if(!$tmp->url and in_array($tmp->parentId, $sok['data_top_dir_array'])   ){
					$sok['data_second_dir_array'][]=$tmp->id;		//所有二级目录
					//$calup_dir_two[]
					$sok['data_first_and_second_dir_array'][$tmp->parentId][]=$tmp->id ;	 //所有一级目录和二级目录array
				}
			}
			
			foreach ($sok['json_decode'] as $tmp){
				if(!$tmp->url and in_array($tmp->parentId, $sok['data_second_dir_array'])   ){
					$sok['data_third_dir_array'][]=$tmp->id;		//所有三级目录
					$sok['data_second_and_three_dir_array'][$tmp->parentId][]= $tmp->id ;	 //所有二级目录+ 三级目录
				}
			}
////++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
//++++++++++++++++++++++++++++json 获取数据结束+++++++++++++++++++++++++++++//

?><html lang="en">
  <head>
	<meta charset="utf-8">
	<title><?php echo $sok['title'];?></title>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="canonical" href="<?php echo $sok['canonical'];?>">
    <!--  Normal tags -->
	<meta name="title" content="<?php echo $sok['title'];?>">
	<meta name="description" content="<?php echo $sok['description'];?>">
	<meta name="keywords" content="<?php echo $sok['keywords'];?>">
	<meta name="robots" content="index, follow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="English">
    <!-- openG tags -->
	<meta property="og:title" content="<?php echo $sok['title'];?>">
	<meta property="og:site_name" content="<?php echo $sok['og_site_name'];?>">
	<meta property="og:url" content="<?php echo $sok['og_url'];?>">
	<meta property="og:description" content="<?php echo $sok['description'];?>">
	<meta property="og:type" content="<?php echo $sok['og_type'];?>">
	<meta property="og:image" content="<?php echo $sok['og_image'];?>">

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	crossorigin="anonymous"></script>

	<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
	
	<!-- data  -->	
	<link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <style>
	.bd-placeholder-img {font-size: 1.125rem;text-anchor: middle;-webkit-user-select: none;-moz-user-select: none;user-select: none;      }
	@media (min-width: 768px) {        .bd-placeholder-img-lg {          font-size: 3.5rem;        }      }
	
	html a{color:rgba(0,0,0,0.65);}
	#navbar_icon{    right: 0.2em;   top: 0.2em;background: #343a40;}	 
	.navbar-brand { margin:0}
	.sidebarMenu{ padding:0 0 0 0.8em:}
	.dropdown-menu {    position: relative;border: 0; margin:0;padding:0 }
	.dropdown-menu .dropdown-item{padding:0 0 0 0.5em}
	#sidebarMenu{padding: 0 0 0 1em;}
	.nav-item a,.sok_dropdown a{color:#111;font-weight:600}
	ul.sok_dropdown_menu li a{color:#444;font-weight:400}
	.sok_dropdown_menu li a.sok_nav_link{color:#777;font-weight:200}
	.sok_dropdown{margin:0}
	
	.sok_dropdown_menu{margin:0;    list-style: none;padding: 0 0 0 0.2em; display:none;}
	ul.sok_dropdown_menu li ul.sok_dropdown_menu {margin: 0 0 0 0.5em;}
	.sok_dropdown_item{margin:0}
	.sok_nav_link{ margin:0; padding:0;}	
	
	#maintable{    padding: 0 1em 0 1em;    margin: 1em 0 0 0;}
	#bootstrap-table_length,.dataTables_filter{display:none;}	
	table.dataTable tbody tr th, table.dataTable tbody tr td {padding: 3px 0 3px 5px;}
	main table.dataTable tbody tr th, main  table.dataTable tbody tr td{font-weight:500 }
	main table.dataTable tbody tr th div, main  table.dataTable tbody tr td div{font-weight:200 }	

	.sok_dropdown_menu .sok_nav_link2::after	{transform: rotate(90deg);padding: 0em 0em 0.3em 0.05em;	}
	.sok_dropdown_menu .sok_nav_link2::before,.sok_dropdown_menu .sok_nav_link2::after, .sok_dropdown_item::before {
	width: 1.25em;	line-height: 0;
	content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
	transition: transform 0.35s ease;	transform-origin: .5em 50%;	display: inline-block;	}

    </style>

	<script type="text/javascript">
$(document).ready( function () {
		
	$(".sok_nav_link,.sok_nav_link2").each(function(){
		$(this).click(function(){
			$($(this).attr("href")).toggle();
			$($(this).attr("href")).find(".sok_dropdown_menu").toggle();
			return false;
		})
	})
		
    $('#bootstrap-table').DataTable({
		"pageLength": 100
		
	});
	$( "input[aria-label='Search']" ).keyup(function() {
		$( "input[type='search']" ).val($(this).val()).trigger(jQuery.Event('keyup', {keycode: 13}));
	});


		if(windowsize()=='sm'){
			$('#navbar_icon').click(function(){  
				$('#sidebarMenu').toggle();
			})
			$(".navbar-nav li a").click(function() {
				$( "input[type='search']" ).val($(this).text()).trigger(jQuery.Event('keyup', {keycode: 13}));
				$( "input[aria-label='Search']" ).val($(this).text());
				$('#sidebarMenu').hide();
				return false;
			});
		}else{
			$(".navbar-nav li a").click(function() {
				$( "input[type='search']" ).val($(this).text()).trigger(jQuery.Event('keyup', {keycode: 13}));
				$( "input[aria-label='Search']" ).val($(this).text());
				return false;
			});
		}
	
	$(window).resize(function(){
	
	});
	
}); //document ready
	function windowsize () {
	  const width = Math.max(
		document.documentElement.clientWidth,
		window.innerWidth || 0
	  )
	  if (width <= 576) return 'xs'
	  if (width <= 768) return 'sm'
	  if (width <= 992) return 'md'
	  if (width <= 1200) return 'lg'
	  return 'xl'
	}
	</script>
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><?php echo $sok['title'];?></a>
  <button class="position-absolute d-md-none collapsed" type="button" id="navbar_icon">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3 collapse">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Github</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">

	<ul class="navbar-nav">
<?php 
  foreach ($sok['data_top_dir_array'] as $key => $value) {
   //一级目录
   if (array_key_exists($value, $sok['data_first_and_second_dir_array'])) {
    echo '<li class="sok_dropdown">';
    echo '<a class="sok_nav_link2" href="#n' . $value . '">' . $sok['data_with_id'][$value]->title . '</a>'; //有二级目录的 一级目录
    echo '<ul class="sok_dropdown_menu" id="n' . $value . '">';

    //二级目录 begin
    foreach ($sok['data_second_dir_array'] as $calup_dir_two_muluid_2) {
     //找到属于该顶级目录的    二级目录
     if ($sok['data_with_id'][$calup_dir_two_muluid_2]->parentId == $value) {
      //找到属于该顶级目录的    二级目录

      //打印 二级目录  并且是有 3级的-------------------------
      if (array_key_exists($calup_dir_two_muluid_2, $sok['data_second_and_three_dir_array'])) {
       echo '<li>';
       echo '<a class="sok_nav_link2" href="#n' . $calup_dir_two_muluid_2 . '">' . $sok['data_with_id'][$calup_dir_two_muluid_2]->title . '</a>'; //有三级目录的 二级目录
       echo '<ul class="sok_dropdown_menu" id="n' . $calup_dir_two_muluid_2 . '">';
       foreach ($sok['data_second_and_three_dir_array'][$calup_dir_two_muluid_2] as $key2 => $value2) {
        // 打印三级目录
        echo ' <li><a class="sok_dropdown_item" href="#">' . $sok['data_with_id'][$value2]->title . '</a></li>';
        // 打印三级目录
       }
       echo '</ul></li>';
      }
      //打印 二级目录  并且是有 3级的--------------------------
      else {
       //打印二级目录，没三级目录了
       echo '<li><a class="sok_dropdown_item" href="#">' . $sok['data_with_id'][$calup_dir_two_muluid_2]->title . '</a></li>';
       //打印二级目录，没三级目录了
      }
     }
    }
    //二级目录end

    echo '</ul></li>';
   } else {
    //打印一级目录
    echo '<li class="nav-item"> <a class="sok_nav_link" href="#">' . $sok['data_with_id'][$value]->title . '</a></li>'; //一级目录，没二级目录了
    //打印一级目录
   }
  }
?>
	</ul>
	  </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10" id="maintable">
     <div class="table-responsive">
        <table class="table table-striped table-sm" id="bootstrap-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Link</th>
			  <th>Cat.</th>
			  <?php 
			  if($_SESSION['_sfm_allowed']) {
				echo '<th>Edit</th>';
			  }
			  ?>
            </tr>
          </thead>
          <tbody>
		<?php
  $index = 0;
  if (is_array($sok['json_decode'])) {
      foreach ($sok['json_decode'] as $calup):
          if (!$calup->url) {
              continue;
          } ?>
        <tr>
			<td> <?php echo $index + 1;
          //$calup->id;
          ?> </td>
            <td> <?php echo $calup->title; ?><div><a href="<?php echo $calup->url; ?>"><?php echo substr($calup->url, 0, 50); ?></a></div> </td>
            <td> <?php echo $sok['data_with_id'][$calup->parentId]->title .
                ',' .
                $sok['data_with_id'][$sok['data_with_id'][$calup->parentId]->parentId]->title .
                ',' .
                $sok['data_with_id'][$sok['data_with_id'][$sok['data_with_id'][$calup->parentId]->parentId]->parentId]->title; ?></td>
			<?php 
			  if($_SESSION['_sfm_allowed']) {
				echo '<td style="text-align: center;">';
				echo '<div class="btn-group btn-group-sm" role="group">';
				echo '<a class="btn btn-primary btn-sm" href="edit.php?index='.$index.'" role="button">Edit</a>';
				echo '<a class="btn btn-warning btn-sm" href="delete.php?index='.$index.'" role="button">Delete</a>';
				echo '</div></td>';
			  }
			?>
        </tr>
		<?php $index++;
      endforeach;
  }

?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
  </body>
</html>
