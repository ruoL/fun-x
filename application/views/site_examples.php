<?php $this->load->view('site_header'); ?>
<div class="examples_page">
	<!-- 在中间放置预览框 -->
	<div class="superbox-show">
		<div class="loading">
			<img src="<?php echo base_url('static/images/loading.gif');?>">
		</div>
		<div class="show_block">
			<div class="con pre">
				<a href="javascript:void(0);"></a>
			</div>
			<div class="con next">
				<a href="javascript:void(0);"></a>
			</div>
			<div class="top_block">
				<div class="page"><span></span><span></span></div>
				<div class="superbox-close">close<i></i></div>
			</div>
			<div class="show_left">
				<div class="show_imgs" data-num="1">
				    <ul>
				    </ul>
				 </div>
				<div class="sorrow sorrow_left">
					<a href="javascript:void(0);"></a>
				</div>
				<div class="sorrow sorrow_right">
					<a href="javascript:void(0);"></a>
				</div>
			</div>
			<div class="show_right">
				<h4></h4>
				<h5></h5><hr style=" height:2px;border:none;border-top:1px solid #fff;margin-right:10px;" />
				<p class="desc"></p>
				<div class="color_block">
					<p>色彩研究</p>
					<ul>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- end -->
	<div class="control prepage">
		<a href="javascript:void(0);"></a>
	</div>
	<div class="control nextpage">
		<a href="javascript:void(0);"></a>
	</div>
	<div class="wrapper">
		<!-- 共四行，每行五个 -->
		<div class="wrapper_content">
		<?php if( $page ):?>
			<?php for($p = 0; $p < $page; $p++):?>
			<div class="superbox_lists" data-page="<?php echo $i + 1;?>">
				<div class="superbox superbox1">
					<ul>
					<?php for( $i = $p * 20; $i < 10 + $p * 20; $i++ ) :?>
						<?php if( isset($list[$i]) ):?>
						<li class="superbox-list">
							<a href="javascript:void(0);">
								<img src="<?php echo base_url($list[$i]->fengmian);?>" data-num="<?php echo $list[$i]->id;?>" data-no="<?php echo $i+1;?>"  class="superbox-img">
								<div class="case_mark">
									<span><?php echo $list[$i]->name;?></span>
									<span><?php echo implode('·', $list[$i]->tag);?></span>
								</div>
							</a>
						</li>
						<?php endif;?>
					<?php endfor;?>
					</ul>
				</div>
				<div class="superbox superbox2">
					<ul>
						<?php for( $i = 10 + $p * 20; $i < $p * 20 + 20; $i++ ):?>
							<?php if( isset($list[$i]) ):?>
							<li class="superbox-list">
								<a href="javascript:void(0);">
									<img src="<?php echo base_url($list[$i]->fengmian);?>" data-num="<?php echo $list[$i]->id;?>" data-no="<?php echo $i+1;?>"  class="superbox-img">
									<div class="case_mark">
										<span><?php echo $list[$i]->name;?></span>
										<span><?php echo implode('·', $list[$i]->tag);?></span>
									</div>
								</a>
							</li>
							<?php endif;?>
						<?php endfor;?>
					</ul>
				</div>
			</div>
			<?php endfor;?>
		<?php endif;?>
		</div>
	</div>
</div>
<?php $this->load->view('site_footer'); ?>
