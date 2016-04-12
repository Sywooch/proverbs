<?php

use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$today = \Carbon\Carbon::today(new DateTimeZone('Asia/Manila'));
?>
<!-- Page header -->
<div class="row">
	<div class="container-fluid" style="margin: 0; padding: 0 15px;">
		<div class="col-lg-12 col-md-12 col-sm-12" style="margin: 15px 0; padding: 0;">
		</div>
	</div>
</div>
<!-- /page header -->