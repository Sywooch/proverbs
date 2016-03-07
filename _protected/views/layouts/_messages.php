<?php
echo '<div id="messages">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a id="fetch" href="' . Yii::$app->request->baseUrl . '/ajax/fetch' . '" data-on-done="fetch" class="btn btn-primary btn-board"><i class="fa fa-refresh fa-one-point-five"></i></a>
                <a id="btn-msg-toggle" class="btn btn-primary btn-board pull-right" href="#" style="text-align: center; margin: auto;"><i class="fa fa-remove fa-one-point-five"></i></a>
                </div>
                <div class="panel-body">
                    <div id="ui-load-message"><img class="ui-load-icon" alt="loading" src="' . Yii::$app->request->baseUrl . '/uploads/ui/ripple.gif' .'";></div>
                    <div id="message-content-panel" class="board">
                        <div id="b" class="board-content">';
                    echo '</div>
                    </div>
            </div>
            <div id="write-panel-footer" class="">';
?>