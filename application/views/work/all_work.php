<style>
.winpad-header{
	margin-top: 10px;
	padding: 10px;
	font-weight: bold;
	font-size: 20px;
}
</style>
<div class="winpad-header"><?= $title; ?></div>

<?php 
$today = date('Y-m-d');
$hidden_day = date('Y-m-d', strtotime($today. '- 3 days'));

?>


<div class="row">
  <div class="col-md-8">

	<?php if(!$bc):?>
	<?php else:?>
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h5><i class="icon fas fa-info"></i> <?= $bc['bc_title'];?></h5>
			<p><i class="icon fas fa-check"></i><?= $bc['bc_message'];?></p>
		</div>
		<?php endif;?>

    <div class="row">
      <div class="div col-6">
        <a href="<?= base_url('work/work_history') ?>" class="btn btn-default bg-gradient btn-block mb-2"><i class="fas fa-clock mr-1"> </i>  History</a>
      </div>
      <div class="div col-6">
        <a href="<?= base_url('work/new_work') ?>"  class="btn btn-default bg-gradient btn-block mb-2 <?php if($userData['user_company']==null){echo 'disabled';}else{}?>"><i class="fas fa-plus mr-1"> </i>  New Work</a>
      </div>
    </div>
		
	    
<p class="m-1" style="font-style: italic; color:dimgray;">Work will be dissapeared 3 days after status CLS.</p>
<?php $this->load->view($component_workList, [$work, $user, $comment, $userData, $depts]); ?>
  </div>
  </div>


