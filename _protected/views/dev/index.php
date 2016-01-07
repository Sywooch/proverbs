<?php
$this->title = Yii::t('app', 'Dashboard');
?>
   <div id="main-content">
            <!-- BEGIN PAGE CONTENT-->
                <!--BEGIN METRO STATES-->

                <div class="metro-nav">
                    <div class="metro-nav-block nav-block-orange">
                        <a data-original-title="" href="#">
                            <i class="fa fa-user"></i>
                            <div class="status">Manage Users</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-olive">
                        <a data-original-title="" href="#">
                            <i class="fa fa-comments"></i> 
                            <div class="status">Manage Board</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-yellow">
                        <a data-original-title="" href="#">
                            <i class="fa fa-users"></i>
                            <div class="status">Manage Students</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-green double">
                        <a data-original-title="" href="#">
                            <i class="fa fa-bullhorn"></i>
                            <div class="status">Add New Announcement</div>
                        </a>
                    </div>
                    <div class="metro-nav-block nav-block-red">
                        <a data-original-title="" href="#">
                            <i class="fa fa-folder-open"></i>
                            <div class="status">Transactions</div>
                        </a>
                    </div>
                </div>

                <div class="row"></div>            
                <!--END METRO STATES-->
	<div class="rjd-container">
		<div class="rjd1">
			<div class="rjd1-header">
              <i class="fa fa-line-chart" style="color: #fff; font-size: 16px;"></i>  
            </div>
			<div class="rjd1-body">
            <div id="curve_chart" style="width: 100%; height: 100%;"></div>         
            </div>
		</div>
		<div class="rjd2">
			<div class="rjd2-header"></div>
			<div class="rjd2-body"></div>
		</div>
	</div>
	<div class="rjd-container2">
		<div class="rjd-content">
			<div class="content-header"></div>
			<div class="content-body"></div>
		</div>
	</div>
</div>

