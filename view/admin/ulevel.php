<?php require_once 'header.php' ?>
    <style>
        .form-ajax>.form-group>.col-md-6{color:#6B6D6E;font-size:0.9em;line-height:
            30px}.form-ajax>.form-group>.col-md-2{color:#6B6D6E;}
    </style>

    <h3>
        <span class="current">
            等级名称设置
        </span>


    </h3>
    <br>
    <div class="set set0">
        <?php foreach($ulevel as $key=>$val):?>
            <div class="panel panel-info" data-id="<?php echo $val['id']?>">

                <div class="panel-body">
                    <form class="form-ajax form-inline" action="<?php echo $this->dir?>ulevel/save/<?php echo $val['id']?>"
                          method="post">
                        <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-addon">
                                        名称
                                    </span>
                                <input type="text" name="title" class="form-control" placeholder="名称"
                                       value="<?php echo $val['title']?>">
                            </div>
                        </div>

                        <div class="input-group">
                            <button type="submit" class="btn btn-success">
                                &nbsp;
                                <span class="glyphicon glyphicon-save">
                                    </span>
                                &nbsp;保存设置&nbsp;
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach;?>
    </div>





<?php require_once 'footer.php' ?>